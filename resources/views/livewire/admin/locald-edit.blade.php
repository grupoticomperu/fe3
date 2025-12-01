<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Actualizando el Local') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">


                <div class="flex flex-wrap mx-4 mt-4">
                    <div class="w-full px-4 mb-4 md:w-4/4">
                        <x-jet-label value="Nombre del Local" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="name" />
                        <x-jet-input-error for="name" />
                    </div>

                    <div class="w-full px-4 mb-4 md:w-1/2">
                        <x-jet-label value="Dirección" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="address" />
                        <x-jet-input-error for="address" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/2">
                        <x-jet-label value="Email" />
                        <x-jet-input type="email" class="w-full lowercase" wire:model="email" />
                        <x-jet-input-error for="email" />
                    </div>

                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Departamento" />
                        <select wire:model="department_id"
                            class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                            data-placeholder="Selecccione " style="width:100%">
                            <option value="" selected disabled>Seleccione</option>
                            @foreach ($departments as $department)
                                <option value="{{ str_pad($department->id, 2, '0', STR_PAD_LEFT) }}">
                                    {{ $department->name }}
                                </option>
                            @endforeach

                        </select>
                        <x-jet-input-error for="department_id" />

                    </div>

                    <div class="w-full px-4 mb-4 md:w-1/4">
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

                    <div class="w-full px-4 mb-4 md:w-1/4">
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

                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Código Postal" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="codigopostal" />
                        <x-jet-input-error for="codigopostal" />
                    </div>



                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Teléfono" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="phone" />
                        <x-jet-input-error for="phone" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Celular" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="movil" />
                        <x-jet-input-error for="movil" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Anexo" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="anexo" />
                        <x-jet-input-error for="anexo" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Estado" />
                        <x-jet-input type="checkbox" wire:model="state" />
                        <x-jet-input-error for="state" />
                    </div>

                    {{-- @foreach ($tipocomprobantes as $tipocomprobante)
                        <div class="w-full px-4 mb-4 md:w-1/4">
                            <x-jet-button wire:click="agregar">
                                {{ __($tipocomprobante->namecorto) }}
                            </x-jet-button>
                        </div>
                    @endforeach --}}



                    <section class="w-full px-4 mt-4 antialiased text-gray-600">
                        <div class="flex flex-col justify-center w-full h-full">
                            <!-- Table -->

                                <div class="w-full mx-auto bg-white border border-gray-200 rounded-sm shadow-lg">
                                    <div class="p-3">
                                        <div class="overflow-x-auto">
                                            <table class="w-full table-auto">
                                                <thead class="text-xs font-semibold text-gray-400 uppercase bg-gray-50">
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Comprobante
                                                            </div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Serie
                                                            </div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Número de Inicio
                                                            </div>
                                                        </th>


                                                    </tr>
                                                </thead>
                                                <tbody class="text-sm divide-y divide-gray-100">
                                                    @foreach ($localTipocomprobantes as $localTipocomprobante)
                                                        <tr>

                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="text-left">
                                                                    {{ $localTipocomprobante->tipocomprobante->namecorto }}
                                                                </div>
                                                            </td>


                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="font-medium text-left text-green-500">
                                                                    <input type="text"
                                                                    wire:model="serieValues.{{ $localTipocomprobante->id }}"
                                                                        style="font-size: 1rem!important"
                                                                        class="w-40 text-center uppercase form-control">
                                                                </div>
                                                            </td>

                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="font-medium text-left text-green-500">
                                                                    <input type="text"
                                                                    wire:model="numeroValues.{{ $localTipocomprobante->id }}"
                                                                        style="font-size: 1rem!important"
                                                                        class="w-40 text-center form-control">
                                                                </div>
                                                            </td>




                                                        </tr>
                                                    @endforeach


                                                    {{-- @foreach ($localTipocomprobantes as $localTipocomprobante)
                                                        <div>
                                                            <label>Serie para
                                                                {{ $localTipocomprobante->tipocomprobante->namecorto }}:</label>
                                                            <input type="text"
                                                                wire:model="serieValues.{{ $localTipocomprobante->id }}">
                                                        </div>
                                                        <div>
                                                            <label>Número para
                                                                {{ $localTipocomprobante->tipocomprobante->name }}:</label>
                                                            <input type="text"
                                                                wire:model="numeroValues.{{ $localTipocomprobante->id }}">
                                                        </div>
                                                    @endforeach --}}





                                                </tbody>

                                                <tfoot>


                                                </tfoot>

                                            </table>
                                            {{--  <div>
                                                mtoigv = {{ $mtoigv }} /
                                                mtoigvgratuitas = {{ $mtoigvgratuitas }}  /
                                                icbper= {{ $icbper }}
                                                totalimpuestos={{ $totalimpuestos }}
                                                valorventa={{ $valorventa }}
                                            </div> --}}

                                        </div>
                                    </div>
                                </div>



                        </div>
                    </section>






                    <div class="w-full px-4 mt-6 mb-4">
                        <x-jet-danger-button wire:click="update">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Actualizar Local') }}
                            </x-jet-button>

                            <x-jet-button wire:click="cancel">
                                <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Cancelar') }}
                            </x-jet-button>


                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
