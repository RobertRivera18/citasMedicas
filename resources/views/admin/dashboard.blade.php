<x-admin-layout title="Dashboard" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
]">


    @role('Admin')
        @include('admin.dashboard.admin')
    @endrole

    @role('Doctor')
        @include('admin.dashboard.doctor')
    @endrole
    @role('Paciente')
        @include('admin.dashboard.patient')
    @endrole
</x-admin-layout>
