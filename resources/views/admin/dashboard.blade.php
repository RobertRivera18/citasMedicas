<x-admin-layout title="Dashboard" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
]">


    @role('Admin')
        @include('admin.dashboard.admin')
    @endrole
</x-admin-layout>
