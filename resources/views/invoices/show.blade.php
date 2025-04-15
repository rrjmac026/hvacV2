<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoice #{{ $invoice->id }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('invoices.edit', $invoice) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit Invoice</a>
                <a href="{{ route('invoices.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to List</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Invoice Status Banner -->
                    <div class="mb-6 p-4 {{ $invoice->status === 'paid' ? 'bg-green-100' : 'bg-red-100' }} rounded-lg">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-semibold {{ $invoice->status === 'paid' ? 'text-green-800' : 'text-red-800' }}">
                                Status: {{ ucfirst($invoice->status) }}
                            </span>
                            <span class="text-lg font-bold">
                                Total Amount: ${{ number_format($invoice->amount, 2) }}
                            </span>
                        </div>
                    </div>

                    <!-- Invoice Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Client Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Client Information</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Name:</span> {{ $invoice->client->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $invoice->client->email }}</p>
                                <p><span class="font-medium">Phone:</span> {{ $invoice->client->phone }}</p>
                                <p><span class="font-medium">Address:</span> {{ $invoice->client->address }}</p>
                            </div>
                        </div>

                        <!-- Invoice Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Invoice Details</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Invoice Date:</span> {{ $invoice->invoice_date_formatted }}</p>
                                <p><span class="font-medium">Due Date:</span> {{ $invoice->due_date_formatted }}</p>
                                @if($invoice->appointment)
                                    <p><span class="font-medium">Related Appointment:</span> {{ $invoice->appointment->appointment_date }} - {{ $invoice->appointment->service_type }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Transaction Details -->
                    @if($invoice->transaction)
                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Transaction Details</h3>
                            <p class="whitespace-pre-line">{{ $invoice->transaction }}</p>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="mt-6 border-t pt-6">
                        <div class="flex justify-between items-center">
                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Invoice</button>
                            </form>
                            @if($invoice->status === 'unpaid')
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Mark as Paid</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>