<div>
    <div wire:init="loadReceptions">


        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-600">
                    Lista de Recepciones
                    {{-- {{  $users }} --}}

                </h2>
            </div </x-slot>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">



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
                            <x-jet-input type="text" wire:model="search"
                                class="flex items-center justify-center w-80 sm:w-full rounded-lg py-2.5"
                                placeholder="Buscar" />
                        </div>




                    </div>



                    {{-- @if ($receptions->count()) --}}


                    @if (count($receptions))


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
                                        wire:click="order('fechaenvio')">

                                        Fecha de Envio
                                        @if ($sort == 'fechaenvio')
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
                                        wire:click="order('fechaaceptacion')">

                                        Fecha de Aceptación
                                        @if ($sort == 'fechaaceptacion')
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
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        wire:click="order('state')">
                                        Estado
                                        @if ($sort == 'state')
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
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        wire:click="order('total')">
                                        Total
                                        @if ($sort == 'total')
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
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        wire:click="order('userrecibe')">
                                        Usuario que Solicito
                                        @if ($sort == 'name')
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
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        wire:click="order('userqueacepto')">
                                        Usuario que acepto
                                        @if ($sort == 'name')
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
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        wire:click="order('name')">
                                        Local que Envio
                                        @if ($sort == 'name')
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
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        ACCIONES
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($receptions as $reception)
                                    <tr>

                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $reception->id }}
                                        </td>
                                        <td class="items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                            {{ $reception->fechaenvio }}
                                        </td>
                                        <td class="items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $reception->fechaaceptacion }}

                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                            @if ($reception->state == 2)
                                                Pendiente
                                            @elseif($reception->state == 3)
                                                Recibido
                                            @endif
                                        </td>


                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $reception->total }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            @if ($reception->userRecibe)
                                                {{ $reception->userRecibe->name }}
                                            @endif

                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            @if ($reception->userAcepta)
                                                {{ $reception->userAcepta->name }}
                                            @endif

                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $reception->localEnvia->name }} - {{ $reception->localEnvia->address }}


                                        </td>


                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a href="{{ route('reception.edit', $reception) }}" class="btn btn-green"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>

                                            {{--  @can('shipment Update')
                                                <a href="{{ route('admin.shipment.edit', $reception) }}"
                                                    class="btn btn-green"><i class="fa-solid fa-pen-to-square"></i></a>
                                            @endcan --}}


                                        </td>
                                    </tr>
                                @endforeach
                                <!-- More people... -->
                            </tbody>
                        </table>




                        @if ($receptions->hasPages())
                            <div class="px-6 py-4">
                                {{ $receptions->links() }}
                            </div>
                        @endif
                    @else
                        {{-- <div wire:init="loadUsers">

                                </div> --}}


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





                </x-table>

            </div>


            <x-slot name="footer">

                <h2 class="text-xl font-semibold leading-tight text-gray-600">
                    Pie
                </h2>


            </x-slot>






            @push('scripts')
            @endpush

    </div>

</div>
