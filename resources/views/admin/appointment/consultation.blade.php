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
    @livewire('admin.consultation-manager', ['appointment' => $appointment])

</x-admin-layout>
