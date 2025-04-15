<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::with('pet')->paginate(10);
        return view('medical_records.index', compact('medicalRecords'));
    }

    public function create()
    {
        $pets = Pet::all();
        return view('medical_records.create', compact('pets')); // Fix: Use $pets instead of $clients
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'date' => 'required|date',
            'treatment' => 'nullable|string',
            'surgery' => 'nullable|string',
            'medication' => 'nullable|string',
            'lab_results' => 'nullable|file|mimes:pdf,jpg,png|max:2048', // Fix: File upload validation
            'next_appointment_date' => 'nullable|date',
        ]);

        // Handle file upload
        if ($request->hasFile('lab_results')) {
            $validatedData['lab_results'] = $request->file('lab_results')->store('lab_results', 'public');
        }

        MedicalRecord::create($validatedData);

        return redirect()->route('medical_records.index')->with('success', 'Medical record added successfully.');

    }

    public function show(MedicalRecord $medicalRecord)
    {
        return view('medical_records.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $pets = Pet::all();
        return view('medical_records.edit', compact('medicalRecord', 'pets'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validatedData = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'date' => 'required|date',
            'treatment' => 'nullable|string',
            'surgery' => 'nullable|string',
            'medication' => 'nullable|string',
            'lab_results' => 'nullable|file|mimes:pdf,jpg,png|max:2048', // Fix: Ensure file validation
            'next_appointment_date' => 'nullable|date',
        ]);

        // Handle file upload
        if ($request->hasFile('lab_results')) {
            // Delete old file if exists
            if ($medicalRecord->lab_results) {
                Storage::delete('public/' . $medicalRecord->lab_results);
            }
            $validatedData['lab_results'] = $request->file('lab_results')->store('lab_results', 'public');
        }

        $medicalRecord->update($validatedData);

        return redirect()->route('medical_records.index')->with('success', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        // Delete the associated file
        if ($medicalRecord->lab_results) {
            Storage::delete('public/' . $medicalRecord->lab_results);
        }

        $medicalRecord->delete();

        return redirect()->route('medical_records.index')->with('success', 'Medical record deleted successfully.');
    }
}

