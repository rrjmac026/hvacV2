<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <!-- Page Header -->
        <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-box text-2xl text-vet-primary-500 mr-3"></i>
                    <div>
                        <h2 class="text-2xl font-bold text-vet-light-text-primary dark:text-white">Products</h2>
                        <p class="text-sm text-vet-light-text-secondary">Manage inventory and supplies</p>
                    </div>
                </div>
                <a href="{{ route('products.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm font-medium rounded-lg shadow-vet transition-all duration-150">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Add Product
                </a>
            </div>
        </div>

        <!-- Products Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($product->description, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-vet-primary-100 text-vet-primary-800">
                                        {{ $product->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    ₱{{ number_format($product->price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm {{ $product->stock > 10 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('products.show', $product) }}" class="text-vet-primary-600 hover:text-vet-primary-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
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
                                    No products found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
