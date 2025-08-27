<div>
    <x-wire-card class="mb-8">
        <div class="lg:flex lg:justify-between lg:items-center">
            <div class="lg:flex lg:items-center space-x-5">
                <img src="{{ $appointment->patient->user->profile_photo_url }}"
                    class="h-20 w-20 rounded-full object-cover object-center"
                    alt="{{ $appointment->patient->user->name }}">
                <div>
                    <p class="text-2xl font-bold text-gray-900 mb-1">
                        {{ $appointment->patient->user->name }}
                    </p>

                    <p class="text-sm font-semibold text-gray-500">
                        DNI: {{ $appointment->patient->user->cedula ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <div class="lg:flex lg:space-x-3 space-y-2 lg:space-y-0 mt-4 lg:mt-0">
                <x-wire-button class="w-full lg:w-auto" outline gray sm x-on:click="$openModal('historyModal')">
                    <i class="fa-solid fa-notes-medical"></i>
                    Ver Historia
                </x-wire-button>

                <x-wire-button class="w-full lg:w-auto" outline gray sm x-on:click="$openModal('previousConsultations')">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    Consultas Anteriores
                </x-wire-button>
            </div>
        </div>
    </x-wire-card>


    <x-tabs active="consulta">
        <x-slot name="header">
            <x-tab-link tab="consulta">
                <i class="fa-solid fa-notes-medical me-2"></i>
                Consulta
            </x-tab-link>
            <x-tab-link tab="receta">
                <i class="fa-solid fa-prescription-bottle-medical me-2"></i>
                Receta
            </x-tab-link>
        </x-slot>

        <x-tab-content tab="consulta">
            <div class="space-y-4">
                <x-wire-textarea label="Diagnostico" placeholder="Describa el diagnostico del paciente..."
                    wire:model="form.diagnosis" />
                <x-wire-textarea label="Tratamiento" placeholder="Describa el Tratamiento del paciente..."
                    wire:model="form.treatment" />
                <x-wire-textarea label="Notas" placeholder="Agregue notas adicionales..." wire:model="form.notes" />
            </div>
        </x-tab-content>

        <x-tab-content tab="receta">
            <div class="space-y-4">
                @forelse ($form['prescriptions'] as $index=> $prescription)
                    <div class="bg-gray-50 p-4 rounded-lg b border lg:flex gap-4 space-y-4 lg:space-y-0"
                        wire:key="prescription-{{ $index }}">
                        <div class="flex-1">
                            <x-wire-input label="Medicamento" placeholder="Ej: Amoxicilina 500mg"
                                wire:model="form.prescriptions.{{ $index }}.medicine" />
                        </div>

                        <div class="lg:w-32">
                            <x-wire-input label="Dosis" placeholder="Ej: 1 Capsula"
                                wire:model="form.prescriptions.{{ $index }}.dosage" />
                        </div>
                        <div class="flex-1">
                            <x-wire-input label="Frecuencia/Duracion" placeholder="cada 8 horas por 7 dias"
                                wire:model="form.prescriptions.{{ $index }}.frequency" />
                        </div>

                        <div class="flex shrink-0 pt-6.5">
                            <x-wire-mini-button sm red icon="trash"
                                wire:click="removePrescriptions({{ $index }})"
                                spinner="removePrescriptions({{ $index }})">

                            </x-wire-mini-button>
                        </div>
                    </div>
                @empty

                    <div class="text-center text-gray-500">
                        No hay medicamentos agregagos en la receta.
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                <x-wire-button outline secondary wire:click="addPrescription" spinner="addPrescription">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Añadir Medicamento
                </x-wire-button>
            </div>
        </x-tab-content>
    </x-tabs>

    <div class="flex justify-end mt-6">
        <x-wire-button 
            wire:click="save"
            spinner="save"
            :disabled="!$appointment->status->isEditable()"
            >
            <i class="fa-solid fa-save mr-2"></i>
            Guardar Consulta
        </x-wire-button>
    </div>




    <x-wire-modal-card title="Historial Médico" name="historyModal" width="5xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-4">
            <div class="bg-gray-50 rounded-2xl shadow-sm p-4 hover:shadow-md transition">
                <p class="text-sm font-medium text-gray-500 mb-1">Tipo de Sangre</p>
                <p class="font-semibold text-gray-800">
                    {{ $patient->bloodType?->name ?? 'No registrado' }}
                </p>
            </div>
            <div class="bg-gray-50 rounded-2xl shadow-sm p-4 hover:shadow-md transition">
                <p class="text-sm font-medium text-gray-500 mb-1">Alergias</p>
                <p class="font-semibold text-gray-800">
                    {{ $patient->allergies ?? 'No registrado' }}
                </p>
            </div>
            <div class="bg-gray-50 rounded-2xl shadow-sm p-4 hover:shadow-md transition">
                <p class="text-sm font-medium text-gray-500 mb-1">Enfermedades Crónicas</p>
                <p class="font-semibold text-gray-800">
                    {{ $patient->cronic_conditions ?? 'No registrado' }}
                </p>
            </div>
            <div class="bg-gray-50 rounded-2xl shadow-sm p-4 hover:shadow-md transition">
                <p class="text-sm font-medium text-gray-500 mb-1">Antecedentes Quirúrgicos</p>
                <p class="font-semibold text-gray-800">
                    {{ $patient->surgical_history ?? 'No registrado' }}
                </p>
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end">
                <a href="{{ route('admin.patients.edit', $patient->id) }}"
                    class="inline-flex items-center px-4 py-2 rounded-xl font-semibold text-white bg-blue-600 hover:bg-blue-700 transition shadow-sm"
                    target="_blank">
                    Ver/Editar Historia Médica
                </a>
            </div>
        </x-slot>
    </x-wire-modal-card>


    <x-wire-modal-card title="Consultas Anteriores" name="previousConsultations" width="4xl">
        @forelse ($previousConsultations as $consultation)
            <a href="{{ route('admin.appointments.show', $consultation->appointment_id) }}"
                class="block p-5 rounded-lg shadow-md border-gray-200 hover:border-indigo-400 hover:shadow-indigo-100 transition-all duration-200"
                target="_blank">

                <div class="lg:flex justify-between items-center space-y-2 lg:space-y-0">

                    <div>
                        <p class="font-semibold text-gray-800 flex items-center">
                            <i class="fa-solid fa-calendar-days text-gray-500 mr-2"></i>
                            {{ $consultation->appointment->date->format('d/m/Y H:i') }}
                        </p>

                        <p>
                            Atendido por:
                            Dr(a). {{ $consultation->appointment->doctor->user->name }}
                        </p>
                    </div>

                    <div>
                        <x-wire-button class="w-full lg:w-auto">
                            VER DETALLE
                        </x-wire-button>
                    </div>

                </div>

            </a>

        @empty

            <div class="text-center py-10 rounded-xl border border-dashed">
                <i class="fa-solid fa-inbox text-4xl text-gray-300"></i>

                <p class="mt-4 text-sm font-medium text-gray-500">
                    No se encontraron consultas anteriores para este paciente.
                </p>

            </div>
        @endforelse
    </x-wire-modal-card>

</div>
