<x-admin-layout title="Usuarios" :breadcrumbs="[
[
    'name'=>'Dashboard',
    'href'=>route('admin.dashboard')
],
[

'name'=>'Usuarios',
'href'=>route('admin.users.index')
],
[

'name'=>'Editar',
]
]">


    <x-wire-card>
        <form action="{{route('admin.users.update',$user)}}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div class="grid lg:grid-cols-2 gap-4">
                    <x-wire-input label="Nombre" name="name" required :value="old('name',$user->name)"
                        placeholder="Ingrese el nombre del usuario" />

                    <x-wire-input label="Correo Electronico" name="email" required :value="old('email',$user->email)"
                        placeholder="Ingrese el correo electronico" />
                    <x-wire-input label="Contraseña" name="password" type="password"
                        placeholder="Ingrese la constraseña del usuario" />


                    <x-wire-input label="Cedula" name="cedula" type="text" required :value="old('cedula',$user->cedula)"
                        placeholder="Ingrese la cedula del usuario" />

                    <x-wire-input label="Celular" name="phone" type="text" required :value="old('phone',$user->phone)"
                        placeholder="Ingrese el celular del usuario" />

                </div>

                <x-wire-input label="Direccion" name="address" type="text" required
                    :value="old('address',$user->address)" placeholder="Ingrese la direccion del usuario" />
                {{--Roles---}}
                <x-wire-native-select name="role_id" label="Rol">
                    <option value=""> <span class="font-bold">Seleccione un rol</span> </option>
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}" @selected(old('role_id',$user->roles()->first()->id)==$role->id )
                        >
                        {{$role->name}}
                    </option>
                    @endforeach
                </x-wire-native-select>
                <div class="flex justify-end">
                    <x-wire-button type="submit">
                        Actualizar
                    </x-wire-button>
                </div>
            </div>
        </form>
    </x-wire-card>

</x-admin-layout>