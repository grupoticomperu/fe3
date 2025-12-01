<div>

    {{-- {{ $serienumero }} --}}

    {{--  {{ $comprobante }} --}}


    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Nota de Crédito') }}
        </h2>


    </x-slot>

    <div class="grid px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8">

        <div class="px-3 bg-white">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div>


                        {{-- <div class="py-2 mb-1" wire:ignore> --}}
                        <div class="grid grid-cols-1 mb-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 ">

                            <div class="mr-4 ">
                                {{-- <label>Proveedores </label> --}}
                                <x-jet-label value="Tipo Documento" />
                                {{-- select2 --}}
                                <x-jet-input type="text" value="{{ $comprobante->tipocomprobante->namecorto }}"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="tipodocumento_id" />
                            </div>



                            <div class="items-center mr-4">
                                <div class="flex-1 mr-1">
                                    <x-jet-label value="Numero" />
                                    <x-jet-input value="{{ $comprobante->customer->numdoc }}" type="text"
                                        class="w-full h-10 max-w-md uppercase" />
                                    <x-jet-input-error for="ruc" />
                                </div>
                            </div>

                            <div class="col-span-4 mr-4">
                                <x-jet-label value="Razón Social" />
                                <x-jet-input value="{{ $comprobante->customer->nomrazonsocial }}" type="text"
                                    class="w-full h-10 uppercase" />
                                <x-jet-input-error for="razon_social" />
                            </div>
                        </div>


                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 lg:grid-cols-6">

                            {{-- <div class="flex-1 mb-1 mr-4">
                                <x-jet-label value="Nombre Comercial" />
                                <x-jet-input value="{{ $comprobante->customer->ruc }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="nombre_comercial" />
                            </div> --}}

                            <div class="flex-1 col-span-3 mb-4 mr-4">
                                <x-jet-label value="Dirección" />
                                <x-jet-input value="{{ $comprobante->customer->address }}" type="text"
                                    class="w-full h-10 uppercase" />
                                <x-jet-input-error for="direccion" />
                            </div>

                            <div class="flex-1 mb-4 mr-4">
                                <x-jet-label value="Departamento" />
                                <x-jet-input value="{{ $comprobante->customer->department_id }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="Departamento" />
                            </div>

                            <div class="flex-1 mb-4 mr-4">
                                <x-jet-label value="Provincia" />
                                <x-jet-input value="{{ $comprobante->customer->province_id }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="provincia" />
                            </div>

                            <div class="flex-1 mb-4 mr-4">
                                <x-jet-label value="Distrito" />
                                <x-jet-input value="{{ $comprobante->customer->district_id }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="distrito" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 lg:grid-cols-6">

                            <div class="flex-1 mb-4 mr-4">
                                <x-jet-label value="Serie Numero" />
                                <x-jet-input value="{{ $comprobante->serienumero }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />

                            </div>

                            <div class="flex-1 mb-4 mr-4">
                                <x-jet-label value="Fecha de Emisión" /> {{-- fecha de emesion de la factura o Boleta --}}
                                <x-jet-input value="{{ $comprobante->fechaemision }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />

                            </div>

                            <div class="flex-1 mb-4 mr-4">
                                <x-jet-label value="Forma de Pago" />
                                <x-jet-input value="{{ $comprobante->paymenttype->name }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />

                            </div>

                            <div class="flex-1 mb-4 mr-4">
                                <x-jet-label value="Moneda" />
                                <x-jet-input value="{{ $comprobante->currency->abbreviation }} " type="text"
                                    class="w-full h-10 max-w-md uppercase" />

                            </div>


                            <div class="flex-1 mb-4 mr-4">
                                <x-jet-label value="Total" />
                                <x-jet-input value="{{ $comprobante->mtoimpventa }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />

                            </div>
                        </div>
                        <div class="flex-1 col-span-6 mb-4 mr-4">
                            <hr>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 lg:grid-cols-6">

                            {{-- <div class="mb-4 mr-4 ">
                                <x-jet-label value="Tipo de Operación" />
                                <x-jet-input value="{{ $comprobante->customer }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                            </div> --}}

                            <div class="mb-4 mr-4 ">
                                {{-- <label>Proveedores </label> --}}
                                <x-jet-label value="comprobante" />
                                {{-- select2 --}}
                                <x-jet-input value="{{ $tipocomprobante_namecorto }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />

                            </div>



                            <div class="mb-1 mr-4">
                                <x-jet-label value="Serie" />
                                <x-jet-input value="{{ $serie }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="serie" />
                            </div>

                            <div class="mb-1 mr-4">
                                <x-jet-label value="Numero" />
                                <x-jet-input value="{{ $numero }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="numero" />
                            </div>


                            {{-- <div class="mb-1 mr-4">
                                <x-jet-label value="Forma de pago:" />

                                <x-jet-input value="{{ $comprobante->customer->ruc }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="paymenttype_id" />
                            </div> --}}



                            {{--  <div class="mb-4 mr-4">
                                <x-jet-label value="Fecha de Emisión" />
                                <x-jet-input id="datepicker" type="text" wire:model="fechaemision" value="{{ old('fechaemision') }}"
                                     class="w-full h-10" placeholder="fecha de emisión" />
                                <x-jet-input-error for="fechaemision" />
                            </div> --}}

                            <div class="mb-4 mr-4">
                                <x-jet-label value="Fecha de Emisiónn" />
                                <x-jet-input type="date" max="{{ date('Y-m-d') }}"
                                    min="{{ date('Y-m-d', strtotime('-3 days')) }}" wire:model="fechaemision"
                                    value="{{ old('fechaemision') }}" class="w-full h-10"
                                    placeholder="fecha de emisión" />
                                <x-jet-input-error for="fechaemision" />
                            </div>



                            {{-- no hay fecha de vencimiento --}}
                            {{-- <div class="mb-4 mr-4">
                                <x-jet-label value="Fecha de Vencimiento:" />
                                <x-jet-input value="{{ $comprobante->customer->ruc }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="fechavencimiento" />

                            </div> --}}




                            {{-- <div class="mr-4">
                                <x-jet-label value="Moneda" />
                                <x-jet-input value="{{ $comprobante->currency->name }}" type="text"
                                    class="w-full h-10 max-w-md uppercase" />
                                <x-jet-input-error for="currency_id" />
                            </div> --}}

                            <div class="col-span-2 mr-4">
                                {{-- <label>Proveedores </label> --}}
                                <x-jet-label value="Tipo de Nota de Crédito" />
                                {{-- select2 --}}
                                <select wire:model="tipodenotadecredito_id"
                                    class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                    data-placeholder="Selecccione un un tipo de NC" style="width:100%">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($tipodenotadecreditos as $tipodenotadecredito)
                                        <option value="{{ $tipodenotadecredito->id }}">
                                            {{ $tipodenotadecredito->description }}
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="tipodenotadecredito_id" />
                            </div>







                        </div>

                        <div>

                            <div class="mr-4 ">
                                <x-jet-label value="Descripción del motivo" />
                                <x-jet-input wire:model="desmotivo" type="text" class="w-full h-10 uppercase" />
                                <x-jet-input-error for="desmotivo" />

                            </div>


                        </div>



                        <hr class="mt-5 mb-5">

                        {{-- aqui ira los productos a vender --}}



                        {{-- <div class="flex mt-4">
                            <input type="text" id="code" class="block w-full bg-gray-100"
                                wire:keydown.enter.prevent="ScanCode($('#code').val())" />

                            <x-jet-secondary-button class="ml-2 mr-2" wire:click="limpiar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </x-jet-secondary-button>

                            <a class="btn btn-red" wire:click="$emit('limpiarTemporal')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>


                        </div> --}}





                        {{-- {{ $cart }} --}}

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
                                                            <div class="font-semibold text-center">precio
                                                            </div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-center">cantidad
                                                            </div>
                                                        </th>
                                                        <th class="p-2 whitespace-nowrap">
                                                            <div class="font-semibold text-center">Subtotal
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
                                                                {{-- <div class="text-center">${{number_format($item->saleprice,2)}}</div> --}}
                                                                <div class="w-20 text-lg text-center">
                                                                    <input type="text"
                                                                        id="p{{ $item->product_id }}"
                                                                        wire:change="updatePrice('{{ $item->product_id }}', $('#p' + '{{ $item->product_id }}').val(), $('#r' + '{{ $item->product_id }}').val())"
                                                                        style="font-size: 1rem!important"
                                                                        class="w-20 text-center form-control"
                                                                        value="{{ number_format($item->saleprice, 4) }}">
                                                                </div>
                                                            </td>

                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="w-20 text-lg text-center">
                                                                    <input type="number"
                                                                        id="r{{ $item->product_id }}"
                                                                        wire:change="updateQty('{{ $item->product_id }}', $('#p' + '{{ $item->product_id }}').val(), $('#r' + '{{ $item->product_id }}').val(), '{{ $item->mtovalorunitario }}')"
                                                                        style="font-size: 1rem!important"
                                                                        class="w-20 text-center form-control"
                                                                        value="{{ $item->quantity }}">
                                                                </div>
                                                            </td>



                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="text-lg text-right">
                                                                    {{ number_format($item->saleprice * $item->quantity, 4) }}
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
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="text-lg text-right">
                                                                SUB-TOTAL
                                                            </div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="text-lg text-right">
                                                                {{ $valorventa }}
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="text-lg text-right">
                                                                ICBPER
                                                            </div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="text-lg text-right">
                                                                {{ $icbper }}
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="text-lg text-right">
                                                                IGV
                                                            </div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="text-lg text-right">
                                                                {{ $mtoigv }}
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>

                                                </tbody>

                                                <tfoot>

                                                    <tr>

                                                        {{-- <td>{{ $valorventa }}</td>
                                                            <td>{{ $totalimpuestos }}</td>
                                                            <td>{{ $subtotall }}</td> --}}
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>{{ $totalenletras }}</td>
                                                        <td class="text-right">Total: {{ $moneda }}</td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="text-lg text-right">
                                                                {{ $subtotall }}
                                                            </div>
                                                        </td>

                                                        <td></td>
                                                    </tr>
                                                </tfoot>

                                                {{ $detalle }}

                                            </table>


                                        </div>
                                    </div>
                                </div>



                            </div>
                        </section>

                        <div class="flex space-x-6">
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

    {{-- </form> --}}






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
