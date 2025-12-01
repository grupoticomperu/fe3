<div>
    <div wire:init="loadResumenes">


        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-600">
                    Lista de Boletas
                </h2>
            </div </x-slot>


            <div class="max-w-full py-12 mx-auto border-gray-400 sm:px-6 lg:px-8">
                <div class="px-6 py-4 bg-gray-200">
                    <div class="grid items-center gap-4 sm:grid-cols-6 lg:grid-cols-12">

                        <div class="col-span-1 sm:col-span-4 lg:col-span-3 ">
                            {{-- <x-jet-label value="Fecha de Emisión" /> --}}
                            <x-jet-input type="date" wire:model="fechaemision"
                                value="{{ old('fechaemision') }}" class="w-full h-10"
                                placeholder="fecha de emisión" />
                            <x-jet-input-error for="fechaemision" />
                        </div>

                        <div class="col-span-1 sm:col-span-2 lg:col-span-9">
                            <button class="items-center h-10 px-4 btn btn-orange" wire:click="save">
                                <i class="mx-2 fa-regular fa-file"></i> generar Resumen
                            </button>
                        </div>

                    </div>
                </div>



                <x-table>


                    @if (count($boletas))


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
                                        wire:click="order('fechaemision')">

                                        Fecha de Emisión
                                        @if ($sort == 'fechaemision')
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
                                        wire:click="order('serienumero')">
                                        Serie Número
                                        @if ($sort == 'serienumero')
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
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                        ACCIONES
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">



                                @foreach ($boletas as $comprobante)
                                    <tr>

                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $comprobante->id }}
                                        </td>
                                        <td class="items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                            {{--  {{ $comprobante->fechaemision }} --}}
                                            {{ \Carbon\Carbon::parse($comprobante->fechaemision)->format('d/m/Y') }}

                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $comprobante->serienumero }}
                                        </td>


                                        <td class="items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $comprobante->total }}

                                        </td>








                                        <td class="flex px-6 py-4 text-sm font-medium text-right whitespace-nowrap">



                                        </td>
                                    </tr>
                                @endforeach
                                <!-- More people... -->
                            </tbody>
                        </table>




                        @if ($boletas->hasPages())
                            <div class="px-6 py-4">
                                {{ $boletas->links() }}
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
                    TICOM SOFTWARE
                </h2>


            </x-slot>






            @push('scripts')
            @endpush

    </div>

</div>



