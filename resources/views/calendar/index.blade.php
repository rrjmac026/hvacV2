<x-app-layout>
    @push('styles')
        <!-- FullCalendar CSS -->
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
        <style>
            .fc {
                height: 800px;
                background: white;
                padding: 20px;
                border-radius: 0.5rem;
            }
            .dark .fc {
                background: #1f2937;
            }
            .fc-header-toolbar {
                margin-bottom: 1.5em !important;
            }
            .fc-toolbar-title {
                font-size: 1.2em !important;
            }
            .fc-button-primary {
                background-color: #219fa3 !important;
                border-color: #219fa3 !important;
            }
            .dark .fc-button-primary {
                background-color: #374151 !important;
                border-color: #4b5563 !important;
            }
        </style>
    @endpush

    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-vet-light-bg dark:bg-vet-dark-bg min-h-screen">
        <!-- Page Header -->
        <div class="mb-6 bg-vet-light-card dark:bg-vet-dark-card rounded-lg shadow-vet p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-2xl text-vet-primary-500 mr-3"></i>
                    <div>
                        <h2 class="text-2xl font-bold text-vet-light-text-primary dark:text-white">Calendar</h2>
                        <p class="text-sm text-vet-light-text-secondary">Manage appointments and schedules</p>
                    </div>
                </div>
                <a href="{{ route('appointments.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 hover:from-vet-primary-600 hover:to-vet-primary-700 text-white text-sm font-medium rounded-lg shadow-vet transition-all duration-150">
                    <i class="fas fa-plus-circle mr-2"></i>
                    New Appointment
                </a>
            </div>
        </div>

        <!-- Calendar Container -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <div id="calendar"></div>
        </div>
    </div>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.3/main.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.3/main.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.11.3/main.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.3/main.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var appointments = @json($appointments);
                
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'dayGrid', 'timeGrid', 'interaction' ],
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    selectable: true,
                    editable: true,
                    events: appointments,
                    eventClick: function(info) {
                        window.location.href = '/appointments/' + info.event.id;
                    },
                    eventDidMount: function(info) {
                        info.el.title = `Client: ${info.event.extendedProps.client}\nPet: ${info.event.extendedProps.pet}\nStatus: ${info.event.extendedProps.status}`;
                    }
                });
                
                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
