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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // Foreign key to clients table
            $table->string('name'); // Name of the pet
            $table->integer('age')->nullable(); // Age of the pet (nullable)
            $table->string('gender')->nullable(); // Gender of the pet
            $table->string('photo', 2048)->nullable(); // Photo of the pet (nullable, allows longer file paths)
            $table->string('species'); // Species of the pet (e.g., Dog, Cat)
            $table->string('breed')->nullable(); // Breed of the pet (nullable)
            $table->text('medical_history')->nullable(); // Medical history (nullable, allows more data)
            $table->string('allergies')->nullable(); // Allergies (string for efficiency)
            $table->string('vaccinations')->nullable(); // Vaccinations (string for efficiency)
            $table->text('ongoing_treatments')->nullable(); // Ongoing treatments (nullable)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
