<div>
    <x-wire-card class="mb-8">
        <div class="lg:flex lg:justify-between lg:items-center">
            <div class="flex items-center space-x-5">
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

            <div class="flex space-x-3 mt-6 lg:mt-0">
                <x-wire-button outline gray>
                    <i class="fa-solid fa-notes-medical"></i>
                    Ver Historial
                </x-wire-button>

                <x-wire-button outline gray>
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
                    <div class="bg-gray-50 p-4 rounded-lg b border flex gap-4"
                        wire:key="prescription-{{ $index }}">
                        <div class="flex-1">
                            <x-wire-input label="Medicamento" placeholder="Ej: Amoxicilina 500mg"
                                wire:model="form.prescriptions.{{ $index }}.medicine" />
                        </div>

                        <div class="w-32">
                            <x-wire-input label="Dosis" placeholder="Ej: 1 Capsula"
                                wire:model="form.prescriptions.{{ $index }}.dosage" />
                        </div>
                        <div class="flex-1">
                            <x-wire-input label="Frecuencia/Duracion" placeholder="cada 8 horas por 7 dias"
                                wire:model="form.prescriptions.{{ $index }}.frequency" />
                        </div>

                        <div class="flex shrink-0 pt-6.5">
                            <x-wire-mini-button sm red
                            icon="trash">
                                
                            </x-wire-mini-button>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>

            <div class="mt-4">
                <x-wire-button outline secondary
                    wire:click="addPrescription">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Añador Medicamento
                </x-wire-button>
            </div>
        </x-tab-content>
    </x-tabs>
    <x-wire-card>

    </x-wire-card>
</div>
