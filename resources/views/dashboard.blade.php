<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <!-- Page Header -->
        <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-tachometer-alt text-2xl text-vet-primary-500 mr-3"></i>
                    <div>
                        <h2 class="text-2xl font-bold text-vet-light-text-primary dark:text-white">Dashboard</h2>
                        <p class="text-sm text-vet-light-text-secondary">Welcome to VetCare Management System</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('appointments.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm font-medium rounded-lg shadow-vet transition-all duration-150">
                        <i class="fas fa-plus-circle mr-2"></i>
                        New Appointment
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-6">
            @foreach([
                ['label' => 'Total Clients', 'count' => $counts['clients'], 'color' => 'blue', 'icon' => 'fas fa-users'],
                ['label' => 'Total Pets', 'count' => $counts['pets'], 'color' => 'green', 'icon' => 'fas fa-paw'],
                ['label' => 'Appointments', 'count' => $counts['appointments'], 'color' => 'purple', 'icon' => 'fas fa-calendar'],
                ['label' => 'Visits', 'count' => $counts['visits'], 'color' => 'yellow', 'icon' => 'fas fa-clipboard'],
                ['label' => 'Invoices', 'count' => $counts['invoices'], 'color' => 'red', 'icon' => 'fas fa-file-invoice'],
                ['label' => 'Medical Records', 'count' => $counts['records'], 'color' => 'indigo', 'icon' => 'fas fa-file-medical']
            ] as $stat)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <div class="p-6 border-l-4 border-{{ $stat['color'] }}-500">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-{{ $stat['color'] }}-100 dark:bg-{{ $stat['color'] }}-800 rounded-full p-3">
                                <i class="{{ $stat['icon'] }} text-xl text-{{ $stat['color'] }}-600"></i>
                            </div>
                            <div class="ml-5">
                                <div class="text-xl font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($stat['count']) }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $stat['label'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Recent Activity -->
            <div class="bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg leading-6 font-medium text-vet-light-text-primary dark:text-white flex items-center">
                            <i class="fas fa-history text-vet-primary-500 mr-2"></i>
                            Recent Activity
                        </h3>
                        <a href="{{ route('activities.index') }}" 
                           class="text-sm text-vet-primary-600 hover:text-vet-primary-700 dark:text-vet-primary-400 flex items-center">
                            View All
                            <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    <x-activity-feed :activities="$activities->take(2)" />
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-lg">
                <div class="p-6">
                    <h3 class="text-lg leading-6 font-medium text-vet-light-text-primary dark:text-white flex items-center">
                        <i class="fas fa-bolt text-vet-primary-500 mr-2"></i>
                        Quick Actions
                    </h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <a href="{{ route('appointments.create') }}" 
                           class="inline-flex items-center justify-center px-4 py-3 bg-vet-primary-500 hover:bg-vet-primary-600 text-white rounded-lg transition-colors duration-150">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            New Appointment
                        </a>
                        <a href="{{ route('clients.create') }}" 
                           class="inline-flex items-center justify-center px-4 py-3 bg-vet-secondary-500 hover:bg-vet-secondary-600 text-white rounded-lg transition-colors duration-150">
                            <i class="fas fa-user-plus mr-2"></i>
                            New Client
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
