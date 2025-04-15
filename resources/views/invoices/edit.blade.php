<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Edit Invoice') }} #{{ $invoice->id }}
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
                    <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Client Selection -->
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Client</label>
                            <select name="client_id" id="client_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200">
                                <option value="">Select a client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Appointment Selection (Optional) -->
                        <div>
                            <label for="appointment_id" class="block text-sm font-medium text-gray-700">Related Appointment (Optional)</label>
                            <select name="appointment_id" id="appointment_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select an appointment</option>
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" {{ $invoice->appointment_id == $appointment->id ? 'selected' : '' }}>{{ $appointment->appointment_date }} - {{ $appointment->service_type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="amount" id="amount" step="0.01" required value="{{ $invoice->amount }}" class="mt-1 block w-full pl-7 pr-12 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <!-- Invoice Date -->
                        <div>
                            <label for="invoice_date" class="block text-sm font-medium text-gray-700">Invoice Date</label>
                            <input type="date" name="invoice_date" id="invoice_date" required value="{{ $invoice->invoice_date_formatted }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- Due Date -->
                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                            <input type="date" name="due_date" id="due_date" required value="{{ $invoice->due_date_formatted }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="unpaid" {{ $invoice->status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="paid" {{ $invoice->status === 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>

                        <!-- Transaction Details (Optional) -->
                        <div>
                            <label for="transaction" class="block text-sm font-medium text-gray-700">Transaction Details (Optional)</label>
                            <textarea name="transaction" id="transaction" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter any additional transaction details">{{ $invoice->transaction }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('invoices.show', $invoice) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Invoice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>