<x-admin-layout title="Crear Consultas Medicas" :breadcrumbs="[
[
    'name'=>'Dashboard',
    'href'=>route('admin.dashboard')
],
[

'name'=>'Consultas Medicas',
'href'=>route('admin.appointments.index')
],
[

'name'=>'Nuevo',
]
]">

@livewire('appointment-manager')
   

</x-admin-layout>