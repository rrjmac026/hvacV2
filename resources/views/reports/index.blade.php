<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <!-- Page Header -->
        <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-chart-bar text-2xl text-vet-primary-500 mr-3"></i>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Reports</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Generate and download system reports</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Generator Card -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Generate Report</h2>
                
                <form id="reportForm" method="POST" action="{{ route('reports.generate') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Report Type</label>
                            <select name="type" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                                @foreach($reportTypes as $type)
                                    <option value="{{ $type['value'] }}">{{ $type['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                            <input type="date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                            <input type="date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-vet-primary-500 hover:bg-vet-primary-600 text-white rounded-lg transition-colors duration-150">
                            <i class="fas fa-file-pdf mr-2"></i>
                            Generate PDF Report
                        </button>
                    </div>
                    <input type="hidden" name="format" value="pdf">
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($reportTypes as $type)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $type['label'] }}</div>
                        <div class="mt-2 flex items-center">
                            <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($type['count']) }}</div>
                            <div class="ml-2 flex-shrink-0">
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $type['count'] > 0 ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                    Total
                                </span>
                            </div>
                        </div>
                        @if($type['latest'])
                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                <i class="fas fa-clock mr-1 text-gray-400"></i>
                                Last updated {{ $type['latest'] }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('reportForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const format = formData.get('format');
            
            if (format === 'pdf') {
                // For PDF, submit the form normally
                form.submit();
                return;
            }
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                });
                
                const result = await response.json();
                displayReport(result, formData.get('type'));
            } catch (error) {
                console.error('Error:', error);
                alert('Error generating report. Please try again.');
            }
        });

        function displayReport(data, type) {
            const container = document.getElementById('reportResults');
            const content = document.getElementById('reportContent');
            container.classList.remove('hidden');
            
            // Implement your report display logic here based on the type
            content.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
        }
    </script>
    @endpush
</x-app-layout>
