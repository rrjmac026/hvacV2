@php
use Illuminate\Support\Facades\Storage;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Medical Record') }} #{{ $medicalRecord->id }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('medical_records.edit', $medicalRecord) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit Record</span>
                </a>
                <a href="{{ route('medical_records.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Back to Records</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300 mb-4">Pet Information</h3>
                            <p><span class="font-medium">Pet Name:</span> {{ $medicalRecord->pet->name }}</p>
                            <p><span class="font-medium">Owner:</span> {{ $medicalRecord->pet->client->name }}</p>
                            <p><span class="font-medium">Record Date:</span> {{ \Carbon\Carbon::parse($medicalRecord->date)->format('M d, Y') }}</p>
                        </div>
                        <!-- <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300 mb-4">Diagnosis</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $medicalRecord->diagnosis }}</p>
                        </div> -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300 mb-4">Treatment</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $medicalRecord->treatment }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300 mb-4">Additional Notes</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $medicalRecord->notes ?: 'No additional notes.' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300 mb-4">Lab Results</h3>
                            @if($medicalRecord->lab_results)
                                <a href="{{ Storage::url($medicalRecord->lab_results) }}" target="_blank" class="text-emerald-600 hover:text-emerald-800 underline">View Lab Result</a>
                            @else
                                <p class="text-gray-600 dark:text-gray-300">No lab results uploaded.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>