<div>
    <x-wire-card>
        <p class="text-xl font-semibold mb-1 text-slate-700">Buscar Disponibilidad</p>
        <p>Encuentra el horario perfecto para tu cita</p>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <x-wire-input label="Fecha" type="date" wire:model="search.date" placeholder="Seleccione una fecha" />

            <x-wire-select label="Hora" wire:model="search.hour" placeholder="Selecciona una hora">

                @foreach ($this->hourBlocks as $hourBlock)
                    <x-wire-select.option :label="$hourBlock->copy()->format('H:i:s') .
                        ' - ' .
                        $hourBlock->copy()->addHour()->format('H:i:s')" :value="$hourBlock->format('H:i:s')" />
                @endforeach

            </x-wire-select>

            <x-wire-select label="Especialidad" wire:model="search.speciality_id"
                placeholder="Seleccione una Especialidad">
                @foreach ($specialities as $speciality)
                    <x-wire-select.option :label="$speciality->name" :value="$speciality->id" />
                @endforeach
            </x-wire-select>

            <div class="lg:pt-6.5">
                <x-wire-button wire:click="searchAvailability" class="w-full" color="primary">
                    Buscar Disponibilidad
                </x-wire-button>
            </div>
        </div>
    </x-wire-card>

</div>
