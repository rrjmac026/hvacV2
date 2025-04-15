<div x-data>
    <!-- Backdrop -->
    <div x-show="$store.sidebar.open" x-cloak
        class="fixed inset-0 z-20 bg-gray-900/50 lg:hidden"
        @click="$store.sidebar.toggle()">
    </div>

    <!-- Sidebar -->
    <div x-cloak
        :class="{ 'translate-x-0': $store.sidebar.open, '-translate-x-full': !$store.sidebar.open }"
        class="fixed left-0 top-16 h-[calc(100vh-4rem)] w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 overflow-y-auto z-30 transform transition-transform duration-300">

        <nav class="flex-1 px-4 py-4 space-y-2">
            @foreach([
                ['route' => 'dashboard', 'icon' => 'fas fa-tachometer-alt', 'label' => 'Dashboard'],
                ['route' => 'clients.index', 'icon' => 'fas fa-users', 'label' => 'Clients'],
                ['route' => 'pets.index', 'icon' => 'fas fa-paw', 'label' => 'Pets'],
                ['route' => 'appointments.index', 'icon' => 'fas fa-calendar', 'label' => 'Appointments'],
                ['route' => 'visits.index', 'icon' => 'fas fa-clipboard', 'label' => 'Visits'],
                ['route' => 'medical_records.index', 'icon' => 'fas fa-file-medical', 'label' => 'Medical Records'],
                ['route' => 'invoices.index', 'icon' => 'fas fa-file-invoice', 'label' => 'Invoices'],
                ['route' => 'products.index', 'icon' => 'fas fa-box', 'label' => 'Products'], // Added Products
                ['route' => 'activities.index', 'icon' => 'fas fa-history', 'label' => 'Activity Log'],
                ['route' => 'reports.index', 'icon' => 'fas fa-chart-bar', 'label' => 'Reports']
            ] as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors duration-200 
                        {{ request()->routeIs($item['route'].'*') 
                            ? 'bg-vet-primary-100 text-vet-primary-700 dark:bg-vet-primary-900 dark:text-vet-primary-300' 
                            : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <i class="{{ $item['icon'] }} w-5"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <!-- Version Info -->
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <div class="p-4 rounded-xl bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 text-white shadow-lg">
                <div class="flex items-center justify-center gap-2">
                    <i class="fas fa-info-circle"></i>
                    <span class="text-sm font-medium">VetCare v1.0</span>
                </div>
            </div>
        </div>
    </div>
</div>
