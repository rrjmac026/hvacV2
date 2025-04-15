<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                    Inventory Details
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                    Detailed information about the inventory item.
                </p>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700">
                <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Item Name</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $inventory->name }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $inventory->category }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $inventory->quantity }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Unit Cost</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">₱{{ number_format($inventory->unit_cost, 2) }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                        <dd class="mt-1">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $inventory->status === 'in_stock' ? 'bg-green-100 text-green-800' : 
                                   ($inventory->status === 'low_stock' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ str_replace('_', ' ', ucfirst($inventory->status)) }}
                            </span>
                        </dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Supplier</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $inventory->supplier ?: 'Not specified' }}</dd>
                    </div>
                    @if($inventory->notes)
                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</dt>
                            <dd class="mt-1 text-gray-900 dark:text-white sm:mt-0 sm:col-span-2 whitespace-pre-wrap">{{ $inventory->notes }}</dd>
                        </div>
                    @endif
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Value</dt>
                        <dd class="mt-1 text-2xl font-bold text-vet-primary-600 dark:text-vet-primary-400 sm:mt-0 sm:col-span-2">
                            ₱{{ number_format($inventory->quantity * $inventory->unit_cost, 2) }}
                        </dd>
                    </div>
                </dl>
                <div class="mt-6 flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('inventory.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Inventory
                    </a>
                    <a href="{{ route('inventory.edit', $inventory) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm rounded-md shadow-sm">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Stock
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>