<x-admin-layout title="Consultas" :breadcrumbs="[
[
    'name'=>'Dashboard',
    'href'=>route('admin.dashboard')
],
[

'name'=>'Consultas Medicas',
]
]">
<x-slot name="action">
        <x-wire-button blue href="{{route('admin.appointments.create')}}">
            <i class="fas fa-plus"></i>
            Nuevo
        </x-wire-button>

    </x-slot>
 

</x-admin-layout>