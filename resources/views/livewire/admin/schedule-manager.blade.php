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

                            <label>
                                <input type="checkbox" class="h-4 w-4 border-gray-300 rounded focus:ring-blue-500"
                                    name="" />
                                <span class="font-bold ml-2">
                                    {{$hour}}
                                </span>
                            </label>
                        </td>


                        @foreach ($days as $index=>$day)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col space-y-2">
                                <label>
                                    <input type="checkbox" class="h-4 w-4 border-gray-300 rounded focus:ring-blue-500"
                                        name="" />
                                    <span class="ml-2">Todos</span>
                                </label>

                                @for ($i = 0; $i < $intervals; $i++) @php $startTime=$hourBlock->copy()->addMinutes($i *
                                    $apointment_duration);
                                    $endTime=$startTime->copy()->addMinutes($apointment_duration);;
                                    @endphp
                                    <label>
                                        <input type="checkbox"
                                            class="h-4 w-4 border-gray-300 rounded focus:ring-blue-500" name="" />
                                        <span class="ml-2 text-sm text-medium text-gray-700">
                                            {{$startTime->format('H:i')}} -{{$endTime->format('H:i')}}
                                        </span>

                                    </label>
                                    @endfor
                            </div>
                        </td>
                        @endforeach
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </x-wire-card>
</div>