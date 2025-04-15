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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // Foreign key to clients table
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade'); // Foreign key to appointments table
            $table->decimal('amount', 10, 2); // Amount for the invoice
            $table->date('invoice_date'); // Date the invoice was created
            $table->date('due_date'); // Due date for the invoice
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid'); // Status of the invoice
            $table->string('transaction')->nullable(); // Optional transaction ID or details
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
