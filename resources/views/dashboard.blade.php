<x-app-layout>
    <div class="py-6 bg-vet-light-bg dark:bg-vet-dark-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-vet-primary-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <div>
                            <h2 class="text-2xl font-bold text-vet-light-text-primary dark:text-white">Dashboard</h2>
                            <p class="text-sm text-vet-light-text-secondary">Welcome to VetCare Management System</p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('appointments.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm font-medium rounded-lg shadow-vet transition-all duration-150 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            New Appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <main class="flex-1 max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <!-- Removed Quick Links Bar -->

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach([
                            ['label' => 'Total Clients', 'count' => $counts['clients'], 'color' => 'blue', 'icon' => 'users'],
                            ['label' => 'Total Pets', 'count' => $counts['pets'], 'color' => 'green', 'icon' => 'paw'],
                            ['label' => 'Appointments', 'count' => $counts['appointments'], 'color' => 'purple', 'icon' => 'calendar'],
                            ['label' => 'Visits', 'count' => $counts['visits'], 'color' => 'yellow', 'icon' => 'clipboard'],
                            ['label' => 'Invoices', 'count' => $counts['invoices'], 'color' => 'red', 'icon' => 'document'],
                            ['label' => 'Medical Records', 'count' => $counts['records'], 'color' => 'indigo', 'icon' => 'document-text']
                        ] as $stat)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 border-l-4 border-{{ $stat['color'] }}-500">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-{{ $stat['color'] }}-100 dark:bg-{{ $stat['color'] }}-800 rounded-full p-3">
                                            <!-- Dynamically render the icon component -->
                                            <x-dynamic-component :component="'icons.' . $stat['icon']" class="w-6 h-6 text-{{ $stat['color'] }}-600"/>
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

                    <!-- Charts Section -->
                    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Clients Chart -->
                        <div class="bg-vet-light-card dark:bg-vet-dark-card border border-vet-light-border dark:border-vet-dark-border rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-semibold text-vet-light-text-primary dark:text-white mb-4">
                                New Clients This Month
                            </h3>
                            <div class="h-[300px]">
                                <canvas id="clientsChart"></canvas>
                            </div>
                        </div>

                        <!-- Pets Chart -->
                        <div class="bg-vet-light-card dark:bg-vet-dark-card border border-vet-light-border dark:border-vet-dark-border rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-semibold text-vet-light-text-primary dark:text-white mb-4">
                                Pets by Species
                            </h3>
                            <div class="h-[300px]">
                                <canvas id="petsChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity & Quick Actions -->
                    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Recent Activity -->
                        <div class="bg-vet-light-card dark:bg-vet-dark-card border border-vet-light-border dark:border-vet-dark-border rounded-lg shadow-lg">
                            <div class="p-6">
                                <h3 class="text-lg leading-6 font-medium text-vet-light-text-primary dark:text-white flex items-center">
                                    <svg class="h-5 w-5 text-vet-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Recent Activity
                                </h3>
                                <x-activity-feed :activities="$activities" />
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-vet-light-card dark:bg-vet-dark-card border border-vet-light-border dark:border-vet-dark-border rounded-lg shadow-lg">
                            <div class="p-6">
                                <h3 class="text-lg leading-6 font-medium text-vet-light-text-primary dark:text-white flex items-center">
                                    <svg class="h-5 w-5 text-vet-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Quick Actions
                                </h3>
                                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <a href="{{ route('appointments.create') }}" 
                                       class="inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-vet-primary-500 hover:bg-vet-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vet-primary-500 transition-colors duration-150">
                                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        New Appointment
                                    </a>
                                    <a href="{{ route('clients.create') }}" 
                                       class="inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-vet-secondary-500 hover:bg-vet-secondary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vet-secondary-500 transition-colors duration-150">
                                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        New Client
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function getThemeColors() {
            const isDark = document.documentElement.classList.contains('dark');
            return {
                text: isDark ? '#F9FAFB' : '#111827',
                grid: isDark ? '#374151' : '#E5E7EB',
                primary: '#219fa3',
                secondary: '#0c8ce9'
            };
        }

        // Prepare chart data
        const chartData = {
            clients: {!! json_encode([
                'data' => \App\Models\Client::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->groupBy('date')
                    ->get()
                    ->pluck('count')
                    ->toArray()
            ]) !!},
            pets: {!! json_encode([
                'labels' => \App\Models\Pet::distinct('species')->pluck('species')->toArray(),
                'data' => \App\Models\Pet::selectRaw('species, COUNT(*) as count')
                    ->groupBy('species')
                    ->pluck('count')
                    ->toArray()
            ]) !!}
        };

        // Clients Chart
        const clientsCtx = document.getElementById('clientsChart');
        const daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();
        const lastThirtyDays = [...Array(daysInMonth)].map((_, i) => i + 1);

        new Chart(clientsCtx, {
            type: 'line',
            data: {
                labels: lastThirtyDays,
                datasets: [{
                    label: 'New Clients',
                    data: chartData.clients.data,
                    borderColor: getThemeColors().primary,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: ({ chart }) => {
                        const ctx = chart.ctx;
                        const gradient = ctx.createLinearGradient(0, 0, 0, chart.height);
                        gradient.addColorStop(0, `${getThemeColors().primary}33`);
                        gradient.addColorStop(1, `${getThemeColors().primary}05`);
                        return gradient;
                    }
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `New Clients: ${context.parsed.y}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: getThemeColors().text
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: getThemeColors().text
                        }
                    }
                }
            }
        });

        // Pets Chart
        const petsCtx = document.getElementById('petsChart');
        new Chart(petsCtx, {
            type: 'doughnut',
            data: {
                labels: chartData.pets.labels,
                datasets: [{
                    data: chartData.pets.data,
                    backgroundColor: [
                        '#219fa3',
                        '#0c8ce9',
                        '#e74694',
                        '#059669',
                        '#d97706'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: getThemeColors().text
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return `${context.label}: ${context.parsed} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    </script>
    @endpush

</x-app-layout>
