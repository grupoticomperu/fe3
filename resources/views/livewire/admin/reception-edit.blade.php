<div>
    {{-- <div wire:init="loadBrands"> --}}

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="mr-2 text-xl font-semibold leading-tight text-gray-600">
                Recepción de Mercaderia enviado por el Local :  {{  $reception->localEnvia->name }} , ubicado en : {{  $reception->localEnvia->address }}
            </h2>

            <a href="{{ route('admin.shipment.index') }}">Regresar</a>

        </div </x-slot>

        {{-- aqui agregamos sesion en livewire --}}
        @if (session()->has('message'))
            <div class="flex items-center px-4 py-3 text-sm font-bold text-white bg-green-500" role="alert">
                <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ session('message') }}</p>
            </div>
        @endif

        @if (session()->has('errormessage'))
            <div class="flex items-center px-4 py-3 text-sm font-bold text-white bg-red-500" role="alert">
                <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ session('errormessage') }}</p>
            </div>
        @endif
        {{-- aqui agregamos sesion en livewire --}}



        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-center">Envio {{ $mensaje }}</div>
            <x-table>


                <div class="items-center px-6 py-4 bg-gray-200 sm:flex">


                    <div class="flex items-center justify-center mb-2 md:mb-0">
                        <span>Mostrar </span>
                        <select wire:model="cant"
                            class="block p-7 py-2.5 ml-3 mr-3 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <option value="10"> 10 </option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="mr-3">registros</span>
                    </div>






                    <div class="flex items-center justify-center mb-2 mr-4 md:mb-0 sm:w-full">
                        {{-- <x-jet-input type="text" wire:model="search"
                            class="flex items-center justify-center w-80 sm:w-full rounded-lg py-2.5"
                            placeholder="buscar" /> --}}

                        {{-- <input type="text" id="code" value="" class="block w-full items-center justify-center sm:w-full rounded-lg py-2.5" wire:keydown.enter.prevent="ScanCode($('#code').val())"/> --}}
                        <input type="text" id="code" value=""
                            class="block w-full items-center justify-center sm:w-full rounded-lg py-2.5"
                        />
                    </div>


                    {{-- lo puse aqui porque en la parte superior no funcaba --}}

                    @if ($statereception == 2)
                        {{-- si esta en proceso se muestra boton Enviar --}}
                        <div class="flex items-center justify-center">

                            <a wire:click="$emit('confirmarr')" class="items-center justify-center sm:flex btn btn-orange">
                                <i class="mx-2 fa-regular fa-file"></i> Confirmar
                            </a>
                        </div>
                    @endif




                </div>

                {{-- @if ($brands->count()) --}}



                @if (count($local_productatribute_shipments))


                    <table class="min-w-full divide-y divide-gray-200">



                        <thead class="bg-gray-50">
                            <tr>

                                <th scope="col"
                                    class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('id')">

                                    ID

                                    @if ($sort == 'id')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif
                                </th>


                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('codigo')">

                                    Código
                                    @if ($sort == 'codigo')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif

                                </th>



                                <th scope="col"
                                    class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                                    Producto
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                                    stocksistema
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                                    stockcontado
                                </th>



                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            {{-- products es todo lo que esta en inventario ya contabilizado osea es initialinventory_productatributes --}}
                            @foreach ($local_productatribute_shipments as $lpas)
                                <tr>

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $lpas->id }}
                                    </td>


                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                        {{ $lpas->localproductatribute->productatribute->codigo }}
                                        {{ $lpas->localproductatribute->id }}

                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $lpas->localproductatribute->productatribute->productfamilie->name }}
                                    </td>




                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($lpas->localproductatribute->productatribute->atributes as $atribute)
                                            {{ $atribute->name }}
                                            @if (!$loop->last)
                                                -
                                            @endif
                                        @endforeach


                                    </td>

                                    {{-- <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $lpas->stockcontado }}

                                    </td> --}}



                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        <input type="number"
                                            style="font-size: 1rem!important" class="text-center form-control"
                                            value="{{ $lpas->quantity }}"
                                            disabled >


                                    </td>







                                </tr>
                            @endforeach
                            <!-- More people... -->
                        </tbody>

                        <tfoot class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="px-6 py-4 text-sm text-gray-500 ">Total productos : {{ $total }}</td>

                                <td></td>
                            </tr>



                        </tfoot>
                    </table>




                    {{--  @if ($products->hasPages())
                        <div class="px-6 py-4">
                            {{ $products->links() }}
                        </div>
                    @endif --}}
                @else
                    <div wire:init="loadProducts">

                    </div>


                    @if ($readyToLoad)
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                No hay ningún registro coincidente
                            </div>
                        </div>
                    @else
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <svg class="w-10 h-10 animate-spin" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512" fill="blue">
                                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M304 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zm0 416c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM48 304c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm464-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM142.9 437c18.7-18.7 18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zm0-294.2c18.7-18.7 18.7-49.1 0-67.9S93.7 56.2 75 75s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zM369.1 437c18.7 18.7 49.1 18.7 67.9 0s18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9z" />
                                </svg>
                            </div>
                        </div>

                        <div class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                Cargando, espere un momento
                            </div>
                        </div>
                    @endif



                @endif




                {{--                 @if ($local_productatribute_shipments->hasPages())

                    <div class="px-6 py-8">
                        {{ $local_productatribute_shipments->links() }}
                    </div>
                @endif --}}


            </x-table>

        </div>



        <x-slot name="footer">

            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Pie
            </h2>


        </x-slot>









        @push('styles')
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
        @endpush

        @push('scripts')



            <script>
                Livewire.on('confirmarr', modeloId => {
                    Swal.fire({
                        title: 'Estas seguro de Aceptar los productos ?',
                        text: "No se podrá revertir!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Aceptar!'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            Livewire.emitTo('admin.reception-edit', 'confirmar', modeloId);

                            Swal.fire(
                                'Productos Aceptados!',
                                'La Aceptación Finalizó',
                                'success'
                            )
                        }
                    })
                })
            </script>
        @endpush




</div>
