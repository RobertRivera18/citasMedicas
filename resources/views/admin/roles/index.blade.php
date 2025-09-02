<x-admin-layout title="Roles" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
    ],
]">
    @can('create_role')
        <x-slot name="action">
            <x-wire-button blue href="{{ route('admin.roles.create') }}">
                <i class="fas fa-plus"></i>
                Nuevo
            </x-wire-button>

        </x-slot>
    @endcan

    @livewire('admin.datatables.role-table')
</x-admin-layout>
