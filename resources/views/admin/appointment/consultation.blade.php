<x-admin-layout title="Editar Consultas Medicas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Consultas Medicas',
        'href' => route('admin.appointments.index'),
    ],
    [
        'name' => 'Consulta',
    ],
]">

    @livewire('admin.consultation-manager', [
        'appointment' => $appointment,
    ])

</x-admin-layout>
