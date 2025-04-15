-- show.blade.php --
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ $vaccination->vaccine_name }} - Vaccination Details
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('vaccinations.edit', $vaccination) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit Vaccination</span>
                </a>
                <a href="{{ route('vaccinations.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Back to Vaccinations</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                            <h3 class="text-xl font-bold text-emerald-600 dark:text-emerald-400">{{ $vaccination->vaccine_name }}</h3>
                            <p class="text-gray-600 dark:text-gray-300">Pet: {{ $vaccination->pet->name }}</p>
                            <p class="text-gray-600 dark:text-gray-300">Dose Date: {{ $vaccination->dose_date }}</p>
                            <p class="text-gray-600 dark:text-gray-300">Next Due Date: {{ $vaccination->next_due_date ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="space-y-6">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-emerald-700 dark:text-emerald-300 mb-4">Notes</h4>
                                <p class="text-gray-600 dark:text-gray-300">{{ $vaccination->notes ?: 'No additional notes.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('vaccinations.edit', $vaccination) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Edit Vaccination</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
