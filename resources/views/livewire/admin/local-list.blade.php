<div>
    {{-- <div wire:init="loadBrands"> --}}


    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="mr-4 text-xl font-semibold leading-tight text-gray-600">
                Lista de Locales
            </h2>
            {{-- <x-jet-button wire:click="generateReport">Exportar</x-jet-button> --}}
        </div </x-slot>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">

            {{--  @can('Banner Export') --}}
            <div class="p-4 mb-6 bg-white">
                {{-- <div class="flex items-center justify-between"> --}}
                <div class="flex flex-col items-center justify-between md:flex-row">
                    {{-- @can('Export Excel')
                        <x-jet-button wire:click="generateReport" class="mb-2 md:mb-0 md:mr-4">Exportar</x-jet-button>
                    @endcan
                    @can('Export Pdf')
                        <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md md:mb-0 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25"
                            href="{{ route('local.reportpdf') }}" target="_blank">Reporte PDF</a>
                    @endcan
                    @can('Import Excel')
                        <div class="mt-2 mb-2 text-center md:mt-0 md:ml-4">
                            <div class="box-border inline-block p-2 border-2 rounded-md">
                                <form action="{{ route('brand.importstore') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="file" name="file" accept=".csv, .xlxs">
                                    <x-jet-button class="mt-2">Importar</x-jet-button>
                                    <x-jet-input-error for="file" />

                                </form>
                            </div>
                        </div>
                    @endcan --}}

                </div>
            </div>
            {{--  @endcan --}}

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
                        placeholder="buscar" />
                </div>



                @can('Local Create')
                     {{-- @livewire('admin.local-create') --}}

                     <div class="flex items-center justify-center ml-2">
                        <a href="{{ route('local.create') }}" class="items-center justify-center sm:flex btn btn-orange" >
                            <i class="mx-2 fa-regular fa-file"></i> Nuevo
                        </a>

                    </div>
                @endcan

                {{-- <div>
                             <input type="checkbox" class="flex items-center mr-2 leading-tight" wire-model="state"> Activos
                        </div> --}}

                <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                    <x-jet-input type="checkbox" wire:model="state" class="mx-1" />
                    Activos
                </div>



            </div>


            <x-table>





                {{-- @if ($brands->count()) --}}


                @if (count($locals))


                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                @can('Local Delete')
                                    <th
                                        class="w-12 px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                                        {{-- <input type="checkbox" wire:model="selectAll"> --}}
                                        <x-jet-input type="checkbox" wire:model="selectAll" class="mx-1" />
                                    </th>
                                @endcan

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
                                    wire:click="order('name')">

                                    Local
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
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('codigopostal')">
                                    Codigo Postal
                                    @if ($sort == 'codigopostal')
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
                                    wire:click="order('anexo')">
                                    Anexo
                                    @if ($sort == 'anexo')
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
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    ACCIONES
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($locals as $local)
                                <tr>
                                    @can('Local Delete')
                                        <td class="px-2 py-4 text-sm text-gray-500 ">
                                            {{-- <input type="checkbox" wire:model="selectedBrands.{{ $brandd->id }}"> --}}
                                            <x-jet-input type="checkbox" wire:model="selectedLocals.{{ $local->id }}"
                                                class="mx-1" />

                                        </td>
                                    @endcan

                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $local->id }}
                                    </td>




                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $local->name }}
                                    </td>


                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $local->codigopostal }}
                                    </td>



                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $local->anexo }}
                                    </td>



                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($local->state)
                                            @case(0)
                                                @can('Local Update')
                                                    <span wire:click="activar({{ $local }})"
                                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full cursor-pointer">
                                                        inactivo
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                        inactivo
                                                    </span>
                                                @endcan
                                            @break

                                            @case(1)
                                                @can('Local Update')
                                                    <span wire:click="desactivar({{ $local }})"
                                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full cursor-pointer">
                                                        activo
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                        activo
                                                    </span>
                                                @endcan
                                            @break

                                            @default
                                        @endswitch

                                    </td>


                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        {{-- <a class="btn btn-blue"><i class="fa-sharp fa-solid fa-eye"></i></a> --}}

                                        {{-- @can('Local Show')
                                            <a wire:click="show({{ $local }})" class="btn btn-blue">
                                                <i class="fa-sharp fa-solid fa-eye"></i></a>
                                        @endcan --}}
                                        @can('Local Update')


                                            {{-- <a href="{{ route('local.edit', $local) }}"
                                                    class="btn btn-green"><i class="fa-solid fa-pen-to-square"></i></a> --}}

                                            <a href="{{ route('locald.edit', $local) }}"
                                                    class="btn btn-green"><i class="fa-solid fa-pen-to-square"></i></a>

                                        @endcan
                                        @can('Local Delete')
                                            <a class="btn btn-red"
                                                wire:click="$emit('deleteLocal', {{ $local->id }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        @endcan



                                    </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>




                    @if ($locals->hasPages())
                        <div class="px-6 py-4">
                            {{ $locals->links() }}
                        </div>
                    @endif
                @else
                    <div wire:init="loadLocals">

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





            </x-table>

        </div>


        {{-- <x-slot name="footer">

            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Pie
            </h2>


        </x-slot> --}}







        @push('scripts')
            <script src="sweetalert2.all.min.js"></script>

            <script>
                Livewire.on('deleteBrand', brandId => {
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

                            Livewire.emitTo('admin.brand-list', 'delete', brandId);

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
