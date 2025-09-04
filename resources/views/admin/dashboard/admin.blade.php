<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Métricas principales --}}
    <x-wire-card class="p-6 flex items-center justify-between hover:shadow-lg transition">
        <div>
            <p class="text-sm font-medium text-gray-500">Total de Pacientes</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $data['total_patients'] }}</p>
        </div>
        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
            <x-heroicon-o-user-group class="w-6 h-6"/>
        </div>
    </x-wire-card>

    <x-wire-card class="p-6 flex items-center justify-between hover:shadow-lg transition">
        <div>
            <p class="text-sm font-medium text-gray-500">Total de Doctores</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $data['total_doctors'] }}</p>
        </div>
        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
            <x-heroicon-o-briefcase class="w-6 h-6"/>
        </div>
    </x-wire-card>

    <x-wire-card class="p-6 flex items-center justify-between hover:shadow-lg transition">
        <div>
            <p class="text-sm font-medium text-gray-500">Citas para Hoy</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $data['appointments_today'] }}</p>
        </div>
        <div class="bg-green-100 text-green-600 p-3 rounded-full">
            <x-heroicon-o-calendar class="w-6 h-6"/>
        </div>
    </x-wire-card>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Usuarios recientes --}}
    <div class="lg:col-span-2">
        <x-wire-card class="p-6">
            <p class="text-lg font-semibold text-gray-800 mb-4">Usuarios Registrados Recientemente</p>
            <ul class="divide-y divide-gray-200">
                @forelse ($data['recent_users'] as $user)
                    <li class="py-3 flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                    </li>
                @empty
                    <p class="text-sm text-gray-500">No hay usuarios recientes</p>
                @endforelse
            </ul>
        </x-wire-card>
    </div>

    {{-- Acciones rápidas --}}
    <div>
        <x-wire-card class="p-6">
            <p class="text-lg font-semibold text-gray-900 mb-4">Acciones Rápidas</p>
            <div class="space-y-3">
                <x-wire-button class="w-full flex items-center justify-center gap-2" href="{{ route('admin.patients.index') }}" indigo>
                    <x-heroicon-o-user class="w-5 h-5"/> Gestionar Pacientes
                </x-wire-button>
                <x-wire-button class="w-full flex items-center justify-center gap-2" href="{{ route('admin.doctors.index') }}" blue>
                    <x-heroicon-o-briefcase class="w-5 h-5"/> Gestionar Doctores
                </x-wire-button>
                <x-wire-button class="w-full flex items-center justify-center gap-2" href="{{ route('admin.appointments.index') }}" gray>
                    <x-heroicon-o-calendar class="w-5 h-5"/> Gestionar Citas
                </x-wire-button>
            </div>
        </x-wire-card>
    </div>
</div>
