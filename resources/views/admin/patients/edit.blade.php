<x-admin-layout title="Pacientes" :breadcrumbs="[
[
    'name'=>'Dashboard',
    'href'=>route('admin.dashboard')
],
[

'name'=>'Pacientes',
'href'=>route('admin.patients.index')
],
[

'name'=>'Editar',
]
]">
    <form action="{{route('admin.patients.update',$patient)}}" method="POST">
        @csrf
        @method('PUT')

        <x-wire-card class="mb-8">
            <div class="lg:flex lg:justify-between lg:items-center">
                <div class="flex items-center space-x-5">
                    <img src="{{$patient->user->patient->user->profile_photo_url}}" alt="{{$patient->user->name}}"
                        class="w-20 h-20 rounded-full object-cover object-center">
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{$patient->user->name}}</p>
                    </div>
                </div>

                <div class="flex space-x-3 mt-6 lg:mt-0">
                    <x-wire-button outline black href="{{route('admin.patients.index')}}">
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
            <div class="border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                    <li class="me-2">
                        <a href="#"
                            class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                           <i class="fa-solid fa-user me-2 text-gray-400"></i>
                            Datos Personales
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="#"
                            class="inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group"
                            aria-current="page">
                            <i class="fa-solid fa-file-lines me-2 text-blue-600 group-hover:text-blue-500"></i>
                            Antecedentes
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="#"
                            class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M5 11.424V1a1 1 0 1 0-2 0v10.424a3.228 3.228 0 0 0 0 6.152V19a1 1 0 1 0 2 0v-1.424a3.228 3.228 0 0 0 0-6.152ZM19.25 14.5A3.243 3.243 0 0 0 17 11.424V1a1 1 0 0 0-2 0v10.424a3.227 3.227 0 0 0 0 6.152V19a1 1 0 1 0 2 0v-1.424a3.243 3.243 0 0 0 2.25-3.076Zm-6-9A3.243 3.243 0 0 0 11 2.424V1a1 1 0 0 0-2 0v1.424a3.228 3.228 0 0 0 0 6.152V19a1 1 0 1 0 2 0V8.576A3.243 3.243 0 0 0 13.25 5.5Z" />
                            </svg>Informacion General
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="#"
                            class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 20">
                                <path
                                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                            </svg>Contacto de Emergencia
                        </a>
                    </li>
                    
                </ul>
            </div>
        </x-wire-card>


    </form>

</x-admin-layout>