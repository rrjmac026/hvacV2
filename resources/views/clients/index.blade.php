<x-app-layout>
    <div class="py-6 bg-vet-light-bg dark:bg-vet-dark-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-vet-primary-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <h2 class="text-2xl font-bold text-vet-light-text-primary dark:text-white">Pet Parents</h2>
                            <p class="text-sm text-vet-light-text-secondary">Manage your client records</p>
                        </div>
                    </div>
                    <a href="{{ route('clients.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm font-medium rounded-lg shadow-vet transition-all duration-150 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        New Pet Parent
                    </a>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Search pet parents by name, email, or phone..." 
                           class="w-full pl-10 pr-4 py-2 border border-vet-light-border rounded-lg focus:ring-2 focus:ring-vet-primary-500 focus:border-vet-primary-500">
                    <div class="absolute left-3 top-2.5 text-vet-light-text-secondary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Client List -->
            <div class="bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet overflow-hidden">
                <table class="min-w-full divide-y divide-vet-light-border dark:divide-vet-dark-border">
                    <thead class="bg-vet-light-muted dark:bg-vet-dark-card">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-vet-light-text-secondary dark:text-gray-400">
                                Pet Parent Details
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-vet-light-text-secondary dark:text-gray-400">
                                Contact Information
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-vet-light-text-secondary dark:text-gray-400">
                                Pets
                            </th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-vet-light-border dark:divide-vet-dark-border">
                        @foreach($clients as $client)
                        <tr class="hover:bg-vet-light-hover dark:hover:bg-vet-dark-hover transition-all duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <span class="h-10 w-10 rounded-full bg-vet-primary-100 dark:bg-vet-primary-700 flex items-center justify-center">
                                            <span class="text-vet-primary-700 dark:text-vet-primary-100 font-medium text-sm">
                                                {{ substr($client->name, 0, 2) }}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-vet-light-text-primary dark:text-white">
                                            {{ $client->name }}
                                        </div>
                                        <div class="text-sm text-vet-light-text-secondary dark:text-gray-400">
                                            Added {{ $client->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-vet-light-text-primary dark:text-white">
                                    {{ $client->email }}
                                </div>
                                <div class="text-sm text-vet-light-text-secondary dark:text-gray-400">
                                    {{ $client->phone }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex -space-x-2">
                                    @foreach($client->pets as $pet)
                                    <div class="h-8 w-8 rounded-full bg-vet-secondary-100 dark:bg-vet-secondary-700 flex items-center justify-center" 
                                         title="{{ $pet->name }}">
                                        <span class="text-xs text-vet-secondary-700 dark:text-vet-secondary-100">
                                            {{ substr($pet->name, 0, 1) }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium space-x-3">
                                <a href="{{ route('clients.show', $client) }}" 
                                   class="text-vet-primary-500 hover:text-vet-primary-600">
                                    View
                                </a>
                                <a href="{{ route('clients.edit', $client) }}" 
                                   class="text-vet-secondary-500 hover:text-vet-secondary-600">
                                    Edit
                                </a>
                                <button type="button"
                                        onclick="confirm('Are you sure?') && document.getElementById('delete-client-{{ $client->id }}').submit()"
                                        class="text-vet-accent-500 hover:text-vet-accent-600">
                                    Delete
                                </button>
                                <form id="delete-client-{{ $client->id }}" 
                                      action="{{ route('clients.destroy', $client) }}" 
                                      method="POST" 
                                      class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
