<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
            {{ __('Create Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6">
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <label class="block font-medium text-gray-700 dark:text-gray-300">Client</label>
                    <select name="client_id" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    <label class="block font-medium text-gray-700 dark:text-gray-300 mt-4">Pet</label>
                    <select name="pet_id" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                        @foreach($pets as $pet)
                            <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                        @endforeach
                    </select>
                    <label class="block font-medium text-gray-700 dark:text-gray-300 mt-4">Appointment Date</label>
                    <input type="datetime-local" name="appointment_date" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                    <label class="block font-medium text-gray-700 dark:text-gray-300 mt-4">Status</label>
                    <select name="status" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <label class="block font-medium text-gray-700 dark:text-gray-300 mt-4">Notes</label>
                    <textarea name="notes" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"></textarea>
                    <button type="submit" class="mt-4 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm font-medium">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>