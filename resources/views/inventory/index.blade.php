<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <!-- Page Header -->
        <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-boxes text-2xl text-vet-primary-500 mr-3"></i>
                    <div>
                        <h2 class="text-2xl font-bold text-vet-light-text-primary dark:text-white">Inventory Management</h2>
                        <p class="text-sm text-vet-light-text-secondary">Track and manage your product inventory</p>
                    </div>
                </div>
                <a href="{{ route('inventory.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm font-medium rounded-lg shadow-vet transition-all duration-150">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Add Stock
                </a>
            </div>
        </div>

        <!-- Inventory Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Expiry Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($inventories as $inventory)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $inventory->product->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $inventory->batch_number }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $inventory->quantity }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">₱{{ number_format($inventory->unit_cost, 2) }} each</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $inventory->status === 'in_stock' ? 'bg-green-100 text-green-800' : 
                                           ($inventory->status === 'low_stock' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ str_replace('_', ' ', ucfirst($inventory->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $inventory->expiry_date ? $inventory->expiry_date->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('inventory.show', $inventory) }}" class="text-vet-primary-600 hover:text-vet-primary-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('inventory.edit', $inventory) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('inventory.destroy', $inventory) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No inventory items found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $inventories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
