<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Create New Payment') }}
            </h2>
            <a href="{{ route('payments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Payments</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
                <div class="p-8">
                    <form action="{{ route('payments.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Invoice Selection -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Payment Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="invoice_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Invoice</label>
                                    <select name="invoice_id" id="invoice_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Choose an invoice</option>
                                        @foreach($invoices as $invoice)
                                            <option value="{{ $invoice->id }}">Invoice #{{ $invoice->id }} - {{ $invoice->client->name }} ({{ $invoice->amount }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="relative">
                                    <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Amount</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="amount" id="amount" step="0.01" required class="pl-7 mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Payment Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="payment_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Date</label>
                                    <input type="date" name="payment_date" id="payment_date" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                </div>

                                <div>
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method</label>
                                    <select name="payment_method" id="payment_method" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="cash">Cash</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="debit_card">Debit Card</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="check">Check</option>
                                    </select>
                                </div>

                                <div class="col-span-2">
                                    <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes (Optional)</label>
                                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Enter any additional payment details or notes"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('payments.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out">
                                Cancel
                            </a>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out">
                                Create Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>