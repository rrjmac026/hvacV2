<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Resource Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('medical_records', MedicalRecordController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('pets', PetController::class);
    Route::resource('vaccinations', VaccinationController::class);
    Route::resource('visits', VisitController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('products', ProductController::class);
    
    // Reports Routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::any('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
});

// Activity Log Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
});

// Authentication Routes
require __DIR__.'/auth.php';

