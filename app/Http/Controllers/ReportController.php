<?php

namespace App\Http\Controllers;

use App\Models\{Client, Pet, Appointment, Invoice, Visit, MedicalRecord, Product, Activity};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportController extends Controller
{
    protected $reportTypes = [
        'clients' => Client::class,
        'pets' => Pet::class,
        'appointments' => Appointment::class,
        'invoices' => Invoice::class,
        'visits' => Visit::class,
        'medical_records' => MedicalRecord::class,
        'products' => Product::class,
        'activities' => Activity::class,
    ];

    public function index()
    {
        $reportTypes = collect($this->reportTypes)->map(fn($model, $key) => [
            'value' => $key,
            'label' => ucwords(str_replace('_', ' ', $key)),
            'count' => $model::count(),
            'latest' => $model::latest()->first()?->created_at?->diffForHumans()
        ]);
        
        return view('reports.index', compact('reportTypes'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'type' => 'required|in:' . implode(',', array_keys($this->reportTypes)),
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'required|in:json,pdf'
        ]);

        $model = $this->reportTypes[$request->type];
        $dateColumn = $this->getDateColumn($request->type);

        // Build query
        $query = $model::query();

        // Add relationships
        $query->with($this->getRelationships($request->type));

        // Add date filtering - using YYYY-MM-DD format for consistency
        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));
        
        // Log the query parameters for debugging
        Log::info('Report Parameters', [
            'type' => $request->type,
            'date_column' => $dateColumn,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

        // Run the query
        $data = $query->get();
        
        // Log the results for debugging
        Log::info('Query Results', [
            'count' => $data->count(),
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        $transformedData = $data->map(fn($item) => $this->transformData($item, $request->type));

        if ($request->format === 'pdf') {
            return $this->generatePdfResponse($transformedData, $request->type, [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
        }

        return response()->json($transformedData);
    }

    protected function getDateColumn($type)
    {
        return match($type) {
            'appointments' => 'appointment_date',
            'visits' => 'visit_date',
            'invoices' => 'invoice_date',
            'medical_records' => 'record_date',
            default => 'created_at'
        };
    }

    protected function getRelationships($type)
    {
        return match($type) {
            'pets' => ['client'],
            'appointments' => ['client', 'pet'],
            'visits' => ['client', 'pet'],
            'medical_records' => ['pet.client'],
            'invoices' => ['client'],
            default => []
        };
    }

    protected function transformData($item, $type)
    {
        return match($type) {
            'clients' => [
                'ID' => $item->id,
                'Name' => $item->name,
                'Email' => $item->email,
                'Phone' => $item->phone,
                'Address' => $item->address,
                'Pets Count' => $item->pets->count(),
                'Created Date' => $item->created_at->format('Y-m-d H:i:s')
            ],
            'pets' => [
                'ID' => $item->id,
                'Name' => $item->name,
                'Species' => $item->species,
                'Breed' => $item->breed,
                'Owner' => $item->client->name,
                'Created Date' => $item->created_at->format('Y-m-d H:i:s')
            ],
            'appointments' => [
                'ID' => $item->id,
                'Client' => $item->client ? $item->client->name : 'N/A',
                'Pet' => $item->pet ? $item->pet->name : 'N/A',
                'Appointment Date' => $item->appointment_date ? $item->appointment_date->format('M d, Y h:i A') : 'N/A',
                'Status' => ucfirst($item->status),
                'Notes' => $item->notes ?? 'No notes',
                'Created' => $item->created_at->format('M d, Y h:i A')
            ],
            'invoices' => [
                'ID' => $item->id,
                'Client' => $item->client->name,
                'Amount' => number_format($item->amount, 2),
                'Status' => $item->status,
                'Invoice Date' => $item->invoice_date->format('Y-m-d'),
                'Due Date' => $item->due_date->format('Y-m-d')
            ],
            'visits' => [
                'ID' => $item->id,
                'Client' => $item->client->name,
                'Pet' => $item->pet->name,
                'Visit Date' => $item->visit_date->format('Y-m-d H:i:s'),
                'Diagnosis' => $item->diagnosis,
                'Treatment' => $item->treatment,
                'Notes' => $item->notes
            ],
            'products' => [
                'ID' => $item->id,
                'Name' => $item->name,
                'Category' => $item->category ?? 'Uncategorized',
                'Description' => Str::limit($item->description, 50),
                'Price' => number_format($item->price, 2),
                'Stock' => $item->stock,
                'Created' => $item->created_at->format('M d, Y')
            ],
            'activities' => [
                'ID' => $item->id,
                'Type' => ucfirst($item->type),
                'Description' => $item->description,
                'User' => $item->user ? $item->user->name : 'System',
                'Date' => $item->created_at->format('M d, Y h:i A')
            ],
            default => $item->toArray()
        };
    }

    protected function generatePdfResponse($data, $type, $params)
    {
        $title = ucwords(str_replace('_', ' ', $type)) . ' Report';
        $filename = "{$type}_report_" . now()->format('Y-m-d') . ".pdf";

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('reports.pdf', [
            'title' => $title,
            'data' => $data,
            'type' => $type,
            'params' => $params
        ])->render());

        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"$filename\""
        ]);
    }
}
