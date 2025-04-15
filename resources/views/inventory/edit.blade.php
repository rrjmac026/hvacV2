<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <div class="max-w-3xl mx-auto">
            <!-- Page Header -->
            <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
                <div class="flex items-center">
                    <i class="fas fa-edit text-2xl text-vet-primary-500 mr-3"></i>
                    <h2 class="text-xl font-bold text-vet-light-text-primary dark:text-white">Edit Inventory Stock</h2>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                <form action="{{ route('inventory.update', $inventory) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Product Selection -->
                        <div>
                            <label for="product_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product</label>
                            <select name="product_id" id="product_id" required 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ $inventory->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Quantity -->
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                                <input type="number" name="quantity" id="quantity" min="0" required 
                                       value="{{ $inventory->quantity }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                            </div>

                            <!-- Unit Cost -->
                            <div>
                                <label for="unit_cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unit Cost</label>
                                <input type="number" step="0.01" name="unit_cost" id="unit_cost" required 
                                       value="{{ $inventory->unit_cost }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Batch Number -->
                            <div>
                                <label for="batch_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Batch Number</label>
                                <input type="text" name="batch_number" id="batch_number" 
                                       value="{{ $inventory->batch_number }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                            </div>

                            <!-- Expiry Date -->
                            <div>
                                <label for="expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expiry Date</label>
                                <input type="date" name="expiry_date" id="expiry_date" 
                                       value="{{ $inventory->expiry_date?->format('Y-m-d') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                            </div>
                        </div>

                        <!-- Supplier -->
                        <div>
                            <label for="supplier" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier</label>
                            <input type="text" name="supplier" id="supplier" 
                                   value="{{ $inventory->supplier }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" id="status" required 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                                @foreach(['in_stock' => 'In Stock', 'low_stock' => 'Low Stock', 'out_of_stock' => 'Out of Stock'] as $value => $label)
                                    <option value="{{ $value }}" {{ $inventory->status === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                            <textarea name="notes" id="notes" rows="3" 
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">{{ $inventory->notes }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('inventory.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm rounded-md shadow-sm">
                            Update Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
