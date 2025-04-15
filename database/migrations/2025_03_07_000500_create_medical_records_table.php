<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade'); // Foreign key to the pets table
            $table->date('date'); // The date of the medical record
            $table->string('treatment')->nullable(); // Treatment given (optional)
            $table->string('surgery')->nullable(); // Surgery details (optional)
            $table->string('medication')->nullable(); // Medication given (optional)
            $table->string('lab_results')->nullable(); // Store the file path instead of text
            $table->date('next_appointment_date')->nullable(); // Next appointment date (optional)
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
