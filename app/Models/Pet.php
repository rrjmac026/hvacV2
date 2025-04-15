<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use App\Traits\LogsActivity;

class Pet extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'client_id',
        'name',
        'age',
        'gender',
        'photo',
        'species',
        'breed',
        'medical_history',
        'allergies',
        'vaccinations', // Consider renaming if it conflicts with the vaccinations() relationship
        'ongoing_treatments',
    ];

    // Define the relationship with the client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }

    // Fix: Retrieve the correct photo URL using Laravel's Storage facade
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? Storage::url($this->photo) : asset('images/default-pet.png'); // Use a default image if no photo is uploaded
    }

    // Store uploaded photo
    public function storePhoto($file)
    {
        // Delete old photo if exists
        if ($this->photo) {
            Storage::delete('public/' . $this->photo);
        }

        // Store the new photo
        $path = $file->store('pet_photos', 'public');
        $this->update(['photo' => $path]); 
    }

}
