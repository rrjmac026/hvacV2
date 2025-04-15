<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ $pet->name }}'s Profile
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('pets.edit', $pet) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit Pet</span>
                </a>
                <a href="{{ route('pets.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Back to Pets</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-1">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                @if($pet->photo)
                                    <img src="{{ $pet->photo_url }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                                @else
                                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 rounded-lg mb-4 flex items-center justify-center">
                                        <svg class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                @endif
                                <h3 class="text-xl font-bold text-emerald-600 dark:text-emerald-400">{{ $pet->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ $pet->species }} - {{ $pet->breed }}</p>
                                <p class="text-gray-600 dark:text-gray-300">Age: {{ $pet->age }} years</p>
                                <p class="text-gray-600 dark:text-gray-300">Gender: {{ $pet->gender }}</p>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <div class="space-y-6">
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-emerald-700 dark:text-emerald-300 mb-4">Medical History</h4>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $pet->medical_history ?: 'No medical history recorded.' }}</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-emerald-700 dark:text-emerald-300 mb-4">Allergies</h4>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $pet->allergies ?: 'No allergies recorded.' }}</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-emerald-700 dark:text-emerald-300 mb-4">Ongoing Treatments</h4>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $pet->ongoing_treatments ?: 'No ongoing treatments.' }}</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-emerald-700 dark:text-emerald-300 mb-4">Vaccinations</h4>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $pet->vaccinations ?: 'No vaccinations recorded.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('pets.edit', $pet->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span>Edit Pet</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>