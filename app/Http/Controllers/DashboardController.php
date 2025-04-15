<?php

namespace App\Http\Controllers;

use App\Models\{Client, Pet, Appointment, Invoice, Visit, MedicalRecord};

class DashboardController extends Controller
{
    protected $activityLogController;

    public function __construct(ActivityLogController $activityLogController)
    {
        $this->activityLogController = $activityLogController;
    }

    public function index()
    {
        return view('dashboard', [
            'counts' => $this->getCounts(),
            'activities' => $this->activityLogController->getRecentActivities()
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
