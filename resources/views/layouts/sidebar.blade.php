<div x-data class="h-full">
    <!-- Backdrop -->
    <div x-show="$store.sidebar.open" x-cloak
        class="fixed inset-0 z-20 bg-gray-900/50 lg:hidden"
        @click="$store.sidebar.toggle()">
    </div>

    <!-- Sidebar -->
    <div x-show="$store.sidebar.open"
        x-transition:enter="transition-transform ease-in-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform ease-in-out duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed left-0 top-16 h-[calc(100vh-4rem)] w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 overflow-y-auto z-30">

        <div class="p-4 space-y-2">
            @foreach([
                ['route' => 'dashboard', 'icon' => 'home', 'label' => 'Dashboard'],
                ['route' => 'clients.index', 'icon' => 'users', 'label' => 'Clients'],
                ['route' => 'pets.index', 'icon' => 'paw', 'label' => 'Pets'],
                ['route' => 'appointments.index', 'icon' => 'calendar', 'label' => 'Appointments'],
                ['route' => 'visits.index', 'icon' => 'clipboard', 'label' => 'Visits'],
                ['route' => 'medical_records.index', 'icon' => 'document-text', 'label' => 'Medical Records'],
                ['route' => 'invoices.index', 'icon' => 'document', 'label' => 'Invoices'],
                ['route' => 'activities.index', 'icon' => 'clock', 'label' => 'Activity Log'],
                ['route' => 'reports.index', 'icon' => 'chart-bar', 'label' => 'Reports']
            ] as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors duration-200 
                        {{ request()->routeIs($item['route'].'*') 
                            ? 'bg-vet-primary-100 text-vet-primary-700 dark:bg-vet-primary-900 dark:text-vet-primary-300' 
                            : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <x-dynamic-component 
                        :component="'icons.'.$item['icon']"
                        class="w-5 h-5" />
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>

        <!-- Version Info -->
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <div class="p-4 rounded-xl bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 text-white shadow-lg">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium">VetCare v1.0</span>
                </div>
            </div>
        </div>
    </div>
</div>
