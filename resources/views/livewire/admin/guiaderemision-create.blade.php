<div>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Guia de Remisión') }}
        </h2>


    </x-slot>

    <div class="grid px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8">

        <div class="px-3 bg-white">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div>


                        {{-- <div class="py-2 mb-1" wire:ignore> --}}
                        <div class="flex mt-2 mb-2 mr-4">
                            <p class="font-semibold">Destinatario</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 lg:grid-cols-12">
                            <div class="col-span-1 sm:col-span-1">
                                <div class="mr-1">
                                    <x-jet-label value="Serie" />
                                    <x-jet-input value="{{ $serie }}" type="text"
                                        class="w-full h-10 max-w-md uppercase" />
                                </div>
                            </div>
                            <div class="col-span-1 sm:col-span-1">
                                <div class="mr-1">
                                    <x-jet-label value="Número" />
                                    <x-jet-input value="{{ $numero }}" type="text"
                                        class="w-full h-10 max-w-md uppercase" />
                                </div>
                            </div>

                            <div class="col-span-1 sm:col-span-2 md:col-span-2">
                                <div class="mr-1">
                                    <x-jet-label value="Fecha Emisión" />
                                    <x-jet-input type="date" max="{{ date('Y-m-d') }}"
                                        min="{{ date('Y-m-d', strtotime('-3 days')) }}" wire:model="fechaemision"
                                        value="{{ old('fechaemision') }}" class="w-full h-10 max-w-md uppercase"
                                        placeholder="fecha de emisión" />
                                    <x-jet-input-error for="fechaemision" />
                                </div>
                            </div>

                            <div class="col-span-1 sm:col-span-1">
                                <div class="mr-1">
                                    <x-jet-label value="Comprobante" />
                                    <x-jet-input value="{{ $comprobante->serienumero }}" type="text"
                                        class="w-full h-10 max-w-md uppercase" />
                                </div>
                            </div>

                            <div class="col-span-1 sm:col-span-1 md:col-span-2">
                                <div class="mr-1">
                                    <x-jet-label value="RUC" />
                                    <x-jet-input value="{{ $comprobante->customer->numdoc }}" type="text"
                                        class="w-full h-10 max-w-md uppercase" />
                                    <x-jet-input-error for="ruc" />
                                </div>
                            </div>
                            <div class="col-span-1 sm:col-span-5 md:col-span-5">
                                <div class="mb-1">
                                    <x-jet-label value="Razón Social" />
                                    <x-jet-input value="{{ $comprobante->customer->nomrazonsocial }}" type="text"
                                        class="w-full h-10 max-w-md uppercase" />
                                    <x-jet-input-error for="razon_social" />
                                </div>
                            </div>


                        </div>




                        <div class="flex mt-4 mb-2 mr-4">
                            <p class="font-semibold">Datos de Envio</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-10 lg:grid-cols-10">

                            <div class="col-span-1 mr-1 sm:col-span-2">
                                {{-- <label>Proveedores </label> --}}
                                <x-jet-label value="Motivo del Traslado" />
                                {{-- select2 --}}
                                <select wire:model="motivotraslado_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione el motivo de traslado" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($motivotraslados as $motivotraslado)
                                        <option value="{{ $motivotraslado->id }}">
                                            {{ $motivotraslado->description }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="motivotraslado_id" />
                            </div>

                            <div class="col-span-1 mr-1 sm:col-span-2">
                                {{-- <label>Proveedores </label> --}}
                                <x-jet-label value="Modalidad del Traslado" />
                                {{-- select2 --}}
                                <select wire:model="modalidaddetraslado"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione modalidad" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    <option value="01">Publico</option>
                                    <option value="02">Privado</option>
                                </select>
                                <x-jet-input-error for="modalidaddetraslado" />
                            </div>



                            <div class="col-span-1 sm:col-span-2 md:col-span-2">
                                <div class="mr-1">
                                    <x-jet-label value="Fecha Traslado" />
                                    <x-jet-input type="date" wire:model="fechadetraslado"
                                        value="{{ old('fechadetraslado') }}" class="w-full h-10 max-w-md uppercase"
                                        placeholder="fecha de traslado" />
                                    <x-jet-input-error for="fechadetraslado" />
                                </div>
                            </div>

                            <div class="col-span-1 mr-1 sm:col-span-2 md:col-span-2">
                                <x-jet-label value="Peso Total" />
                                <x-jet-input wire:model="pesototal" type="number"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="pesototal" />
                            </div>

                            <div class="col-span-1 mr-1 sm:col-span-2">
                                {{-- <label>Proveedores </label> --}}
                                <x-jet-label value="Unidad de medida" />
                                {{-- select2 --}}
                                <select wire:model="um_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione el motivo de traslado" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($ums as $um)
                                        <option value="{{ $um->id }}">
                                            {{ $um->abbreviation }}
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="motivotraslado_id" />
                            </div>


                        </div>



                        @if ($modalidaddetraslado == '01')
                            <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-12">
                                <div class="col-span-1 mr-1 sm:col-span-6">
                                    <x-jet-label value="Transportista" />
                                    <select wire:model="transportista_id"
                                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                        data-placeholder="Seleccione el motivo de traslado" style="width:100%">
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($transportistas as $transportista)
                                            <option value="{{ $transportista->id }}">
                                                {{ $transportista->numdoc }} | {{ $transportista->nomrazonsocial }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="transportista_id" />
                                    {{ $transportista_id }}
                                </div>
                            </div>
                        @elseif($modalidaddetraslado == '02')
                            <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-12">
                                <div class="col-span-1 mr-1 sm:col-span-6">
                                    <x-jet-label value="Conductor" />
                                    <select wire:model="conductor_id"
                                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                        data-placeholder="Seleccione un Conductor" style="width:100%">
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($conductors as $conductor)
                                            <option value="{{ $conductor->id }}">
                                                {{ $conductor->nomape }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{ $conductor_id }}
                                    <x-jet-input-error for="conductor_id" />
                                </div>

                                <div class="col-span-1 mr-1 sm:col-span-6">
                                    <x-jet-label value="Vehiculo" />
                                    <select wire:model="vehiculo_id"
                                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                        data-placeholder="Seleccione un Vehiculo" style="width:100%">
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($vehiculos as $vehiculo)
                                            <option value="{{ $vehiculo->id }}">
                                                {{ $vehiculo->numeroplaca }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="vehiculo_id" />
                                </div>
                            </div>
                        @endif






                        <div class="flex mt-4 mb-2 mr-4">
                            <p class="font-semibold">Punto de Partida</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-12">

                            <div class="col-span-1 mr-1 sm:col-span-6">
                                {{-- <label>Proveedores </label> --}}
                                <x-jet-label value="Dirección" />
                                {{-- select2 --}}
                                <select wire:model="puntodepartida_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione el motivo de traslado" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($puntodepartidas as $puntodepartida)
                                        <option value="{{ $puntodepartida->id }}">
                                            {{ $puntodepartida->direccion }}
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="puntodepartida_id" />
                            </div>
                        </div>
                        {{ $puntodepartida_id }}



                        <div class="flex mt-4 mb-2 mr-4">
                            <p class="font-semibold">Direccion de Llegada</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-12 lg:grid-cols-12">

                            <div class="col-span-1 mb-4 mr-1 sm:col-span-6">
                                <x-jet-label value="Dirección de llegada" />
                                <x-jet-input wire:model.defer="direccionllegada" type="text"
                                    placeholder="Punto de llegada" class="w-full h-10 p-0 " />
                                <x-jet-input-error for="direccionllegada" />
                            </div>

                            <div class="col-span-1 mb-4 mr-1 sm:col-span-2">
                                <x-jet-label value="Departamento" />
                                <select wire:model="department_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione el motivo de traslado" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="department_id" />
                                {{ $department_id }}
                            </div>

                            <div class="col-span-1 mb-4 mr-1 sm:col-span-2">
                                <x-jet-label value="Provincia" />
                                <select wire:model="province_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione Provincia" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">
                                            {{ $province->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="province_id" />
                                {{ $province_id }}
                            </div>

                            <div class="col-span-1 mb-4 mr-1 sm:col-span-2">
                                <x-jet-label value="Distrito" />
                                <select wire:model="district_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione Distrito" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">
                                            {{ $district->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="district_id" />
                                {{ $district_id }}
                            </div>


                        </div>

                        <hr class="mt-5 mb-5">


                        <section class="w-full px-4 mt-4 antialiased text-gray-600">
                            <div class="flex flex-col justify-center w-full h-full">
                                <!-- Table -->

                                <div class="w-full mx-auto bg-white border border-gray-200 rounded-sm shadow-lg">
                                    <div class="p-3">
                                        <div class="overflow-x-auto">
                                            <table class="w-full table-auto">
                                                <thead
                                                    class="text-xs font-semibold text-gray-400 uppercase bg-gray-50">
                                                    <tr>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Imagén
                                                            </div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Código
                                                            </div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-left">Nombre
                                                            </div>
                                                        </th>

                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-center">cantidad
                                                            </div>
                                                        </th>

                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-center">Acciones
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-sm divide-y divide-gray-100">
                                                    @foreach ($cart as $item)
                                                        <tr>
                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <div class="flex-shrink-0 w-10 h-10 mr-2 sm:mr-3">
                                                                        <img class="rounded-full" src="#"
                                                                            width="40" height="40">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="text-left">
                                                                    {{ $item->codigobarras }}
                                                                </div>
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="font-medium text-left text-green-500">
                                                                    {{ $item->name }} </div>
                                                            </td>


                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="w-20 text-lg text-center">
                                                                    <input type="number"
                                                                        style="font-size: 1rem!important"
                                                                        class="w-20 text-center form-control"
                                                                        value="{{ $item->quantity }}">
                                                                </div>
                                                            </td>





                                                            <td class="p-2 whitespace-nowrap">


                                                                <a class="btn btn-red"
                                                                    wire:click="$emit('deleteTemporal', {{ $item->product_id }})">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @endforeach


                                                </tbody>

                                                <tfoot>


                                                </tfoot>


                                            </table>


                                        </div>
                                    </div>
                                </div>



                            </div>
                        </section>

                        {{-- <div class="flex space-x-6">
                            <div class="m-2">
                                <input wire:model="sending_method" type="radio" id="a" name="drone"
                                    value="1" />
                                <label for="a">ENVIAR A SUNAT</label>
                            </div>

                            <div class="m-2">
                                <input wire:model="sending_method" type="radio" id="b" name="drone"
                                    value="2" />
                                <label for="b">GENERAR XML</label>
                            </div>

                            <div class="m-2">
                                <input wire:model="sending_method" type="radio" id="c" name="drone"
                                    value="3" />
                                <label for="c">CREAR</label>
                            </div>
                        </div> --}}






                        <div class="flex flex-wrap items-center justify-center w-full gap-4 mt-6">

                            {{-- Botón Guardar --}}
                            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                                class="px-6 py-3 text-sm font-semibold disabled:opacity-50"
                                :disabled="$isCreated">
                                <i class="fa-regular fa-floppy-disk mr-2"></i>
                                Guardar
                            </x-jet-danger-button>

                            {{-- Botón Cancelar (solo si aún no se ha creado) --}}
                            @unless ($isCreated)
                                <x-jet-secondary-button wire:click="cancel" class="px-6 py-3 text-sm font-semibold">
                                    <i class="fa-solid fa-xmark mr-2"></i>
                                    Cancelar
                                </x-jet-secondary-button>
                            @endunless

                            {{-- Si la guía ya fue creada --}}
                            @if ($isCreated && $boleta)
                               {{--  <x-jet-button wire:click="newGuia"
                                    class="px-6 py-3 text-sm font-semibold bg-blue-600 hover:bg-blue-700 text-white">
                                    <i class="fa-solid fa-plus mr-2"></i>
                                    Crear otra Guía
                                </x-jet-button> --}}

                                <x-jet-secondary-button
                                    onclick="window.location.href='{{ route('admin.comprobante.list') }}'"
                                    class="px-6 py-3 text-sm font-semibold">
                                    <i class="fa-solid fa-list mr-2"></i>
                                    Lista de Guías
                                </x-jet-secondary-button>

                                <a href="{{ route('admin.guiaderemision.pdf', ['id' => $boleta->id, 'format' => 'a4']) }}"
                                    target="_blank"
                                    class="inline-flex items-center px-5 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow-md 
                  hover:bg-indigo-700 hover:scale-105 transition duration-150 ease-in-out">
                                    <i class="fa-solid fa-file-pdf mr-2 text-lg"></i>
                                    Imprimir A4
                                </a>

                                <a href="{{ route('admin.guiaderemision.pdf', ['id' => $boleta->id, 'format' => 'ticket']) }}"
                                    target="_blank"
                                    class="inline-flex items-center px-5 py-3 bg-emerald-600 text-white text-sm font-semibold rounded-xl shadow-md 
                  hover:bg-emerald-700 hover:scale-105 transition duration-150 ease-in-out">
                                    <i class="fa-solid fa-receipt mr-2 text-lg"></i>
                                    Imprimir Ticket
                                </a>
                            @endif
                        </div>












                       {{--  <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                            class="w-full mt-4 mb-3 disabled:opacity-25">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
                        </x-jet-danger-button>

                        <x-jet-button wire:click="cancel" wire:loading.attr="disabled" wire:target="save"
                            class="w-full mt-4 mb-3 disabled:opacity-25">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Cancelar
                        </x-jet-button> --}}



                        {{-- @if ($boleta)
                            <div
                                class="flex flex-col items-center justify-center mt-6 space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                               
                                <a href="{{ route('admin.guiaderemision.pdf', ['id' => $boleta->id, 'format' => 'a4']) }}"
                                    target="_blank"
                                    class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow-md 
                   hover:bg-indigo-700 hover:scale-105 transition duration-150 ease-in-out">
                                    <i class="fa-solid fa-file-pdf mr-2 text-lg"></i>
                                    Imprimir A4
                                </a>

                               
                                <a href="{{ route('admin.guiaderemision.pdf', ['id' => $boleta->id, 'format' => 'ticket']) }}"
                                    target="_blank"
                                    class="inline-flex items-center px-5 py-2.5 bg-emerald-600 text-white text-sm font-semibold rounded-xl shadow-md 
                   hover:bg-emerald-700 hover:scale-105 transition duration-150 ease-in-out">
                                    <i class="fa-solid fa-receipt mr-2 text-lg"></i>
                                    Imprimir Ticket
                                </a>
                            </div>
                        @endif
 --}}


                    </div>
                </div>

            </div>



        </div>

    </div>








    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    @endpush

    @push('scripts')
        <script src="sweetalert2.all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        {{--  <script src="/adminlte/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        <script src="pikaday.js"></script>

        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

        {{-- <script>
            var datepicker = new Pikaday({
                field: document.getElementById('datepicker'),
                format: 'D MMM YYYY',
                onSelect: function(selectedDate) {
                    Livewire.emit('fechaemision', selectedDate);
                }
            });
        </script> --}}

        {{-- <script>
            var datepicker = new Pikaday({
                field: document.getElementById('datepicker'),
                format: 'D MMM YYYY',
                onSelect: function(selectedDate) {
                    @this.set('fechaemision', selectedDate);
                }
            });
        </script> --}}


        {{-- <script>
            var datepicker = new Pikaday({
                field: document.getElementById('datepicker'),
                format: 'D MMM YYYY',
                onSelect: function(selectedDate) {
                    var formattedDate = moment(selectedDate).format('DDMMYYYY');
                    Livewire.emit('fechaemision', formattedDate);
                }
            });
        </script> --}}


        <script>
            var datepicker = new Pikaday({
                field: document.getElementById('datepicker'),
                format: 'DD MM YYYY', // Cambiado a 'DD/MM/YYYY'//format: 'D MMM YYYY',
                onSelect: function(selectedDate) {
                    var formattedDate = moment(selectedDate).format('DD MM YYYY');
                    @this.set('fechaemision', formattedDate);
                }
            });

            var datepicker2 = new Pikaday({
                field: document.getElementById('datepicker2'),
                format: 'DD MM YYYY',
                onSelect: function(selectedDate) {
                    var formattedDate = moment(selectedDate).format('DD MM YYYY');
                    @this.set('fechavencimiento', formattedDate);
                }
            });


            /* var datepicker2 = new Pikaday({
                field: document.getElementById('datepicker2'),
                format: 'D MMM YYYY',
                onSelect: function(selectedDate) {
                    var formattedDate = moment(selectedDate).format('DD/MM/YYYY');
                    @this.set('fechavencimiento', formattedDate);
                }
            }); */
        </script>


        <script>
            CKEDITOR.replace('editor');
            CKEDITOR.config.height = 115;
        </script>


        {{-- para eliminar un item de la venta --}}
        <script>
            Livewire.on('deleteTemporal', temporalId => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No se podrá revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.notadecredito-create', 'delete', temporalId);

                        Swal.fire(
                            'Eliminado!',
                            'El Registro fue eliminado.',
                            'success'
                        )
                    }
                })
            })
        </script>

        {{-- para eliminar todo de la venta --}}
        <script>
            Livewire.on('limpiarTemporal', () => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No se podrá revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.comprobante-create', 'limpiar');

                        Swal.fire(
                            'Eliminado!',
                            'El Registro fue eliminado.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush



</div>
