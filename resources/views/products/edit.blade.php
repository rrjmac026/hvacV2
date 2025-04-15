<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <div class="max-w-3xl mx-auto">
            <!-- Page Header -->
            <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-edit text-2xl text-vet-primary-500 mr-3"></i>
                        <h2 class="text-xl font-bold text-vet-light-text-primary dark:text-white">Edit Product</h2>
                    </div>
                </div>
            </div>

            <!-- Product Form -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                <form action="{{ route('products.update', $product) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="3" 
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stock -->
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stock</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                                @error('stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                <input type="text" name="category" id="category" value="{{ old('category', $product->category) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm rounded-md shadow-sm">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
