<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'date',
        'treatment',
        'surgery',
        'medication',
        'lab_results',
        'next_appointment_date'
    ];

    protected $casts = [
        'date' => 'datetime',
        'next_appointment_date' => 'datetime',
    ];

    

    public function pet()
        {
            return $this->belongsTo(Pet::class);
        }
}

