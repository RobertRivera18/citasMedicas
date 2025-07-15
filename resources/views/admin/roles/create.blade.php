<x-admin-layout title="Roles" :breadcrumbs="[
[
    'name'=>'Dashboard',
    'href'=>route('admin.dashboard')
],
[

'name'=>'Roles',
'href'=>route('admin.roles.index')
],
[

'name'=>'Nuevo',
]
]">


    <x-wire-card>
        <form action="{{route('admin.roles.store')}}">
            @csrf
            <x-wire-input 
            label="Nombre"
            name="name"
            palceholder="Nombre del rol"
            />
        </form>
    </x-wire-card>
</x-admin-layout>