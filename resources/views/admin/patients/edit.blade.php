<x-admin-layout title="Pacientes" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Pacientes',
        'href' => route('admin.patients.index'),
    ],
    [
        'name' => 'Editar',
    ],
]">
    <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
        @csrf
        @method('PUT')

        <x-wire-card class="mb-8">
            <div class="lg:flex lg:justify-between lg:items-center">
                <div class="flex items-center space-x-5">
                    <img src="{{ $patient->user->patient->user->profile_photo_url }}" alt="{{ $patient->user->name }}"
                        class="w-20 h-20 rounded-full object-cover object-center">
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $patient->user->name }}</p>
                    </div>
                </div>

                <div class="flex space-x-3 mt-6 lg:mt-0">
                    <x-wire-button outline black href="{{ route('admin.patients.index') }}">
                        Volver
                    </x-wire-button>
                    <x-wire-button type="submit" primary>
                        <i class="fa-solid fa-check"></i>
                        Guardar Cambios
                    </x-wire-button>
                </div>


            </div>
        </x-wire-card>

        <x-wire-card>
            <div x-data="{ tab: 'datos-personales' }">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                        <li class="me-2">
                            <a href="#" x-on:click.prevent="tab = 'datos-personales'"
                                :class="tab === 'datos-personales'
                                    ?
                                    'text-blue-600 border-b-2 border-blue-600 dark:text-blue-500 dark:border-blue-500' :
                                    'border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"
                                class="inline-flex items-center justify-center p-4 rounded-t-lg group">
                                <i class="fa-solid fa-user me-2"
                                    :class="tab === 'datos-personales' ? 'text-blue-600' : 'text-gray-400'"></i>
                                Datos Personales
                            </a>
                        </li>

                        <li class="me-2">
                            <a href="#" x-on:click.prevent="tab = 'antecedentes'"
                                :class="tab === 'antecedentes'
                                    ?
                                    'text-blue-600 border-b-2 border-blue-600 dark:text-blue-500 dark:border-blue-500' :
                                    'border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"
                                class="inline-flex items-center justify-center p-4 rounded-t-lg group">
                                <i class="fa-solid fa-file-lines me-2"
                                    :class="tab === 'antecedentes' ? 'text-blue-600' : 'text-gray-400'"></i>
                                Antecedentes
                            </a>
                        </li>

                        <li class="me-2">
                            <a href="#" x-on:click.prevent="tab = 'informacion-general'"
                                :class="tab === 'informacion-general'
                                    ?
                                    'text-blue-600 border-b-2 border-blue-600 dark:text-blue-500 dark:border-blue-500' :
                                    'border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"
                                class="inline-flex items-center justify-center p-4 rounded-t-lg group">
                                <i class="fa-solid fa-info me-2"
                                    :class="tab === 'informacion-general' ? 'text-blue-600' : 'text-gray-600'"></i>
                                Información General
                            </a>
                        </li>

                        <li class="me-2">
                            <a href="#" x-on:click.prevent="tab = 'contacto-emergencia'"
                                :class="tab === 'contacto-emergencia'
                                    ?
                                    'text-blue-600 border-b-2 border-blue-600 dark:text-blue-500 dark:border-blue-500' :
                                    'border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"
                                class="inline-flex items-center justify-center p-4 rounded-t-lg group">
                                <i class="fa-solid fa-heart me-2"
                                    :class="tab === 'contacto-emergencia' ? 'text-blue-600' : 'text-blue-400'"></i>
                                Contacto Emergencia
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="p-x-4 mt-4">
                    <div x-show="tab === 'datos-personales'" x-cloak>
                        <div class="grid grid-cols-2 gap-4">
                            <div><span class="text-gray-500 font-semibold text-sm">Telefono:</span></div>
                            <div><span class="text-gray-500 font-semibold text-sm">Email:</span></div>
                            <div><span class="text-gray-500 font-semibold text-sm">Direccion:</span></div>
                        </div>
                    </div>
                    <div x-show="tab === 'antecedentes'" x-cloak>
                        Contenido de Antecedentes
                    </div>
                    <div x-show="tab === 'informacion-general'" x-cloak>
                        Contenido de Información General
                    </div>
                    <div x-show="tab === 'contacto-emergencia'" x-cloak>
                        Contenido de Contacto de Emergencia
                    </div>
                </div>
            </div>
        </x-wire-card>


    </form>

</x-admin-layout>
