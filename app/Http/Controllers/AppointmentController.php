<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Pet;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['client', 'pet'])->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $clients = Client::all();
        $pets = Pet::all();
        return view('appointments.create', compact('clients', 'pets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'pet_id' => 'required|exists:pets,id',
            'appointment_date' => 'required|date',
            'status' => 'required|string|in:scheduled,completed,canceled',
            'notes' => 'nullable|string',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment scheduled successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $pets = Pet::all();
        return view('appointments.edit', compact('appointment', 'clients', 'pets'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'pet_id' => 'required|exists:pets,id',
            'appointment_date' => 'required|date',
            'status' => 'required|string|in:scheduled,completed,canceled',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
