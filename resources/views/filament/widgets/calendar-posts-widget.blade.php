<div class="p-4 bg-white rounded-xl shadow-md">
    <h2 class="text-lg font-semibold mb-4">{{ $this->getHeading() }}</h2>

    {{-- FullCalendar --}}
    <div id="calendar"></div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 600,
                    events: @json($events),
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay',
                    },
                });
                calendar.render();
            });
        </script>
    @endpush
</div>
