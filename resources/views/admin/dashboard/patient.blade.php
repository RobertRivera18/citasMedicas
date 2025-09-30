<div>
    <x-wire-card>
        <div class="text-center">
            <p class="text-2xl font-semibold text-gray-800">
                Bienvenido, {{ auth()->user()->name }}
            </p>
            <p class="mt-2 text-gray-600">
                Aqui tienes un resumen de tu panel de control.
            </p>

            <div class="flex justify-center mt-4">
                <x-wire-button href="{{ route('admin.appointments.index') }}">
                    Reservar nueva cita
                </x-wire-button>
            </div>
        </div>
    </x-wire-card>



    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Próxima cita -->
        <div>
            <x-wire-card>
                <div class="flex items-center gap-2">
                    <!-- Icono reloj -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-lg font-semibold text-gray-900">Ultima Cita</p>
                </div>

                @if ($data['next_appointment'])
                    <div class="mt-4 space-y-2">
                        <p class="text-base md:text-lg font-semibold text-gray-800">
                            {{ $data['next_appointment']->patient->user->name }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ $data['next_appointment']->patient->user->email }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $data['next_appointment']->date->format('d/m/Y') }}
                            a las {{ $data['next_appointment']->start_time->format('H:i') }}
                        </p>
                        <x-wire-button
                            href="{{ route('admin.appointments.consultation', $data['next_appointment']->id) }}"
                            class="mt-4 w-full">
                            Gestionar Cita
                        </x-wire-button>
                    </div>
                @else
                    <p class="mt-4 text-gray-600 text-sm">No tienes citas programadas para hoy</p>
                @endif
            </x-wire-card>
        </div>

        <!-- Agenda del día -->
        <div class="lg:col-span-2">
            <x-wire-card>
                <div class="flex items-center gap-2">
                    <!-- Icono lista -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <p class="text-lg font-semibold text-gray-900">Citas Pasadas</p>
                </div>

                <ul class="mt-4 divide-y divide-gray-200">
                    @forelse ($data['past_appointments'] as $appointment)
                        <li class="py-3 flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                            <div class="flex items-center gap-3">
                                <!-- Icono usuario -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">
                                        {{ $appointment->doctor->user->name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $appointment->date->format('d/m/Y') }}
                                        a las {{ $appointment->start_time->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('admin.appointments.show', $appointment->id) }}"
                                class="text-sm font-medium text-indigo-600 hover:underline">
                                Ver Consulta
                            </a>
                        </li>
                    @empty
                        <p class="py-3 text-sm text-gray-500">No tienes citas pasadas registradas</p>
                    @endforelse
                </ul>
            </x-wire-card>
        </div>
    </div>
</div>
