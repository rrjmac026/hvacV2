@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Edit Medical Record') }} #{{ $medicalRecord->id }}
            </h2>
            <a href="{{ route('medical_records.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Medical Records</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
                <div class="p-8">
                    <form action="{{ route('medical_records.update', $medicalRecord) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Pet Selection Section -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Pet Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="pet_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Pet</label>
                                    <select name="pet_id" id="pet_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Select a pet</option>
                                        @foreach($pets as $pet)
                                            <option value="{{ $pet->id }}" {{ $medicalRecord->pet_id == $pet->id ? 'selected' : '' }}>{{ $pet->name }} ({{ $pet->client->name }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Record Date</label>
                                    <input type="date" name="date" id="date" value="{{ $medicalRecord->date->format('Y-m-d') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                            </div>
                        </div>

                        <!-- Diagnosis Section -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Diagnosis Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="diagnosis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Diagnosis</label>
                                    <textarea name="diagnosis" id="diagnosis" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Enter diagnosis details">{{ $medicalRecord->diagnosis }}</textarea>
                                </div>
                                <div>
                                    <label for="symptoms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Symptoms</label>
                                    <textarea name="symptoms" id="symptoms" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Enter observed symptoms">{{ $medicalRecord->symptoms }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Treatment Section -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Treatment Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="treatment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Treatment Plan</label>
                                    <textarea name="treatment" id="treatment" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Enter treatment details">{{ $medicalRecord->treatment }}</textarea>
                                </div>
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Additional Notes</label>
                                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Enter any additional notes">{{ $medicalRecord->notes }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('medical_records.index') }}" class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-full text-sm font-medium transition duration-300 ease-in-out inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full text-sm font-medium transition duration-300 ease-in-out inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Update Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>