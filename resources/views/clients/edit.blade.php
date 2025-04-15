<x-app-layout>
    <div class="py-6 bg-vet-light-bg dark:bg-vet-dark-bg">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-lg">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-vet-light-border dark:border-vet-dark-border">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-vet-light-text-primary dark:text-white">
                            Edit Client Information
                        </h2>
                        <a href="{{ route('clients.show', $client) }}" 
                           class="inline-flex items-center px-3 py-2 border border-vet-light-border dark:border-vet-dark-border rounded-md text-sm text-vet-light-text-primary dark:text-white hover:bg-vet-light-hover dark:hover:bg-vet-dark-hover transition-colors duration-150">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Details
                        </a>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('clients.update', $client) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-vet-primary-600 dark:text-vet-primary-400">
                            Basic Information
                        </h3>
                        
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-vet-light-text-primary dark:text-gray-200">
                                    Full Name
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $client->name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-vet-light-text-primary dark:text-gray-200">
                                    Email Address
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email', $client->email) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-vet-light-text-primary dark:text-gray-200">
                                    Phone Number
                                </label>
                                <input type="tel" 
                                       name="phone" 
                                       id="phone" 
                                       value="{{ old('phone', $client->phone) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-vet-light-text-primary dark:text-gray-200">
                                Address
                            </label>
                            <textarea name="address" 
                                      id="address" 
                                      rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-vet-primary-500 focus:ring-vet-primary-500">{{ old('address', $client->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-vet-light-border dark:border-vet-dark-border">
                        <button type="button" 
                                onclick="window.history.back()"
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-vet-light-text-primary dark:text-gray-300 hover:bg-vet-light-hover dark:hover:bg-vet-dark-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vet-primary-500">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vet-primary-500">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
