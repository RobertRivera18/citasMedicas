<div>
    <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="col-span-2">
            <x-wire-card>
                <p class="text-2xl font-bold text-gray-800">
                    !Buen dia, Dr(a). {{ auth()->user()->name }}
                </p>
                <p class="mr-1 text-gray-600">Aqui esta el resumen de tu Jornada</p>
            </x-wire-card>
        </div>
        <div>
            <x-wire-card>
                <p class="text-sm font-semibold text-gray-500">
                    Citas de Hoy
                </p>
                <p class="mt-2 text-2xl font-semibold text-gray-800">
                    {{ $data['appointments_today_count'] }}
                </p>
            </x-wire-card>
        </div>

        <div>
            <x-wire-card>
                <p class="text-sm font-semibold text-gray-500">
                    Citas de Hoy
                </p>
                <p class="mt-2 text-2xl font-semibold text-gray-800">
                    {{ $data['appointments_today_count'] }}
                </p>
            </x-wire-card>
        </div>

    </div>
    <div class="grid grid-cols-3 gap-6">
        <div>
            <x-wire-card>
                <p class=" text-lg font-semibold text-gray-900">Proxima Cita</p>
                @if ($data['next_appointment'])
                    <p class="mt-4 font-semibold text-gray-800 text-lg">
                        {{ $data['next_appointment']->patient->user->name }}</p>
                    {{ $data['next_appointment']->patient->user->email }}</p>

                    <p class="mb-6 text-gray-600">{{ $data['next_appointment']->date->format('d/m/Y') }}a las
                        {{ $data['next_appointment']->start_time->format('H:i:s') }} </p>

                    <x-wire-button href="{{ route('admin.appointments.consultation', $data['next_appointment']->id) }}"
                        class="mt-4 w-full">
                        Gestionar Cita
                    </x-wire-button>
                @else
                    <p class="mt-4 text-lg text-gray-600">No tienes citas programadas para hoy</p>
                @endif
            </x-wire-card>
        </div>

        <div class="col-span-2">
            <x-wire-card>
                <p class="font-semibold text-lg text-gray-800">Agenda para hoy</p>
                <ul class="mt-4 divide-y divide-gray-200">
                    @forelse ($data['appointments_today_count'] as $appointment)
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $appointment->patient->user->name }}
                                </p>
                                <p class="text-sm font-semibold text-gray-500">{{ $appointment->date->format('d/m/Y') }}
                                </p>
                            </div>
                            <a href=""></a>
                        </li>
                    @empty
                    @endforelse
                </ul>
            </x-wire-card>
        </div>
    </div>
</div>
