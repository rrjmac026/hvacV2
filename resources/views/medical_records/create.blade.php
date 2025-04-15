
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Create New Medical Record') }}
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
                    <form action="{{ route('medical_records.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <div>
                            <label for="pet_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Pet</label>
                            <select name="pet_id" id="pet_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="">Select a pet</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}">{{ $pet->name }} ({{ $pet->client->name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Record Date</label>
                            <input type="date" name="date" id="date" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                        </div>

                        <div>
                            <label for="treatment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Treatment</label>
                            <textarea name="treatment" id="treatment" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                        </div>

                        <div>
                            <label for="surgery" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Surgery</label>
                            <textarea name="surgery" id="surgery" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                        </div>

                        <div>
                            <label for="medication" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medication</label>
                            <textarea name="medication" id="medication" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                        </div>

                        <div>
                            <label for="lab_results" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lab Results (Upload File)</label>
                            <input type="file" name="lab_results" id="lab_results" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                        </div>

                        <div>
                            <label for="next_appointment_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Next Appointment Date</label>
                            <input type="date" name="next_appointment_date" id="next_appointment_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                        </div>

                        <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full text-sm font-medium transition duration-300 ease-in-out">
                            Create Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>