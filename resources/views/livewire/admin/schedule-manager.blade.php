<div>
    <x-wire-card>
        <h1 class="text-xl font-semibold mb-4">Gestor de Horarios</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-3 py-6 text-left text-sm font-medium text-gray-500 tracking-wider">Dia/Hora

                        </th>
                        @foreach ($days as $day)
                        <th class="px-3 py-6 text-left text-sm font-medium text-gray-500 tracking-wider">
                            {{$day}}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($this->hourBlocks as $hourBlock)
                    @php
                    $hour=$hourBlock->format('H:i:s')
                    @endphp
                    <tr>
                        <td class="px-6 y-4 whitespace-nowrap">
                            <span class="font-bold">{{$hour}}</span>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </x-wire-card>
</div>