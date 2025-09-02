<x-admin-layout title="Consultas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Consultas Medicas',
    ],
    [
        'name' => 'Detalles',
    ],
]">


    <x-wire-card>
        <x-slot name="title">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Detalle de la Cita
                </h1>
                <p class="text-sm text-gray-500">Fecha:{{ $appointment->date->format('d/m/Y') }} <br></p>
            </div>
        </x-slot>

        <div class="grid grid-col-1 lg:grid-cols-2 gap-6">
            <div>
                <h2 class="font-semibold text-gray-5000 text-xs uppercase">Paciente</h2>
                <p class="text-lg font-semibold text-gray-700">{{ $appointment->patient->user->name }}</p>
            </div>

            <div>
                <h2 class="font-semibold text-gray-5000 text-xs uppercase">Medico</h2>
                <p class="text-lg font-semibold text-gray-700">{{ $appointment->doctor->user->name }}</p>
                <p class="text-sm text-gray-6000">{{ $appointment->doctor->speciality->name }}</p>
            </div>
        </div>
        <hr class="my-4">

        <div>
            <h3 class="font-semibold text-gray-800 mb-2">
                Diagnostico
            </h3>
            <p>{{ $appointment->consultation->diagnosis ?? 'Sin diagnostico' }}</p>
        </div>
        <hr class="my-4">

        <div>
            <h3 class="font-semibold text-gray-800 mb-2">
                Plan de Tratamiento
            </h3>
            <p>{{ $appointment->consultation->treatment ?? 'Sin Tratamiento' }}</p>
        </div>
        <hr class="my-4">

        <div>
            <h3 class="font-semibold text-gray-800 mb-2">
                Receta Medica
            </h3>
            <ul class="space-y-3">
                @foreach ($appointment->prescriptions as $prescription)
                    <li>
                        <p><strong>Medicamentos:</strong>{{$prescription['medicine']}} <br></p>
                        <p><strong>Dosis:</strong>{{$prescription['dosage']}} <br></p>
                        <p><strong>Instrucciones:</strong>{{$prescription['frequency']}} <br></p>
                    </li>
                @endforeach
            </ul>
        </div>
    </x-wire-card>


</x-admin-layout>
