<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Create New Invoice') }}
            </h2>
            <a href="{{ route('invoices.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Invoices</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
                <div class="p-8">
                    <form action="{{ route('invoices.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Client and Appointment Section -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Client</label>
                                    <select name="client_id" id="client_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Select a client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="appointment_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Related Appointment (Optional)</label>
                                    <select name="appointment_id" id="appointment_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Select an appointment</option>
                                        @foreach($appointments as $appointment)
                                            <option value="{{ $appointment->id }}">{{ $appointment->appointment_date }} - {{ $appointment->service_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Details -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Invoice Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="amount" id="amount" step="0.01" required class="pl-7 mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="0.00">
                                    </div>
                                </div>
                                <div>
                                    <label for="invoice_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Invoice Date</label>
                                    <input type="date" name="invoice_date" id="invoice_date" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                                    <input type="date" name="due_date" id="due_date" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                            </div>
                        </div>

                        <!-- Status and Details -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Payment Status</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="unpaid">Unpaid</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="transaction" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transaction Details (Optional)</label>
                                    <textarea name="transaction" id="transaction" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Enter any additional transaction details"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('invoices.index') }}" class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-full text-sm font-medium transition duration-300 ease-in-out inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full text-sm font-medium transition duration-300 ease-in-out inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Create Invoice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>