<div class="mt-4 space-y-4">
    @forelse($activities as $activity)
        <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
                @switch($activity->type)
                    @case('appointment_created')
                        <i class="fas fa-calendar-plus text-green-500"></i>
                        @break
                    @case('client_added')
                        <i class="fas fa-user-plus text-blue-500"></i>
                        @break
                    @case('pet_registered')
                        <i class="fas fa-paw text-purple-500"></i>
                        @break
                    @case('visit_completed')
                        <i class="fas fa-clipboard-check text-yellow-500"></i>
                        @break
                    @case('invoice_generated')
                        <i class="fas fa-file-invoice-dollar text-red-500"></i>
                        @break
                    @default
                        <i class="fas fa-circle text-gray-500"></i>
                @endswitch
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $activity->description }}
                </p>
                <span class="text-xs text-gray-500 dark:text-gray-500">
                    {{ $activity->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
    @empty
        <div class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
            No recent activity
        </div>
    @endforelse
</div>
