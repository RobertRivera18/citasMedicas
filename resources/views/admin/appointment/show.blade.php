<x-admin-layout title="Consultas" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Consultas Médicas'],
    ['name' => 'Detalles'],
]">

    <x-wire-card>
        <x-slot name="title">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detalle de la Cita</h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Fecha: {{ $appointment->date->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </x-slot>

        {{-- Datos principales --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Paciente</h2>
                <p class="text-lg font-semibold text-gray-800 mt-1">{{ $appointment->patient->user->name }}</p>
                <p class="text-sm text-gray-600">{{ $appointment->patient->user->email }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Médico</h2>
                <p class="text-lg font-semibold text-gray-800 mt-1">{{ $appointment->doctor->user->name }}</p>
                <p class="text-sm text-gray-600">{{ $appointment->doctor->speciality->name }}</p>
            </div>
        </div>

        {{-- Diagnóstico --}}
        <div class="mt-6">
            <h3 class="text-base font-semibold text-gray-800 border-b pb-2">Diagnóstico</h3>
            <p class="mt-2 text-gray-700">
                {{ $appointment->consultation->diagnosis ?? 'No disponible' }}
            </p>
        </div>

        {{-- Tratamiento --}}
        <div class="mt-6">
            <h3 class="text-base font-semibold text-gray-800 border-b pb-2">Plan de Tratamiento</h3>
            <p class="mt-2 text-gray-700">
                {{ $appointment->consultation->treatment ?? 'No disponible' }}
            </p>
        </div>

        {{-- Receta --}}
        @isset($appointment->consultation->prescriptions)
            <div class="mt-6">
                <h3 class="text-base font-semibold text-gray-800 border-b pb-2">Receta Médica</h3>
                <ul class="mt-3 divide-y divide-gray-200">
                    @foreach ($appointment->consultation->prescriptions as $prescription)
                        <li class="py-3">
                            <p class="text-gray-800"><strong>Medicamento:</strong> {{ $prescription['medicine'] }}</p>
                            <p class="text-gray-800"><strong>Dosis:</strong> {{ $prescription['dosage'] }}</p>
                            <p class="text-gray-800"><strong>Instrucciones:</strong> {{ $prescription['frequency'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endisset

        {{-- Notas del médico (solo doctor) --}}
        @role('Doctor')
            <div class="mt-6">
                <h3 class="text-base font-semibold text-gray-800 border-b pb-2">Notas del Médico</h3>
                <p class="mt-2 text-gray-700">
                    {{ $appointment->consultation->notes ?? 'No hay notas disponibles' }}
                </p>
            </div>
        @endrole
    </x-wire-card>
</x-admin-layout>
