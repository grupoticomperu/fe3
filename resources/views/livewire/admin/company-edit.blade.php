<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="mr-4 text-xl font-semibold leading-tight text-gray-600">
                Configuración de Empresa
            </h2>
            {{-- <x-jet-button wire:click="generateReport">Exportar</x-jet-button> --}}
        </div>
    </x-slot>

    <div class="grid px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8">

        <div class="px-3 bg-white">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div>
                        <div class="p-2 mt-4 bg-blue-100 rounded-lg">
                            <div class="flex mt-2 mb-2 mr-4">
                                <p class="font-semibold">Datos de tu Empresa</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5">

                                <div class="sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="RUC" />
                                        <x-jet-input type="text" wire:model.defer="ruc"
                                            class="w-full h-10 max-w-md uppercase" />
                                        <x-jet-input-error for="ruc" />
                                    </div>
                                </div>

                                <div class="gap-0 sm:col-span-1 lg:col-span-2">
                                    <div class="mr-1">
                                        <x-jet-label value="Razón Social" />
                                        <x-jet-input type="text" wire:model.defer="razonsocial"
                                            class="w-full h-10 uppercase" />
                                        <x-jet-input-error for="razonsocial" />
                                    </div>
                                </div>

                                <div class="sm:col-span-1 lg:col-span-2">
                                    <div class="mr-1">
                                        <x-jet-label value="Nombre Comercial" />
                                        <x-jet-input type="text" wire:model.defer="nombrecomercial"
                                            class="w-full h-10 max-w-md" />
                                        <x-jet-input-error for="nombrecomercial" />
                                    </div>
                                </div>

                            </div>


                            <div class="flex mt-4 mb-2 mr-4">
                                <p class="font-semibold">Dirección</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-12 lg:grid-cols-12">

                                <div class="col-span-1 mb-4 mr-1 sm:col-span-5">
                                    <x-jet-label value="Dirección" />
                                    <x-jet-input wire:model.defer="direccion" type="text" placeholder="Dirección"
                                        class="w-full h-10 p-0 " />
                                    <x-jet-input-error for="direccion" />
                                </div>

                                <div class="col-span-1 mb-4 mr-1 sm:col-span-2">
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

                                <div class="col-span-1 mb-4 mr-1 sm:col-span-2">
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

                                <div class="col-span-1 mb-4 mr-1 sm:col-span-2">
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


                                <div class="sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Ubigeo" />
                                        <x-jet-input type="text" wire:model="ubigeo"
                                            class="w-full h-10 max-w-md uppercase" />
                                        <x-jet-input-error for="ubigeo" />
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="p-2 mt-4 bg-blue-100 rounded-lg">

                            <div class="flex mt-2 mb-2 mr-4">
                                <p class="font-semibold">Datos Sol y Client</p>
                            </div>

                            {{--  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 lg:grid-cols-12"> --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">

                                <div class="sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Sol User" />
                                        <x-jet-input type="text" wire:model.defer="soluser"
                                            class="w-full h-10 max-w-md" />
                                        <x-jet-input-error for="soluser" />
                                    </div>
                                </div>

                                <div class="gap-0 sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Sol pass" />
                                        <x-jet-input type="text" wire:model.defer="solpass"
                                            class="w-full h-10 max-w-md" />
                                        <x-jet-input-error for="solpass" />
                                    </div>
                                </div>

                                <div class="sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Client ID" />
                                        <x-jet-input type="text" wire:model.defer="cliente_id"
                                            class="w-full h-10 max-w-md" />
                                        <x-jet-input-error for="cliente_id" />
                                    </div>
                                </div>

                                <div class="mb-4 sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Client Secret" />
                                        <x-jet-input type="text" wire:model.defer="cliente_secret"
                                            class="w-full h-10 max-w-md" />
                                        <x-jet-input-error for="cliente_secret" />
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="p-2 mt-4 bg-blue-100 rounded-lg">
                            <div class="flex mt-2 mb-2 mr-4">
                                <p class="font-semibold">Moneda y Estado</p>
                            </div>

                            {{--  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 lg:grid-cols-12"> --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">

                                <div class="col-span-1 mb-4 mr-1 sm:col-span-1">
                                    <x-jet-label value="Moneda" />
                                    <select wire:model="currency_id"
                                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                        data-placeholder="Selecccione el motivo de traslado" style="width:100%">
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($currencies as $currency)
                                            {{-- se puso esto para que $currency->id sea por ejemplo "01" y no 1 --}}
                                            <option value="{{ $currency->id }}">
                                                {{ $currency->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <x-jet-input-error for="currency_id" />

                                </div>

                                <div class="gap-0 sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Estado" />
                                        <select wire:model.defer="production"
                                            class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                            data-placeholder="Selecccione el motivo de traslado" style="width:100%">
                                            <option value="" selected disabled>Seleccione</option>
                                            <option value="0">PRUEBA</option>
                                            <option value="1">PRODUCCIÓN</option>
                                        </select>
                                        <x-jet-input-error for="production" />
                                    </div>
                                </div>

                                <div class="sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Celular" />
                                        <x-jet-input type="text" wire:model.defer="celular"
                                            class="w-full h-10 max-w-md uppercase" />
                                        <x-jet-input-error for="celular" />
                                    </div>
                                </div>

                                <div class="sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Teléfono" />
                                        <x-jet-input type="text" wire:model.defer="telefono"
                                            class="w-full h-10 max-w-md uppercase" />
                                        <x-jet-input-error for="telefono" />
                                    </div>
                                </div>


                            </div>

                        </div>


                        <div class="p-2 mt-4 bg-blue-100 rounded-lg">
                            <div class="flex mt-2 mb-2 mr-4">
                                <p class="font-semibold">Correo y SMTP</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-9">

                                <div class="sm:col-span-1 lg:col-span-3">
                                    <div class="mr-1">
                                        <x-jet-label value="Correo" />
                                        <x-jet-input type="text" wire:model.defer="correo" class="w-full h-10" />
                                        <x-jet-input-error for="correo" />
                                    </div>
                                </div>

                                <div class="gap-0 sm:col-span-1 lg:col-span-3">
                                    <div class="mr-1">
                                        <x-jet-label value="SMTP" />
                                        <x-jet-input type="text" wire:model.defer="smtp" class="w-full h-10" />
                                        <x-jet-input-error for="smtp" />
                                    </div>
                                </div>

                                <div class="sm:col-span-1 lg:col-span-2">
                                    <div class="mr-1">
                                        <x-jet-label value="Password" />
                                        <x-jet-input type="text" wire:model.defer="password" class="w-full h-10" />
                                        <x-jet-input-error for="password" />
                                    </div>
                                </div>

                                <div class="mb-4 sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Puerto" />
                                        <x-jet-input type="text" wire:model.defer="puerto" class="w-full h-10" />
                                        <x-jet-input-error for="puerto" />
                                    </div>
                                </div>


                            </div>
                        </div>

                        <hr class="mt-5 mb-5">

                        <div class="p-2 mt-4 bg-blue-100 rounded-lg">
                            <div class="flex mt-2 mb-2 mr-4">
                                <p class="font-semibold">Certificado Digital</p>
                            </div>


                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2">


                            </div>


                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2">


                                <div class="sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        {{-- <label class="block mb-1 font-semibold">Imagen 1</label> --}}
                                        <x-jet-label value="Cargar Certificado Nuevo" />
                                        <input type="file" wire:model.defer="certificate_path"
                                            accept="image/jpeg,image/png"
                                            class="w-full px-3 py-1 border border-gray-300 rounded-md">
                                        <x-jet-input-error for="certificate_path" />
                                    </div>

                                </div>

                                @if ($certificate_path)
                                    <div class="sm:col-span-1 lg:col-span-1">
                                        <div class="mr-1">
                                            <x-jet-label value="Certificado Nuevo" />
                                            <x-jet-input type="text" wire:model.defer="certificate_path"
                                                class="w-full h-10" />
                                        </div>
                                    </div>
                                @else
                                    <div class="sm:col-span-1 lg:col-span-1">
                                        <div class="mr-1">
                                            <x-jet-label value="Certificado Actual" />
                                            <x-jet-input type="text" wire:model.defer="certificate_pathback"
                                                class="w-full h-10" />
                                        </div>
                                    </div>
                                @endif


                                <div class="gap-0 mt-2 sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Fecha de Inicio Certificado" />
                                        <x-jet-input type="date" wire:model="fechainiciocertificado"
                                            class="w-full h-10"
                                            wire:change="fechaInicioSeleccionada($event.target.value)" />
                                        <x-jet-input-error for="fechainiciocertificado" />
                                    </div>
                                </div>

                                <div class="gap-0 mt-2 mb-4 sm:col-span-1 lg:col-span-1">
                                    <div class="mr-1">
                                        <x-jet-label value="Fecha de Fin Certificado" />
                                        <x-jet-input type="date" wire:model="fechafincertificado"
                                            class="w-full h-10" />
                                        <x-jet-input-error for="fechafincertificado" />
                                    </div>
                                </div>


                            </div>

                        </div>

                        <hr class="mt-5 mb-5">

                        <div class="p-2 mt-4 bg-blue-100 rounded-lg">

                            <div class="flex mt-2 mb-2 mr-4">
                                <p class="font-semibold">Logo</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2">
                                <div class="mr-3 sm:col-span-1 lg:col-span-1">
                                    <div>
                                        {{-- <label class="block mb-1 font-semibold">Imagen 1</label> --}}
                                        <x-jet-label value="Nuevo Logo de tu Empresa" />
                                        <input type="file" wire:model.defer="logo" accept="image/jpeg,image/png"
                                            class="w-full px-3 py-1 border border-gray-300 rounded-md">
                                        <x-jet-input-error for="logo" />
                                    </div>
                                </div>

                                <div wire:loading wire:target="logo"
                                    class="relative col-span-2 px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded sm:col-span-1 lg:col-span-1"
                                    role="alert">
                                    <strong class="font-semibold">Cargando imagen!</strong>
                                    <span class="block sm:inline">Espere un momento.</span>
                                </div>


                                @if ($logo)
                                    <div>
                                        <img class="mt-0 mb-4 ml-2" src="{{ $logo->temporaryUrl() }}" width="200px"
                                            alt="Logo de la Empresa">
                                    </div>
                                @elseif($logoback)

                                    <img src="{{ Storage::disk('s3')->url($logoback) }}" width="200px" alt="">
                                @endif

                            </div>

                        </div>

                        <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                            class="w-full mt-4 mb-3 disabled:opacity-25">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
                        </x-jet-danger-button>





                    </div>
                </div>

            </div>



        </div>

    </div>

</div>
