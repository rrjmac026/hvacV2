<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['client', 'pet'])
            ->get()
            ->map(function($appointment) {
                $startTime = $appointment->appointment_date;
                $endTime = $appointment->appointment_date->copy()->addHour();
                
                return [
                    'id' => $appointment->id,
                    'title' => "{$appointment->client->name} - {$appointment->pet->name}",
                    'start' => $startTime->format('Y-m-d\TH:i:s'),
                    'end' => $endTime->format('Y-m-d\TH:i:s'),
                    'allDay' => false,
                    'extendedProps' => [
                        'client' => $appointment->client->name,
                        'pet' => $appointment->pet->name,
                        'status' => $appointment->status,
                        'notes' => $appointment->notes
                    ],
                    'backgroundColor' => $this->getStatusColor($appointment->status),
                    'borderColor' => 'transparent',
                    'url' => route('appointments.show', $appointment->id)
                ];
            });

        return view('calendar.index', compact('appointments'));
    }

    private function getStatusColor($status)
    {
        return match($status) {
            'scheduled' => '#10B981', // green
            'completed' => '#3B82F6', // blue
            'cancelled' => '#EF4444', // red
            default => '#6B7280'      // gray
        };
    }
}
