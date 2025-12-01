<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edición de Punto de partida') }}
        </h2>
    </x-slot>

    <div class="grid px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8">
        <div class="px-3 bg-white">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

                    <div>
                        <div class="grid gap-4 p-4 mt-4 mb-4 ml-1 bg-blue-100 border border-gray-400 lg:grid-cols-4">

                            <div class="w-full px-4 mb-4 col-span-3">
                                <x-jet-label value="Dirección" />
                                <x-jet-input type="text" class="w-full uppercase" wire:model.defer="direccion" />
                                <x-jet-input-error for="direccion" />
                            </div>



                            <div class="w-full px-4 mb-4">
                                <x-jet-label value="Departamento" />
                                <select wire:model="department_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione el motivo de traslado" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($departments as $department)
                                        {{-- se puso esto para que $department->id sea por ejemplo "01" y no 1 --}}
                                        <option value="{{ str_pad($department->id, 2, '0', STR_PAD_LEFT) }}">
                                            {{ $department->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="department_id" />

                            </div>

                            <div class="w-full px-4 mb-4">
                                <x-jet-label value="Provincia" />
                                <select wire:model="province_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione Provincia" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ str_pad($province->id, 4, '0', STR_PAD_LEFT) }}">
                                            {{ $province->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="province_id" />

                            </div>

                            <div class="w-full px-4 mb-4">
                                <x-jet-label value="Distrito" />
                                <select wire:model="district_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione Distrito" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ str_pad($district->id, 6, '0', STR_PAD_LEFT) }}">
                                            {{ $district->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="district_id" />

                            </div>


                            <!-- Número MTC -->
                            <div class="w-full px-4 mb-4">
                                <x-jet-label value="Ubigeo" />
                                <x-jet-input wire:model.defer="ubigeo" type="text" placeholder="Ubigeo"
                                    class="w-full h-10" />
                                <x-jet-input-error for="ubigeo" />
                            </div>

                            <!-- Predeterminado -->
                            <div class="w-full px-4 mb-4">
                                <x-jet-label value="Predeterminado" />
                                <input type="checkbox" wire:model="predeterminado"
                                    class="h-5 w-5 text-indigo-600 border-gray-300 rounded">
                                <x-jet-input-error for="predeterminado" />
                            </div>

                            <!-- Estado -->
                            <div class="w-full px-4 mb-4">
                                <x-jet-label value="Estado" />
                                <input type="checkbox" wire:model="state"
                                    class="h-5 w-5 text-indigo-600 border-gray-300 rounded">
                                <x-jet-input-error for="state" />
                            </div>




                        </div>

                        <!-- Botón Actualizar -->
                        <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="update"
                            class="w-full mt-4 mb-3 disabled:opacity-25">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar
                        </x-jet-button>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
