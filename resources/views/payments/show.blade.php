<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Payment Details') }} #{{ $payment->id }}
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
                    <!-- Payment Status Banner -->
                    <div class="mb-6 flex items-center justify-between bg-emerald-50 dark:bg-emerald-900/20 p-4 rounded-lg">
                        <div class="flex items-center space-x-2">
                            <span class="text-emerald-700 dark:text-emerald-300 font-semibold">Amount Paid:</span>
                            <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">${{ number_format($payment->amount, 2) }}</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Payment Date: {{ $payment->payment_date->format('M d, Y') }}</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $payment->payment_method === 'cash' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' }}">
                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                            </span>
                        </div>
                    </div>

                    <!-- Payment Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Invoice Information -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Invoice Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Invoice Number:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">#{{ $payment->invoice->id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Invoice Amount:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">${{ number_format($payment->invoice->amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Invoice Date:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $payment->invoice->invoice_date->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Client Information -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Client Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Name:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $payment->invoice->client->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Email:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $payment->invoice->client->email }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Phone:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $payment->invoice->client->phone }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        @if($payment->notes)
                        <div class="col-span-full bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Payment Notes</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $payment->notes }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('payments.edit', $payment) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300 ease-in-out">Edit Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>