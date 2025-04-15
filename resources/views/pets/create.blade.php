<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-emerald-800 dark:text-emerald-200 leading-tight">
                {{ __('Add New Pet') }}
            </h2>
            <a href="{{ route('pets.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Pets</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
                <div class="p-8">
                    <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <!-- Pet Owner Section -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Pet Parent Information</h3>
                            <div>
                                <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Pet Parent</label>
                                <select name="client_id" id="client_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">Select a pet parent</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Pet Details Section -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Pet Details</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pet Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Species -->
                                <div>
                                    <label for="species" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Species</label>
                                    <input type="text" name="species" id="species" value="{{ old('species') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                    @error('species')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Breed -->
                                <div>
                                    <label for="breed" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Breed</label>
                                    <input type="text" name="breed" id="breed" value="{{ old('breed') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                    @error('breed')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Age -->
                                <div>
                                    <label for="age" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Age (years)</label>
                                    <input type="number" name="age" id="age" value="{{ old('age') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                    @error('age')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                                    <select name="gender" id="gender" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Select gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Photo -->
                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pet Photo</label>
                                    <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-emerald-50 file:text-emerald-700
                                        hover:file:bg-emerald-100
                                        dark:file:bg-emerald-900 dark:file:text-emerald-300
                                        dark:hover:file:bg-emerald-800">
                                    @error('photo')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Medical Information Section -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                            <h3 class="text-lg font-medium text-emerald-700 dark:text-emerald-300">Medical Information</h3>
                            
                            <!-- Medical History -->
                            <div>
                                <label for="medical_history" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medical History</label>
                                <textarea name="medical_history" id="medical_history" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('medical_history') }}</textarea>
                                @error('medical_history')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Allergies -->
                            <div>
                                <label for="allergies" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Allergies</label>
                                <textarea name="allergies" id="allergies" rows="2" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('allergies') }}</textarea>
                                @error('allergies')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Ongoing Treatments -->
                            <div>
                                <label for="ongoing_treatments" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ongoing Treatments</label>
                                <textarea name="ongoing_treatments" id="ongoing_treatments" rows="2" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('ongoing_treatments') }}</textarea>
                                @error('ongoing_treatments')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-full font-medium transition duration-300 ease-in-out flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span>Create Pet</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>