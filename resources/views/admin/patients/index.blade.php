<x-admin-layout title="Pacientes" :breadcrumbs="[
[
    'name'=>'Dashboard',
    'href'=>route('admin.dashboard')
],
[

'name'=>'Pacientes',
]
]">

    <x-slot name="action">
        <x-wire-button blue href="{{route('admin.patients.create')}}">
            <i class="fas fa-plus"></i>
            Nuevo
        </x-wire-button>

    </x-slot>
    @livewire('admin.datatables.patient-table')

</x-admin-layout>