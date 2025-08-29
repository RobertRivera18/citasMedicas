<x-admin-layout title="Calendario de Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Calendario de Citas',
    ],
]">

    @push('css')
        <style>
            .fc-event {
                cursor: pointer;
            }
        </style>
    @endpush


    <div x-data="data()">
        <x-wire-modal-card title="Cita Médica" name="appointmentModal">
            <div class="space-y-6">
                <!-- Fecha -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <strong class="text-gray-700">📅 Fecha y hora:</strong>
                    <span class="text-gray-900 font-medium" x-text="selectedEvent.dateTime"></span>
                </div>

                <!-- Paciente -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <strong class="text-gray-700">🧑 Paciente:</strong>
                    <span class="text-gray-900 font-medium" x-text="selectedEvent.patient"></span>
                </div>

                <!-- Doctor -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <strong class="text-gray-700">👨‍⚕️ Doctor:</strong>
                    <span class="text-gray-900 font-medium" x-text="selectedEvent.doctor"></span>
                </div>

                <!-- Estado -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <strong class="text-gray-700">📌 Estado:</strong>
                    <span class="px-3 py-1 text-sm rounded-full"
                        :class="{
                            'bg-green-100 text-green-700': selectedEvent.status === 'Confirmada',
                            'bg-yellow-100 text-yellow-700': selectedEvent.status === 'Pendiente',
                            'bg-red-100 text-red-700': selectedEvent.status === 'Cancelada'
                        }"
                        x-text="selectedEvent.status">
                    </span>
                </div>
            </div>


            <a x-bind:href="selectedEvent.url" class="w-full">
                <x-wire-button class="w-full">
                    Gestionar Cita
                </x-wire-button>
               </x-wire-modal-card>
        </a>

        <div x-ref="calendar">
        </div>
    </div>

    @push('js')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
        <script>
            function data() {
                return {
                    selectedEvent: {
                        dateTime: null,
                        patient: null,
                        doctor: null,
                        status: null,
                        color: null,
                        url: null,
                    },

                    openModal(info) {
                        this.selectedEvent = {
                            dateTime: info.event.extendedProps.dateTime,
                            patient: info.event.extendedProps.patient,
                            doctor: info.event.extendedProps.doctor,
                            status: info.event.extendedProps.status,
                            color: info.event.extendedProps.color,
                            url: info.event.extendedProps.url,
                        };
                        $openModal('appointmentModal');
                    },
                    init() {
                        var calendarEl = this.$refs.calendar;
                        var calendar = new FullCalendar.Calendar(calendarEl, {

                            headerToolbar: {
                                left: 'prev,next,today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                            },
                            locale: 'es',

                            buttonText: {
                                today: 'Hoy',
                                month: 'Mes',
                                week: 'Semana',
                                day: 'Día',
                                list: 'Lista'
                            },
                            allDayText: 'Todo el Dia',
                            noEventsText: 'No hay Eventos',

                            initialView: 'timeGridWeek',
                            slotDuration: '00:15:00',
                            slotMinTime: "{{ config('schedule.start_time') }}",
                            slotMaxTime: "{{ config('schedule.end_time') }}",
                            events: {
                                url: "{{ route('api.appointments.index') }}",
                                failure: function() {
                                    alert('Hubo un error al cargar los eventos.');
                                }
                            },
                            eventClick: (info) => this.openModal(info),
                            scrollTime: "{{ date('H:i:s') }}"

                        });
                        calendar.render();

                    }
                }
            }
        </script>
    @endpush

</x-admin-layout>
