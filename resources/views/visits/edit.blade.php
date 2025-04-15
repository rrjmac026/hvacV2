{{-- edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Edit Visit') }}
            </h2>
            <a href="{{ route('visits.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to List</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
                <div class="p-8">
                    <form action="{{ route('visits.update', $visit->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Client Field -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Client</label>
                            <select name="client_id" class="w-full mt-1">
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ $visit->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pet Field -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Pet</label>
                            <select name="pet_id" class="w-full mt-1">
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}" {{ $visit->pet_id == $pet->id ? 'selected' : '' }}>{{ $pet->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Visit Date -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Visit Date</label>
                            <input type="date" name="visit_date" class="w-full mt-1" value="{{ $visit->visit_date }}" required>
                        </div>

                        <!-- Notes -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                            <textarea name="notes" class="w-full mt-1" rows="3">{{ $visit->notes }}</textarea>
                        </div>

                        <!-- Diagnosis -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Diagnosis</label>
                            <input type="text" name="diagnosis" class="w-full mt-1" value="{{ $visit->diagnosis }}">
                        </div>

                        <!-- Treatment -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Treatment</label>
                            <input type="text" name="treatment" class="w-full mt-1" value="{{ $visit->treatment }}">
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" class="w-full mt-1">
                                <option value="Pending" {{ $visit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Completed" {{ $visit->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-full font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Update Visit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>