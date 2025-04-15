<?php

namespace App\Http\Controllers;

use App\Models\{Appointment, Client, Pet};
use Illuminate\Support\Collection;

class ActivityLogController extends Controller
{
    public function getRecentActivities(): Collection
    {
        return collect([])
            ->merge($this->getAppointmentActivities())
            ->merge($this->getClientActivities())
            ->merge($this->getPetActivities())
            ->sortByDesc('time')
            ->take(5);
    }

    protected function getAppointmentActivities(): Collection
    {
        return Appointment::with('client')
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($item) => [
                'type' => 'appointment',
                'icon' => 'calendar',
                'color' => 'primary',
                'time' => $item->created_at,
                'title' => "New appointment scheduled",
                'description' => "with {$item->client->name}",
                'date' => $item->appointment_date->format('M d, Y h:i A')
            ]);
    }

    protected function getClientActivities(): Collection
    {
        return Client::latest()
            ->take(3)
            ->get()
            ->map(fn($item) => [
                'type' => 'client',
                'icon' => 'user',
                'color' => 'secondary',
                'time' => $item->created_at,
                'title' => "New client registered",
                'description' => $item->name,
                'date' => $item->created_at->format('M d, Y h:i A')
            ]);
    }

    protected function getPetActivities(): Collection
    {
        return Pet::with('client')
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($item) => [
                'type' => 'pet',
                'icon' => 'paw',
                'color' => 'accent',
                'time' => $item->created_at,
                'title' => "New pet added",
                'description' => "{$item->name} • Owner: {$item->client->name}",
                'date' => $item->created_at->format('M d, Y h:i A')
            ]);
    }
}
