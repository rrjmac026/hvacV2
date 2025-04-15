{{-- show.blade.php --}}
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Visit Details</h2>
                        <div class="flex space-x-3">
                            <a href="{{ route('visits.edit', $visit) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('visits.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <!-- Visit Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Visit Information</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Client</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">{{ $visit->client->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Pet</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">{{ $visit->pet->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Visit Date</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">{{ $visit->visit_date->format('M d, Y h:i A') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">{{ ucfirst($visit->status) }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Medical Details</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Diagnosis</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">{{ $visit->diagnosis }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Treatment</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">{{ $visit->treatment }}</dd>
                                </div>
                                @if($visit->notes)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Additional Notes</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">{{ $visit->notes }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
