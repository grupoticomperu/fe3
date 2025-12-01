<div>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Lista de Boletas
            </h2>
        </div>
    </x-slot>


    <div class="max-w-full py-12 mx-auto border-gray-400 sm:px-6 lg:px-8">
        <div class="px-6 py-4 bg-gray-200">
            <div class="grid items-center gap-4 sm:grid-cols-6 lg:grid-cols-12">
                <div class="col-span-1 sm:col-span-4 lg:col-span-3 ">
                    <x-jet-input type="date" wire:model="fechaemision" class="w-full h-10"
                        placeholder="fecha de emisión" />
                    <x-jet-input-error for="fechaemision" />
                </div>

                <div class="col-span-1 sm:col-span-2 lg:col-span-9">
                    <button class="items-center h-10 px-4 btn btn-orange" wire:click="save">
                        <i class="mx-2 fa-regular fa-file"></i> generar Resumen
                    </button>
                </div>
            </div>
        </div>

            <x-table>
                <div class="mt-4">
                    @if ($boletas)
                        {{-- <table class="w-full table-auto"> --}}
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">ID</th>
                                    <th scope="col" class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">Serie Número</th>
                                    <th scope="col" class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">Total</th>
                                    <th scope="col" class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">Fecha de Emisión</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($boletas as $boleta)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $boleta->id }}</td>
                                        <td class="px-4 py-2 border">{{ $boleta->serienumero }}</td>
                                        <td class="px-4 py-2 border">{{ $boleta->total }}</td>
                                        <td class="px-4 py-2 border">{{ $boleta->fechaemision }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay boletas para la fecha seleccionada.</p>
                    @endif
                </div>
            </x-table>

    </div>

</div>
