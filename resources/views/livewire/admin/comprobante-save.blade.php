@push('styles')

 <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
 <link rel="stylesheet" href="/adminlte/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">

@endpush

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Nuevo Comprobante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-2 overflow-hidden bg-white shadow-xl sm:rounded-lg">



                <div class="grid grid-cols-4 gap-6 mb-4">


                    <div class="flex">

                        <div class="mb-4">
                            <x-jet-label value="Comp" />
                            {{-- //quiete esto y funciono tipocomprobante_id --}}
                            <select class="w-64 form-control" wire:model="tipocomprobante_id">
                                <option value="" selected disabled>Seleccione</option>

                                @foreach (Auth::user()->local->tipocomprobantes as $tipocomprobante)
                                    <option value="{{$tipocomprobante->id}}" >
                                        {{$tipocomprobante->name}}
                                    </option>

                                @endforeach


                            </select>

                        </div>

                        <div class="mb-4">
                            <x-jet-label value="Seriee" />
                            <x-jet-input type="text"
                                        class="w-16"
                                        wire:model="serie"
                                        placeholder="Serie" />
                            <x-jet-input-error for="name" />
                        </div>

                        <div class="mb-4">

                            <x-jet-label value="Numero" />
                            <x-jet-input type="text"
                                        class="w-full"
                                        wire:model="numero"
                                        placeholder="Numero" />
                            <x-jet-input-error for="name" />
                        </div>
                    </div>


                    <div class="mb-4" wire:ignore>
                        <x-jet-label value="Clientes" />

                        <select  wire:model="customer_id" class="block w-full h-10 px-4 py-2 pr-8 leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline ">
                            <option value="">Selecciona una Cliente</option>
                            @foreach($customers as $customer)

                                <option value="{{$customer->id}}">
                                    {{$customer->nomrazonsocial}} {{ $numdoc = $customer->numdoc}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                  {{--    {{ $customer_id }}  --}}


                     <div class="mb-4">
                        <x-jet-label value="RUC" />
                        <x-jet-input type="text"
                                    class="block w-full h-10 px-4 py-2 pr-8 leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline"
                                    wire:model="numdoc"
                                    placeholder="RUC" />
                        <x-jet-input-error for="name" />
                    </div>





                    <div class="mb-4">
                        <x-jet-label value="Dirección" />
                        <x-jet-input type="text"
                                    class="block w-full px-4 py-2 pr-8 leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline"

                                    placeholder="Dirección" />
                        <x-jet-input-error for="name" />
                    </div>



                </div>




                <div class="grid grid-cols-6 gap-6 mb-4 ">

                    <div>
                        <x-jet-label value="Moneda" />

                        <select class="block w-full px-4 py-2 pr-8 leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="" selected disabled>moneda</option>

                                @foreach($currencies as $currency)
                                <option value="{{$currency->id}}"
                                        {{ old('currency_id')}} >{{$currency->abbreviation}}</option>
                                @endforeach


                        </select>

                    </div>



                    <div>
                        <x-jet-label value="Forma de Pago" />

                        <select class="w-full form-control">
                            <option value="" selected disabled>forma de pago</option>

                                <option value="1">Contado</option>
                                <option value="2">Crédito</option>

                        </select>

                    </div>

                    <div >
                        <label autocomplete="off">Fecha:</label>

                        <div class="input-group">

                          <input type="text" name="fe" autocomplete="off" value="{{old('fe') }}"  class="form-control pull-right" id="datepicker">
                        </div>
                          <!-- /.input group -->
                    </div>



                    <div>
                        <label>Fecha de Pago:</label>

                        <div class="input-group date">
                          <div class="input-group-prepend">

                          </div>
                          <input type="text" name="fechadevto" autocomplete="off" value="{{old('fechadevto') }}"  class="form-control pull-right" id="datepicker2">
                        </div>
                          <!-- /.input group -->
                    </div>


                    <div>
                        <x-jet-label value="Tipo Comprobante" />

                        <select class="w-full form-control" name="tipocomprobante_id">
                            <option value="" selected disabled>tipo comprobante</option>

                            @foreach($tipocomprobantes as $tipocomprobante)
                            <option value="{{$tipocomprobante->id}}"
                                {{ old('tipocomprobante_id')}} >{{$tipocomprobante->name}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">
                        <x-jet-label value="Guia" />
                        <x-jet-input type="text"
                                    class="w-full"
                                    wire:model="name"
                                    placeholder="Guia" />
                        <x-jet-input-error for="name" />
                    </div>



                </div>





                <div class="flex mt-4">



                    <input type="text" id="code" class="block w-full bg-gray-100" wire:keydown.enter.prevent="ScanCode($('#code').val())"/>

                    <x-jet-secondary-button class="ml-2" wire:click="limpiar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                          </svg>

                    </x-jet-secondary-button>


                </div>

{{ $cart }}
<!-- component -->

        <!-- component -->
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
                                            <div class="font-medium text-left text-green-500">{{ $item->name }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                           {{--  <div class="text-center">${{number_format($item->price,2)}}</div> --}}
                                                <div class="w-20 text-lg text-center">
                                                    <input type="text" id="p{{$item->id}}"
                                                    wire:change="updatePrice({{$item->id}}, $event.target.value, $('#r' + {{$item->id}}).val())"
                                                    style="font-size: 1rem!important"
                                                    class="text-center form-control"
                                                    value="{{number_format($item->price,2)}}"
                                                    >
                                                </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                                <div class="w-20 text-lg text-center">
                                                    <input type="number" id="r{{$item->id}}"
                                                    wire:change="updateQty({{$item->id}}, $('#p' + '{{$item->id}}').val(), $event.target.value )"
                                                    style="font-size: 1rem!important"
                                                    class="text-center form-control"
                                                    value="{{$item->quantity}}"
                                                    >
                                                </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-lg text-center">${{number_format($item->price * $item->quantity,2)}}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <a class="ml-2 btn btn-red">
                                            <i>del</i>
                                            </a>
                                        </td>

                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @else
                <h5 class="text-center text-muted">Agrega productos para la venta</h5>
                @endif
            </div>
        </section>


            </div>
        </div>
    </div>


</div>

@push('scripts')
        <script src="/adminlte/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>

        <script>

          $('#datepicker').datepicker({
            autoclose: true
          });

          $('#datepicker2').datepicker({
            autoclose: true
          });

          $('.select2').select2();
        </script>
@endpush
