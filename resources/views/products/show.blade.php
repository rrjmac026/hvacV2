<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <div class="max-w-3xl mx-auto">
            <!-- Page Header -->
            <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-box text-2xl text-vet-primary-500 mr-3"></i>
                        <h2 class="text-xl font-bold text-vet-light-text-primary dark:text-white">Product Details</h2>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('products.edit', $product) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-md">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fas fa-trash mr-2"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                <div class="p-6">
                    <dl class="grid grid-cols-1 gap-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Product Name</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $product->name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-300">{{ $product->description ?: 'No description available' }}</dd>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Price</dt>
                                <dd class="mt-1 text-lg font-semibold text-vet-primary-600 dark:text-vet-primary-400">₱{{ number_format($product->price, 2) }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Stock</dt>
                                <dd class="mt-1">
                                    <span class="px-2 inline-flex text-sm font-semibold rounded-full {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->stock }} units
                                    </span>
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</dt>
                                <dd class="mt-1">
                                    <span class="px-2 inline-flex text-sm font-semibold rounded-full bg-vet-primary-100 text-vet-primary-800">
                                        {{ $product->category ?: 'Uncategorized' }}
                                    </span>
                                </dd>
                            </div>
                        </div>
                    </dl>

                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('products.index') }}" class="text-vet-primary-600 hover:text-vet-primary-900 dark:text-vet-primary-400 dark:hover:text-vet-primary-300">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
