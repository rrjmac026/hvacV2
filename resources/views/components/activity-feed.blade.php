<div class="mt-4 space-y-4">
    @forelse($activities as $activity)
        <div class="bg-vet-light-hover dark:bg-vet-dark-hover p-4 rounded-lg hover:bg-opacity-75 transition duration-150 ease-in-out">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <x-dynamic-component 
                        :component="'icons.' . $activity['icon']"
                        class="h-6 w-6 text-vet-{{ $activity['color'] }}-400"
                    />
                </div>
                <div>
                    <p class="text-sm font-medium text-vet-light-text-primary dark:text-white">
                        {{ $activity['title'] }}
                        <span class="font-normal text-vet-light-text-secondary dark:text-gray-300">
                            {{ $activity['description'] }}
                        </span>
                    </p>
                    <p class="text-sm text-vet-light-text-secondary dark:text-gray-400">
                        {{ $activity['date'] }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-4 text-vet-light-text-secondary dark:text-gray-400">
            No recent activity
        </div>
    @endforelse
</div>
