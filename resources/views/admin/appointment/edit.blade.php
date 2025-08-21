<x-admin-layout title="Editar Consulta" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Consultas Medicas',
    ],
    [
        'name' => 'Editar',
    ],
]">


    <x-wire-card class="mb-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-lg font-medium">Editando cita para:
                    <span class="font-bold text-indigo-700">
                        {{ $appointment->patient->user->name }}
                    </span>
                </p>
                <p class="text-sm text-slate-500">
                    Fecha de la Cita:
                    <span class="font-semibold text-slate-700">
                        {{ $appointment->date->format('d/m/Y') }} a las
                        {{ $appointment->start_time->format('H:i:s') }}
                    </span>
                </p>
            </div>
            <div>
                <x-wire-badge flat :label="$appointment->status->label()" :color="$appointment->status->color()" />


            </div>
        </div>
    </x-wire-card>
    @livewire('appointment-manager', [
        'appointmentEdit' => $appointment,
    ])
</x-admin-layout>
