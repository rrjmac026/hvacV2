<?php

namespace App\Http\Controllers;

use App\Models\{Client, Pet, Appointment, Invoice, Visit, MedicalRecord, Activity};

class DashboardController extends Controller
{
    protected $activityLogController;

    public function __construct(ActivityLogController $activityLogController)
    {
        $this->activityLogController = $activityLogController;
    }

    public function index()
    {
        $clients = Client::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $pets = Pet::selectRaw('species, COUNT(*) as count')
            ->groupBy('species')
            ->orderBy('count', 'desc')
            ->get();

        return view('dashboard', [
            'counts' => [
                'clients' => Client::count(),
                'pets' => Pet::count(),
                'appointments' => Appointment::count(),
                'visits' => Visit::count(),
                'invoices' => Invoice::count(),
                'records' => MedicalRecord::count(),
            ],
            'clients' => $clients,
            'pets' => $pets,
            'activities' => Activity::latest()->take(5)->get(),
        ]);
    }

    protected function getCounts()
    {
        return [
            'clients' => Client::count(),
            'pets' => Pet::count(),
            'appointments' => Appointment::count(),
            'visits' => Visit::count(),
            'invoices' => Invoice::count(),
            'records' => MedicalRecord::count(),
        ];
    }
}
