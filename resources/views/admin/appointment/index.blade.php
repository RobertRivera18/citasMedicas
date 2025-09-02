<x-admin-layout title="Consultas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Consultas Medicas',
    ],
]">
    @can('create_appointment')
        <x-slot name="action">
            <x-wire-button blue href="{{ route('admin.appointments.create') }}">
                <i class="fas fa-plus"></i>
                Nuevo
            </x-wire-button>

        </x-slot>
    @endcan

    @livewire('admin.datatables.appointment-table')

</x-admin-layout>
