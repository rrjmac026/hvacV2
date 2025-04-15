<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Appointment;

class InvoiceController extends Controller
{
    // Display a listing of invoices
    public function index()
    {
        $invoices = Invoice::with('client')
            ->when(request('search'), function($query, $search) {
                $query->where('invoice_number', 'like', "%{$search}%")
                    ->orWhereHas('client', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $clients = Client::all(); // Get all clients
        $appointments = Appointment::all(); // Get all appointments
        return view('invoices.create', compact('clients', 'appointments')); // Pass both clients and appointments to the view
    }



    // Store a new invoice
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'amount' => 'required|numeric',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required|string',
            'transaction' => 'nullable|string',
        ]);

        $invoice = Invoice::create($validatedData);
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    // Show a specific invoice
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    // Update an invoice
    public function update(Request $request, Invoice $invoice)
    {
        $validatedData = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'appointment_id' => 'sometimes|exists:appointments,id',
            'amount' => 'sometimes|numeric',
            'invoice_date' => 'sometimes|date',
            'due_date' => 'sometimes|date',
            'status' => 'sometimes|string',
            'transaction' => 'nullable|string',
        ]);

        $invoice->update($validatedData);
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    // Delete an invoice
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
