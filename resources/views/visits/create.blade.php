{{-- create.blade.php --}}
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">New Visit Record</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Create a new visit record for a pet</p>
                    </div>

                    <form action="{{ route('visits.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Client Selection -->
                            <div>
                                <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Client</label>
                                <select name="client_id" id="client_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                                    <option value="">Select Client</option>
                                    @foreach(\App\Models\Client::all() as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pet Selection (Dynamic, populated via JS) -->
                            <div>
                                <label for="pet_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pet</label>
                                <select name="pet_id" id="pet_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                                    <option value="">Select Pet</option>
                                </select>
                            </div>

                            <!-- Visit Date -->
                            <div>
                                <label for="visit_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Visit Date</label>
                                <input type="datetime-local" name="visit_date" id="visit_date" required
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="status" id="status" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <!-- Diagnosis -->
                        <div>
                            <label for="diagnosis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Diagnosis</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" required
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700"></textarea>
                        </div>

                        <!-- Treatment -->
                        <div>
                            <label for="treatment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Treatment</label>
                            <textarea name="treatment" id="treatment" rows="3" required
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700"></textarea>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Additional Notes</label>
                            <textarea name="notes" id="notes" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700"></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('visits.index') }}" 
                               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Create Visit Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('client_id').addEventListener('change', async function() {
            const clientId = this.value;
            const petSelect = document.getElementById('pet_id');
            
            petSelect.innerHTML = '<option value="">Select Pet</option>';
            
            if (clientId) {
                try {
                    const response = await fetch(`/api/clients/${clientId}/pets`);
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    
                    const pets = await response.json();
                    
                    if (pets && pets.length > 0) {
                        pets.forEach(pet => {
                            const option = document.createElement('option');
                            option.value = pet.id;
                            option.textContent = pet.name;
                            petSelect.appendChild(option);
                        });
                    } else {
                        petSelect.innerHTML = '<option value="">No pets found</option>';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    petSelect.innerHTML = '<option value="">Error loading pets</option>';
                }
            }
        });
    </script>
    @endpush
</x-app-layout>