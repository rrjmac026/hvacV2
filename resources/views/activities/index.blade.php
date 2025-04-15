<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <!-- Page Header -->
        <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
            <div class="flex items-center">
                <i class="fas fa-history text-2xl text-vet-primary-500 mr-3"></i>
                <div>
                    <h2 class="text-2xl font-bold text-vet-light-text-primary dark:text-white">Activity Log</h2>
                    <p class="text-sm text-vet-light-text-secondary">View all system activities and changes</p>
                </div>
            </div>
        </div>

        <!-- Activity List -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <div class="p-6">
                <x-activity-feed :activities="$activities" />
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $activities->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
