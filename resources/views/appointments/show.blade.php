<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Client Details') }}
            </h2>
            <a href="{{ route('clients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to List</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Client Information -->
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <div class="h-12 w-12 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center">
                                    <span class="text-emerald-600 dark:text-emerald-200 font-medium text-xl">{{ substr($client->name, 0, 1) }}</span>
                                </div>
                                <h3 class="ml-4 font-bold text-xl text-emerald-600 dark:text-emerald-400">{{ $client->name }}</h3>
                            </div>
                            <div class="space-y-3">
                                <p class="text-gray-600 dark:text-gray-300"><span class="font-medium">Email:</span> {{ $client->email }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><span class="font-medium">Phone:</span> {{ $client->phone }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><span class="font-medium">Address:</span> {{ $client->address ?? 'N/A' }}</p>
                            </div>
                            <div class="mt-6 flex space-x-4">
                                <a href="{{ route('clients.edit', $client->id) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <span>Edit Information</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
