<x-app-layout>

<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="mr-10 text-xl font-semibold leading-tight text-gray-600">
                {{ $product->name}}
            </h2>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
              </svg>

        </div
    </x-slot>

    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">



        <x-table>



            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                        <tr>

                        <th scope="col"
                            class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                           {{--  wire:click="order('id') --}}">

                            ID


                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                            {{-- wire:click="order('name') --}}">

                            Código


                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">

                            Precio de compra

                        </th>

                        <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">

                        Precio de venta

                        </th>

                        <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">

                        Precio al por mayor

                        </th>



                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                            {{-- wire:click="order('state') --}}">
                            Estado

                        </th>

                        <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">


                        Atributos


                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">


                            IMAGEN


                        </th>

                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                           ACCIONES
                        </th>

                    </tr>
                </thead>



                <tbody class="bg-white divide-y divide-gray-200">

                <form method="POST" action="{{ route('admin.productatribute.updatecodigo') }}" >
                     {{ csrf_field() }}
                    {{--  {{ method_field('PUT')}} --}}


                    @foreach ($product->productatributes as $productatribute )

                        <tr>

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{$productatribute->id}}
                            </td>


                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                 <x-jet-input type="text" id="#c{{$productatribute->id}}"
                                    name="{{$productatribute->id}}"
                                    value="{{$productatribute->codigo}}"
                                    class="flex items-center justify-center w-40  rounded-lg py-2.5"
                                     />
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                S/. {{$productatribute->price}}
                                 {{-- <x-jet-input type="text" id="#p{{$productatribute->id}}"
                                        name="{{$productatribute->id}}"
                                        value="{{$productatribute->price}}"
                                        class="flex items-center justify-center w-40  rounded-lg py-2.5"
                                         /> --}}

                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                S/. {{$productatribute->price}}
                                 {{-- <x-jet-input type="text" id="#p{{$productatribute->id}}"
                                        name="{{$productatribute->id}}"
                                        value="{{$productatribute->price}}"
                                        class="flex items-center justify-center w-40  rounded-lg py-2.5"
                                         /> --}}

                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                S/. {{$productatribute->price}}
                                 {{-- <x-jet-input type="text" id="#p{{$productatribute->id}}"
                                        name="{{$productatribute->id}}"
                                        value="{{$productatribute->price}}"
                                        class="flex items-center justify-center w-40  rounded-lg py-2.5"
                                         /> --}}

                            </td>



                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{$productatribute->state}}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                @foreach ($productatribute->atributes as $atribute)

                                    {{ $atribute->name}}
                                    @if (!$loop->last)
                                    -
                                    @endif



                                @endforeach

                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                <p>imagen</p>
                                 {{-- <x-jet-input type="text" id="#p{{$productatribute->id}}"
                                        name="{{$productatribute->id}}"
                                        value="{{$productatribute->price}}"
                                        class="flex items-center justify-center w-40  rounded-lg py-2.5"
                                         /> --}}

                            </td>

                            <td class="flex w-32 gap-1 px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <a class="btn btn-blue" href="{{ route('admin.productatribute.addimage', $productatribute) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                </svg>
                                </a>

                                <a class="btn btn-red">
                                   <i class="fa-solid fa-trash-can"></i>
                                </a>



                            </td>


                    {{--   <td class="px-6 py-4 whitespace-nowrap">
                                @switch($brandd->state)
                                    @case(0)
                                        <span wire:click="activar({{ $brandd }})"
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full cursor-pointer">
                                            inactivo
                                        </span>
                                    @break
                                    @case(1)
                                        <span wire:click="desactivar({{ $brandd }})"
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full cursor-pointer">
                                            activo
                                        </span>
                                    @break
                                    @default

                                @endswitch

                            </td> --}}





                        </tr>

                  {{--       @php
                            $list = Arr::add($list, {{$productatribute->id}} , 6);
                        @endphp --}}

                    @endforeach

                   <div class="items-center gap-4 px-6 py-4 bg-gray-200 sm:flex">
                        <x-jet-danger-button type="submit" class="disabled:opacity-25">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar Códigos
                        </x-jet-danger-button>

                        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 " href="{{ route('admin.productatribute.pricepurchase', $product) }}" >
                            <i class="mx-2 fa-regular fa-file"></i> Modificar Precio de Compra
                         </a>

                        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 " href="{{ route('admin.productatribute.pricesale', $product) }}" >
                            <i class="mx-2 fa-regular fa-file"></i> Modificar Precio de Venta
                         </a>




                        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 " href="{{ route('admin.productatribute.pricewholesale', $product) }}" >
                            <i class="mx-2 fa-regular fa-file"></i> Modificar Precio de venta por Mayor
                         </a>


                         <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 " href="{{ route('admin.productatribute.delete', $product) }}" >
                            <i class="mx-2 fa-regular fa-file"></i> Activar Eliminar
                        </a>





                    </div>




                </form>

                </tbody>
            </table>

        </x-table>


    </div>

</div>
</x-app-layout>
