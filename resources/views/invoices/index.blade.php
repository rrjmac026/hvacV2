<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <!-- Page Header -->
        <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-file-invoice-dollar text-2xl text-vet-primary-500 mr-3"></i>
                    <div>
                        <h2 class="text-2xl font-bold text-vet-light-text-primary dark:text-white">Invoices</h2>
                        <p class="text-sm text-vet-light-text-secondary">Manage billing and payment records</p>
                    </div>
                </div>
                <a href="{{ route('invoices.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm font-medium rounded-lg shadow-vet transition-all duration-150">
                    <i class="fas fa-plus-circle mr-2"></i>
                    New Invoice
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <!-- Search and Filter Section -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <form action="{{ route('invoices.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Search invoices..." 
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-vet-primary-500 focus:ring-vet-primary-500">
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-vet-primary-500 hover:bg-vet-primary-600 text-white rounded-lg transition-colors duration-150">
                            <i class="fas fa-search mr-2"></i>
                            Search
                        </button>
                        <a href="{{ route('invoices.index') }}" 
                            class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-150">
                            <i class="fas fa-redo mr-2"></i>
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Invoices Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Invoice #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($invoices as $invoice)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-vet-primary-600 dark:text-vet-primary-400">
                                        #{{ $invoice->invoice_number }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $invoice->client->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $invoice->date->format('M d, Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        ${{ number_format($invoice->total_amount, 2) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('invoices.show', $invoice) }}" 
                                            class="text-vet-primary-600 hover:text-vet-primary-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('invoices.edit', $invoice) }}" 
                                            class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Are you sure you want to delete this invoice?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No invoices found. Create a new invoice to get started!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</x-app-layout>