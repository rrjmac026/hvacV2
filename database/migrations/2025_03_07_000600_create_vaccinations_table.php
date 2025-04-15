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
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade'); // Foreign key to pets table
            $table->string('vaccine_name'); // Name of the vaccine
            $table->date('dose_date'); // Date of the vaccine dose
            $table->date('next_due_date'); // Date for the next vaccination dose
            $table->text('notes')->nullable(); // Optional notes about the vaccination
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
