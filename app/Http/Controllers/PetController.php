<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Client;
use App\Models\Vaccination;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        

        
        $pets = Pet::with(['client', 'vaccinations']) // Eager load relationships
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('species', 'like', "%{$search}%")
                    ->orWhereHas('client', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->paginate(10);

        return view('pets.index', compact('pets'));
    }




    public function create()
    {
        $clients = Client::all();
        return view('pets.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string',
            'age' => 'required|integer|min:0', // Added age validation
            'gender' => 'required|in:Male,Female,Other', // Added gender validation
            'photo' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Allow only images
            'species' => 'required|string',
            'breed' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'vaccinations' => 'nullable|string',
            'ongoing_treatments' => 'nullable|string',
        ]);

        $pet = Pet::create($validatedData);

        if ($request->hasFile('photo')) {
            $pet->storePhoto($request->file('photo'));
        }

        return redirect()->route('pets.index')->with('success', 'Pet added successfully.');
    }

    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $clients = Client::all();
        return view('pets.edit', compact('pet', 'clients'));
    }

    public function update(Request $request, Pet $pet)
    {
        $validatedData = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'name' => 'sometimes|string',
            'age' => 'sometimes|integer|min:0', // Added age validation
            'gender' => 'sometimes|in:Male,Female,Other', // Added gender validation
            'photo' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            'species' => 'sometimes|string',
            'breed' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'vaccinations' => 'nullable|string',
            'ongoing_treatments' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            if ($pet->photo) {
                Storage::delete('public/' . $pet->photo);
            }
            $pet->storePhoto($request->file('photo'));
        }

        $pet->update($validatedData);

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $pet)
    {
        // Delete pet photo if it exists
        if ($pet->photo) {
            Storage::delete('public/' . $pet->photo);
        }

        $pet->delete();

        // Redirect to index to ensure $pets is properly fetched
        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully.');
    }


}