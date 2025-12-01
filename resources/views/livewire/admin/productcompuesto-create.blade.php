<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Producto Compuesto
            </h2>
        </div
    </x-slot>

    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">



        <x-table>
            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">
                <h2>{{ $product->name }}</h2>
            </div>

            <div class="mt-4">
               {{-- i --}} {{-- {{ $i = 0 }} --}}
               @php
                   $i = 0
               @endphp
               <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-64 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                            ATRIBUTOS
                        </th>
                        <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">

                            VALORES
                        </Th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                @foreach ( $groupatributes as $groupatribute)
                   @if($groupatribute->id != 1)
                    <tr>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                        {{-- <div class="flex"> --}}
                            <h2 class="mb-4 ml-4 mr-4 font-bold">{{  $groupatribute->name }}</h2>
                        {{-- i {{ $i = $i + 1 }} --}}
                            </td>

                        {{-- j{{ $j = 0 }} --}}

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                {{-- <div class="flex"> --}}
                                    @foreach ( $groupatribute->atributes as $atribute )
                                    {{-- j --}}  {{-- {{ $j = $j + 1 }} --}}
                                        <x-jet-label class="flex mr-4">

                                            <x-jet-checkbox

                                            wire:model.defer="atributesphp"
                                            {{-- wire:click="contadores({{$i}}, {{$j}})" --}}
                                            name="atributes[{{$i}}][{{$j}}]"
                                            {{--  value="[{{$atribute->id}}]" /> --}}
                                            value="[{{$groupatribute->name}}=>{{$atribute->id}}]" />
                                            {{--  si activamos el checkbox los datos viajan a atribustesphp
                                                si descativamos quita el valor de atribustesphp porque es wiremodel --}}

                                            <p class="ml-1">{{$atribute->name}}</p>
                                        </x-jet-label>
                                    @endforeach
                            {{--  </div> --}}
                            </td>

                            {{--  </div> --}}
                        </tr>
                    @endif
                @endforeach
                </tbody>
               </table>

            </div>

        </x-table>
            @if(session('idCarrito')=='123456')
            <x-jet-danger-button wire:click="crear" wire:loading.attr="disabled" wire:target="crear" class="w-40 mt-8">
                Crear
            </x-jet-danger-button>
            @endif

    </div>


    <x-slot name="footer">

            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Pie
            </h2>


    </x-slot>


</div>
