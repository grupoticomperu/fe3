<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Compras') }}
        </h2>
    </x-slot>

    {{-- <form method="POST" action="{{ route('admin.shopping.store') }}" enctype="multipart/form-data"> --}}
        {{-- {{ csrf_field() }} --}}
        <div class="grid px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8 ">

            <div class="px-3 bg-white">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div>

                            <h3 class="mt-2 mb-5 text-center underline">Nueva Compra</h3>


                            {{-- <div class="py-2 mb-1" wire:ignore> --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 lg:grid-cols-6">
                                <div class="mb-4 mr-4 ">
                                    {{-- <label>Proveedores </label> --}}
                                    <x-jet-label value="Proveedores" />
                                    {{-- select2 --}}
                                    <select wire:model="supplier_id"
                                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 "
                                        data-placeholder="Selecccione un Proveedor" style="width:100%">
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->nomrazonsocial }}</option>
                                        @endforeach

                                    </select>
                                    <x-jet-input-error for="supplier_id" />
                                </div>

                                <div class="mb-4 mr-4" wire:ignore >
                                    <x-jet-label value="Fecha de Emisión" />
                                    <x-jet-input id="datepicker" wire:model="fechaemision" type="text" class="w-full h-10"
                                        value="{{ old('fechaemision') }}" placeholder="fecha de compra" />
                                    <x-jet-input-error for="fechaemision" />
                                </div>


                                <div class="mb-4 mr-4">
                                    <x-jet-label value="Fecha de Vencimiento:" />
                                    <x-jet-input id="datepicker2" type="text" wire:model="fechavencimiento"
                                        value="{{ old('fechavencimiento') }}" placeholder="fecha de pago"
                                        class="w-full" />
                                    <x-jet-input-error for="fechavencimiento" />
                                </div>



                                <div class="mb-1 mr-4">
                                    <x-jet-label value="Forma de pago:" />

                                    <select wire:model="formadepago"
                                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        data-placeholder="Selecccione forma de pago" style="width:100%">
                                        <option value="" selected disabled>Seleccione</option>

                                        <option value="Contado">Contado</option>

                                        <option value="Credito">Credito</option>
                                    </select>
                                    <x-jet-input-error for="formadepago" />
                                </div>



                                <div class="mb-1 mr-4">
                                    <x-jet-label value="Tipo Comprobante" />
                                    <select wire:model="tipocomprobante_id"
                                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        data-placeholder="Selecccione la moneda" style="width:100%">
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($tipocomprobantes as $tipocomprobante)
                                            <option value="{{ $tipocomprobante->id }}">{{ $tipocomprobante->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <x-jet-input-error for="supplier_id" />


                                </div>


                                <div class="mb-1 mr-4">
                                    <x-jet-label value="Serie-Numero" />
                                    <x-jet-input type="text" placeholder="Serie - Número" class="w-full h-10 uppercase"
                                        wire:model="serienumero" />
                                    <x-jet-input-error for="serienumero" />
                                </div>


                                <div class="mb-1 mr-4">
                                    <x-jet-label value="Moneda" />
                                    <select wire:model="currency_id"
                                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        data-placeholder="Selecccione la moneda" style="width:100%">
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                        @endforeach

                                    </select>
                                    <x-jet-input-error for="currency_id" />
                                </div>


                                <div class="col-span-2 mr-4">
                                    <x-jet-label value="Imagen del comprobante" />
                                    {{-- <label>Imagen del comprobante</label> --}}
                                    <input type="file" wire:model="photo" id="file" accept="image/*">
                                </div>

                                <div class="col-span-2 form-group {{ $errors->has('nota') ? 'text-danger' : '' }} ">
                                    {{-- <label>Nota de la compra</label> --}}
                                    <textarea rows="2" wire:model="nota" class="w-full form-control"
                                        placeholder="Ingrese Nota del Comprobante ">{{ old('nota') }}</textarea>
                                    {!! $errors->first('nota', '<span class="help-block">:message</span>') !!}


                                </div>


                            </div>


                            <hr class="mt-5 mb-5">
                            {{-- aqui ira los productos a comprar --}}



                            <div class="flex mt-4">



                                <input type="text" id="code" class="block w-full bg-gray-100" wire:keydown.enter.prevent="ScanCode($('#code').val())"/>

                                <x-jet-secondary-button class="ml-2" {{-- wire:click="limpiar" --}}>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                      </svg>

                                     {{--  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                      </svg> --}}


                                </x-jet-secondary-button>


                            </div>

                            {{-- {{ $cart }} --}}


                            <section class="w-full px-4 mt-4 antialiased text-gray-600">
                                <div class="flex flex-col justify-center w-full h-full">
                                    <!-- Table -->

                                    @if($total > 0)
                                    <div class="w-full mx-auto bg-white border border-gray-200 rounded-sm shadow-lg">

                                        <div class="p-3">
                                            <div class="overflow-x-auto">
                                                <table class="w-full table-auto">
                                                    <thead class="text-xs font-semibold text-gray-400 uppercase bg-gray-50">
                                                        <tr>
                                                            <th class="p-2 whitespace-nowrap">
                                                                <div class="font-semibold text-left">Imagén</div>
                                                            </th>
                                                            <th class="p-2 whitespace-nowrap">
                                                                <div class="font-semibold text-left">Código</div>
                                                            </th>
                                                            <th class="p-2 whitespace-nowrap">
                                                                <div class="font-semibold text-left">Nombre</div>
                                                            </th>
                                                            <th class="p-2 whitespace-nowrap">
                                                                <div class="font-semibold text-center">precio</div>
                                                            </th>
                                                            <th class="p-2 whitespace-nowrap">
                                                                <div class="font-semibold text-center">cantidad</div>
                                                            </th>
                                                            <th class="p-2 whitespace-nowrap">
                                                                <div class="font-semibold text-center">Subtotal</div>
                                                            </th>
                                                            <th class="p-2 whitespace-nowrap">
                                                                <div class="font-semibold text-center">Acciones</div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-sm divide-y divide-gray-100">
                                                        @foreach($cart as $item)
                                                        <tr>
                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <div class="flex-shrink-0 w-10 h-10 mr-2 sm:mr-3">
                                                                    <img class="rounded-full" src="{{ asset( $item->attributes[0]) }}" width="40" height="40" ></div>

                                                                </div>
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="text-left">{{ $item->id }}</div>
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="font-medium text-left text-green-500">{{-- {{ $item->name }} --}}</div>
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap">
                                                               {{--  <div class="text-center">${{number_format($item->price,2)}}</div> --}}
                                                                    <div class="w-20 text-lg text-center">
                                                                        <input type="text" id="p{{$item->id}}"
                                                                        wire:change="updatePrice('{{ is_numeric($item->id) ? $item->id : addslashes($item->id) }}', $('#p' + '{{$item->id}}').val(), $('#r' + '{{$item->id}}').val())"
                                                                        style="font-size: 1rem!important"
                                                                        class="w-20 text-center form-control"
                                                                        value="{{number_format($item->price,2)}}"
                                                                        >
                                                                    </div>
                                                            </td>

                                                            <td class="p-2 whitespace-nowrap">
                                                                    <div class="w-20 text-lg text-center">
                                                                        <input type="number" id="r{{$item->id}}"
                                                                        wire:change="updateQty('{{ is_numeric($item->id) ? $item->id : addslashes($item->id) }}', $('#p' + '{{$item->id}}').val(), $('#r' + '{{$item->id}}').val() )"
                                                                        style="font-size: 1rem!important"
                                                                        class="w-20 text-center form-control"
                                                                        value="{{ $item->quantity }}"
                                                                        >
                                                                    </div>
                                                            </td>



                                                            <td class="p-2 whitespace-nowrap">
                                                                <div class="text-lg text-center">${{number_format($item->price * $item->quantity,2)}}</div>
                                                            </td>

                                                            <td class="p-2 whitespace-nowrap" wire:click="removeItem('{{ $item->id }}')">
                                                                <a class="ml-2 btn btn-red" >
                                                                <i>del</i>
                                                                </a>
                                                            </td>

                                                        </tr>

                                                        @endforeach


                                                    </tbody>

                                                    <tfoot>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td class="text-right">Total:</td>
                                                          <td class="text-center"> US$ {{ $total }}</td>
                                                          <td></td>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                                <div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <h5 class="text-center text-muted">Agrega productos para la venta</h5>
                                    @endif
                                </div>
                            </section>









                             <div>

                                <x-jet-danger-button class="w-full mt-4 mb-3" wire:click="save">
                                    <i class="mx-2 fa-regular fa-floppy-disk"></i> Crear Compra
                                </x-jet-danger-button>

                            </div>



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
        <script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        {{--  <script src="/adminlte/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        <script src="pikaday.js"></script>


        <script>
             var datepicker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'D MMM YYYY',
        onSelect: function(selectedDate) {
            Livewire.emit('fechaSeleccionada', selectedDate);
        }
    });


        </script>



        <script>
            /*  $('#datepicker').datepicker({
                                autoclose: true
                            }); */




            $('.select2').select2({
                tags: true
            });
        </script>

        <script>
            CKEDITOR.replace('editor');
            CKEDITOR.config.height = 115;
        </script>


    @endpush
</div>
