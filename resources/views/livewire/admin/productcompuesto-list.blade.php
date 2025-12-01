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
            <div class="flex">
                <div>
                    {{ $product->name}}
                </div>
                <div class="flex items-center justify-center" >
                    <button class="items-center justify-center sm:flex btn btn-orange" wire:click="save">
                       <i class="mx-2 fa-regular fa-file"></i> Nuevo
                    </button >

                </div>
            </div>


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
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                            {{-- wire:click="order('name') --}}">

                            price


                        </th>



                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                            {{-- wire:click="order('state') --}}">
                            Estado

                        </th>

                        <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                        {{-- wire:click="order('name') --}}">

                        Atributos


                        </th>




 {{--                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                           ACCIONES
                        </th> --}}
                    </tr>
                </thead>



                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($product->productatributes as $productatribute )

                        <tr>

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{$productatribute->id}}
                            </td>


                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{$productatribute->codigo}}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{-- {{$productatribute->price}}  --}}

                                <x-jet-input type="text" id="#p{{$productatribute->id}}" wire:model.defer="list"
                                        name="p{{$productatribute->id}}"
                                        value="[p{{$productatribute->id}} => $('#p' + {{$productatribute->id}}).val()]"
                                        class="flex items-center justify-center w-40  rounded-lg py-2.5"

                                         />

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

                    @endforeach
                    <!-- More people... -->

                   {{--  {{ $list[0] }} --}}


                </tbody>
            </table>

        </x-table>


    </div>

</div>
