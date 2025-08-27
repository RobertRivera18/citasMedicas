<div>
    <x-wire-card class="mb-8">
        <div class="lg:flex lg:justify-between lg:items-center">
            <div class="flex items-center space-x-5">
                <img src="{{ $appointment->patient->user->profile_photo_url }}"
                    class="h-20 w-20 rounded-full object-cover object-center" alt="{{ $appointment->patient->user->name }}">
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
                <x-wire-button outline gray sm>
                    <i class="fa-solid fa-notes-medical"></i>
                   Ver Historial
                </x-wire-button>

                <x-wire-button outline gray sm>
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    Consultas Anteriores
                </x-wire-button>
            </div>
        </div>

    </x-wire-card>
</div>
