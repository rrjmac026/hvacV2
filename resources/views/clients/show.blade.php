<x-app-layout>
    <div class="py-6 bg-vet-light-bg dark:bg-vet-dark-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Client Header -->
            <div class="bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="h-16 w-16 rounded-full bg-gradient-to-r from-vet-primary-500 to-vet-secondary-500 flex items-center justify-center">
                                <span class="text-2xl font-bold text-white">{{ substr($client->name, 0, 2) }}</span>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-vet-light-text-primary dark:text-white">{{ $client->name }}</h1>
                                <p class="text-sm text-vet-light-text-secondary dark:text-gray-400">Client since {{ $client->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('clients.edit', $client) }}" 
                               class="inline-flex items-center px-4 py-2 bg-vet-primary-500 hover:bg-vet-primary-600 text-white rounded-lg transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Profile
                            </a>
                            <button onclick="confirmDelete()" 
                                    class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-center p-4 bg-vet-light-hover dark:bg-vet-dark-hover rounded-lg">
                            <svg class="w-6 h-6 text-vet-primary-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-vet-light-text-secondary dark:text-gray-400">Email</p>
                                <p class="text-sm font-medium text-vet-light-text-primary dark:text-white">{{ $client->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-vet-light-hover dark:bg-vet-dark-hover rounded-lg">
                            <svg class="w-6 h-6 text-vet-primary-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-vet-light-text-secondary dark:text-gray-400">Phone</p>
                                <p class="text-sm font-medium text-vet-light-text-primary dark:text-white">{{ $client->phone }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-vet-light-hover dark:bg-vet-dark-hover rounded-lg">
                            <svg class="w-6 h-6 text-vet-primary-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-vet-light-text-secondary dark:text-gray-400">Address</p>
                                <p class="text-sm font-medium text-vet-light-text-primary dark:text-white">{{ $client->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pets Section -->
            <div class="bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-vet-light-text-primary dark:text-white">Pets</h2>
                        <a href="{{ route('pets.create', ['client_id' => $client->id]) }}" 
                           class="inline-flex items-center px-3 py-2 bg-vet-secondary-500 hover:bg-vet-secondary-600 text-white text-sm rounded-lg transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Pet
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($client->pets as $pet)
                            <div class="bg-vet-light-hover dark:bg-vet-dark-hover p-4 rounded-lg">
                                <div class="flex items-start space-x-3">
                                    <div class="h-12 w-12 rounded-lg bg-vet-secondary-100 dark:bg-vet-secondary-700 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-vet-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-vet-light-text-primary dark:text-white">{{ $pet->name }}</h3>
                                        <p class="text-sm text-vet-light-text-secondary dark:text-gray-400">{{ $pet->species }} • {{ $pet->breed }}</p>
                                        <div class="mt-2 flex space-x-2">
                                            <a href="{{ route('pets.show', $pet) }}" class="text-xs text-vet-primary-500 hover:text-vet-primary-600">View Details</a>
                                            <a href="{{ route('pets.edit', $pet) }}" class="text-xs text-vet-secondary-500 hover:text-vet-secondary-600">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8 text-vet-light-text-secondary dark:text-gray-400">
                                No pets registered yet
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <form id="deleteForm" action="{{ route('clients.destroy', $client) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this client? This action cannot be undone.')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
    @endpush
</x-app-layout>
