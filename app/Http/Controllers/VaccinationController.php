<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccination;
use App\Models\Pet;

class VaccinationController extends Controller
{
    public function index()
    {
        $vaccinations = Vaccination::with('pet')->paginate(10);
        return view('vaccinations.index', compact('vaccinations'));
    }

    public function create()
    {
        $pets = Pet::all();
        return view('vaccinations.create', compact('pets')); // ✅ Passes $pets to the view
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'vaccine_name' => 'required|string',
            'dose_date' => 'required|date',
            'next_due_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        Vaccination::create($validatedData);

        return redirect()->route('vaccinations.index')->with('success', 'Vaccination added successfully.'); // ✅ Redirect after saving
    }


    public function show(Vaccination $vaccination)
    {
        return view('vaccinations.show', compact('vaccination'));
    }

    public function update(Request $request, Vaccination $vaccination)
    {
        $validatedData = $request->validate([
            'pet_id' => 'sometimes|exists:pets,id',
            'vaccine_name' => 'sometimes|string',
            'dose_date' => 'sometimes|date',
            'next_due_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $vaccination->update($validatedData);
        return view('vaccinations.index', compact('vaccinations'));
    }

    public function destroy(Vaccination $vaccination)
    {
        $vaccination->delete();

        return redirect()->route('vaccinations.index')->with('success', 'Vaccination deleted successfully.'); // ✅ Redirect to index
    }


}