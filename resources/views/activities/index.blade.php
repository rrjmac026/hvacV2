<x-app-layout>
    <div class="py-4 bg-vet-light-bg dark:bg-vet-dark-bg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Bar -->
            <div class="bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-lg p-4 mb-4">
                <div class="flex flex-wrap gap-4 items-center justify-between">
                    <h2 class="text-lg font-semibold text-vet-light-text-primary dark:text-white">Activity History</h2>
                    <div class="flex gap-3">
                        <select name="action" class="text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                            <option value="">All Activities</option>
                            @foreach($distinctActions as $action)
                                <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                    {{ ucfirst($action) }}
                                </option>
                            @endforeach
                        </select>
                        <input type="date" name="date" value="{{ request('date') }}" 
                               class="text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                    </div>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="space-y-4">
                @forelse($activities as $activity)
                    <div class="bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-sm overflow-hidden">
                        <div class="p-4">
                            <!-- Activity Header -->
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $activity->getIconClass() }} bg-opacity-10">
                                        {!! $activity->getIcon() !!}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-vet-light-text-primary dark:text-white truncate">
                                        {{ $activity->description }}
                                    </p>
                                    <p class="text-xs text-vet-light-text-secondary dark:text-gray-400">
                                        {{ $activity->created_at->format('M d, Y g:i A') }} • {{ $activity->causer?->name ?? 'System' }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ match($activity->action) {
                                            'created' => 'bg-green-100 text-green-800',
                                            'updated' => 'bg-blue-100 text-blue-800',
                                            'deleted' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        } }}">
                                        {{ ucfirst($activity->action) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Changes Details -->
                            @if($changes = $activity->getFormattedProperties())
                                <div class="mt-3 border-t border-gray-100 dark:border-gray-700 pt-3">
                                    <div class="grid grid-cols-2 gap-4 text-xs"> <!-- Changed from grid-cols-3 to grid-cols-2 -->
                                        @foreach($changes as $change)
                                            <div class="font-medium text-vet-light-text-primary dark:text-white">
                                                {{ $change['field'] }}
                                            </div>
                                            <div class="text-vet-primary-500 dark:text-vet-primary-400">
                                                {{ $change['new'] ?: '—' }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-vet-light-card dark:bg-vet-dark-card rounded-lg p-8 text-center">
                        <p class="text-vet-light-text-secondary dark:text-gray-400">No activities found</p>
                    </div>
                @endforelse

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $activities->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add filter functionality
        document.querySelectorAll('select[name="action"], input[name="date"]').forEach(element => {
            element.addEventListener('change', () => {
                applyFilters();
            });
        });

        let searchTimeout;
        document.querySelector('input[name="search"]').addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                applyFilters();
            }, 500);
        });

        function applyFilters() {
            const action = document.querySelector('select[name="action"]').value;
            const date = document.querySelector('input[name="date"]').value;
            const search = document.querySelector('input[name="search"]').value;
            
            const params = new URLSearchParams(window.location.search);
            
            if (action) params.set('action', action);
            else params.delete('action');
            
            if (date) params.set('date', date);
            else params.delete('date');
            
            if (search) params.set('search', search);
            else params.delete('search');
            
            window.location.search = params.toString();
        }
    </script>
    @endpush
</x-app-layout>
