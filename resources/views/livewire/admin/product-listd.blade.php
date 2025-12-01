<div>
    {{-- <div wire:init="loadProducts"> --}}


    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="mr-4 text-xl font-semibold leading-tight text-gray-600">
                Lista de Productos
            </h2>
            {{-- <x-jet-button wire:click="generateReport">Exportar</x-jet-button> --}}
        </div>
    </x-slot>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">

        {{--  @can('Banner Export') --}}
        {{-- <div class="p-4 mb-6 bg-white">

            <div class="flex flex-col items-center justify-between md:flex-row">
                @can('Export Excel Product')
                    <x-jet-button wire:click="generateReport" class="mb-2 md:mb-0 md:mr-4">Exportar</x-jet-button>
                @endcan
                @can('Export Pdf Product')
                    <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md md:mb-0 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25"
                        href="{{ route('product.reportpdf') }}" target="_blank">Reporte PDF</a>
                @endcan
                @can('Import Excel Product')
                    <div class="mt-2 mb-2 text-center md:mt-0 md:ml-4">
                        <div class="box-border inline-block p-2 border-2 rounded-md">
                            <form action="{{ route('product.importstore') }}" method="POST" enctype="multipart/form-data">
                                @csrf



                                <input type="file" name="file" accept=".csv, .xlxs">
                                <x-jet-button class="mt-2">Importar</x-jet-button>
                                <x-jet-input-error for="file" />

                            </form>
                        </div>
                    </div>
                @endcan

            </div>
        </div> --}}
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
                    class="flex items-center justify-center w-80 sm:w-full rounded-lg py-2.5" placeholder="buscar" />
            </div>



            <div class="flex items-center justify-center">
                <a href="{{ route('admin.product.create') }}"
                    class="items-center justify-center sm:flex btn btn-orange">
                    <i class="mx-2 fa-regular fa-file"></i> Nuevo
                </a>
            </div>


            <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                <x-jet-input type="checkbox" wire:model="state" class="mx-1" />
                Activos
            </div>



        </div>

        <div class="items-center px-6 py-4 bg-gray-200 sm:flex">

            @can('Product Delete')
                <div class="flex items-center justify-center">
                    <button wire:click="deleteSelected"
                        class="items-center justify-center p-2 text-whit sm:flex btn btn-red">Eliminar
                        seleccionados</button>
                </div>
            @endcan





        </div>


        <x-table>





            {{-- @if ($products > count()) --}}


            @if (count($products))


                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            @can('Product Delete')
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
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Imagen
                            </th>


                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('category_id')">

                                Categoria
                                @if ($sort == 'category_id')
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

                                Producto
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
                                wire:click="order('codbarras')">

                                Cod. Barra
                                @if ($sort == 'codbarras')
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
                                wire:click="order('saleprice')">

                                Precio venta
                                @if ($sort == 'saleprice')
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

                        @foreach ($products as $product)
                            <tr>
                                @can('Product Delete')
                                    <td class="px-2 py-4 text-sm text-gray-500 ">
                                        {{-- <input type="checkbox" wire:model="selectedBrands.{{ $product->id }}"> --}}
                                        <x-jet-input type="checkbox" wire:model="selectedProducts.{{ $product->id }}"
                                            class="mx-1" />

                                    </td>
                                @endcan

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $product->id }}
                                </td>


                                <td class="flex items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                    <div class="flex-shrink-0 h-10 w-15 ">

                                        @if ($product->image1)
                                            <img class="object-cover w-10 h-10 rounded-sm"
                                                src="{{ Storage::disk('s3')->url($product->image1) }}"
                                                alt="{{ $product->name }}">
                                        @else
                                            <img class="object-cover h-6 rounded-full w-15"
                                                src="{{ asset('storage/brands/product-default.jpg') }}"
                                                alt="{{ $product->name }}" class="m-2">
                                        @endif




                                    </div>
                                    {{-- <div class="ml-4">
                                            {{ $product->name }}
                                        </div> --}}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    @isset($product->category->name)
                                        {{ $product->category->name }}
                                    @endisset

                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $product->name }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $product->codigobarras }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap text-right">
                                    {{ $product->currency->abbreviation }}  {{ number_format($product->saleprice, 2) }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($product->state)
                                        @case(0)
                                            @can('Product Update')
                                                <span wire:click="activar({{ $product }})"
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
                                            @can('Product Update')
                                                <span wire:click="desactivar({{ $product }})"
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

                                    @can('Product Show')
                                        <a wire:click="show({{ $product }})" class="btn btn-blue">
                                            <i class="fa-sharp fa-solid fa-eye"></i></a>
                                    @endcan
                                    {{-- @can('Product Update') --}}
                                    <a href="{{ route('admin.product.edit', ['productId' => $product->id]) }}"
                                        class="btn btn-green">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    {{--  @endcan --}}
                                    @can('Product Delete')
                                        <a class="btn btn-red" wire:click="$emit('deleteProduct', {{ $product->id }})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    @endcan



                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>




                @if ($products->hasPages())
                    <div class="px-6 py-4">
                        {{ $products->links() }}
                    </div>
                @endif
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





        </x-table>

    </div>


    <x-slot name="footer">

        <h2 class="text-xl font-semibold leading-tight text-gray-600">
            Pie
        </h2>


    </x-slot>







    @push('scripts')
        <script src="sweetalert2.all.min.js"></script>

        <script>
            Livewire.on('deleteProduct', productId => {
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

                        Livewire.emitTo('admin.product-listd', 'delete', productId);

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
