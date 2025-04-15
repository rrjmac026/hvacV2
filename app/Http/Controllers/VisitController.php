<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Client;
use App\Models\Pet;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::with(['client', 'pet', 'appointment'])->get();
        return view('visits.index', compact('visits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'pet_id' => 'required|exists:pets,id',
            'visit_date' => 'required|date',
            'status' => 'required|in:completed,pending,cancelled',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
            'appointment_id' => 'nullable|exists:appointments,id'
        ]);

        $validated['visit_date'] = \Carbon\Carbon::parse($request->visit_date);
        $visit = Visit::create($validated);

        return redirect()->route('visits.show', $visit)
            ->with('success', 'Visit record created successfully');
    }

    public function create()
    {
        $clients = Client::all();
        $pets = Pet::all();
        return view('visits.create', compact('clients', 'pets'));
    }

    public function show(Visit $visit)
    {
        return view('visits.show', compact('visit'));
    }

    public function update(Request $request, Visit $visit)
    {
        $validatedData = $request->validate([
            'appointment_id' => 'sometimes|exists:appointments,id',
            'client_id' => 'sometimes|exists:clients,id',
            'pet_id' => 'sometimes|exists:pets,id',
            'notes' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'visit_date' => 'sometimes|date',
            'status' => 'sometimes|string',
        ]);

        $visit->update($validatedData);
        return view('visits.index', compact('visits'));
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();
        return view('visits.index')->with('success', 'Visit deleted successfully');
    }
}