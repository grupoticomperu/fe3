<div>
    {{-- <div wire:init="loadBrands"> --}}
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="mr-4 text-xl font-semibold leading-tight text-gray-600">
                Lista de Marcas
            </h2>
            {{-- <x-jet-button wire:click="generateReport">Exportar</x-jet-button> --}}
        </div>
    </x-slot>


    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">

        {{--  @can('Banner Export') --}}
        <div class="p-4 mb-6 bg-white">

            <div class="flex flex-col items-center justify-between md:flex-row">
                @can('Export Excel')
                    <x-jet-button wire:click="generateReport" class="mb-2 md:mb-0 md:mr-4">Exportar</x-jet-button>
                @endcan
                @can('Export Pdf')
                    <a class="inline-flex items-center px-4 py-2 mb-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md md:mb-0 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25"
                        href="{{ route('brand.reportpdf') }}" target="_blank">Reporte PDF</a>
                @endcan
                @can('Import Excel')
                    <div class="mt-2 mb-2 text-center md:mt-0 md:ml-4">
                        <div class="box-border inline-block p-2 border-2 rounded-md">
                            <form action="{{ route('brand.importstore') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- <x-jet-validation-errors class="mb-4"> --}}

                                <input type="file" name="file" accept=".csv, .xlxs">
                                <x-jet-button class="mt-2">Importar</x-jet-button>
                                <x-jet-input-error for="file" />

                            </form>
                        </div>
                    </div>
                @endcan

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
                    class="flex items-center justify-center w-80 sm:w-full rounded-lg py-2.5" placeholder="buscar" />
            </div>

            @can('Brand Create')
                @livewire('admin.brand-create')
            @endcan

            <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                <x-jet-input type="checkbox" wire:model="state" class="mx-1" />
                Activos
            </div>

        </div>

        <div class="items-center px-6 py-4 bg-gray-200 sm:flex">

            @can('Brand Delete')
                <div class="flex items-center justify-center">
                    <button wire:click="deleteSelected"
                        class="items-center justify-center p-2 text-whit sm:flex btn btn-red">Eliminar
                        seleccionados</button>
                </div>
            @endcan

            <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                <x-jet-input type="checkbox" wire:model="order" class="mx-1" />
                Order
            </div>
        </div>

        <x-table>

            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">

                @can('Web View')
                    <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                        <x-jet-input type="checkbox" wire:model="title" class="mx-1" />
                        Title Google
                    </div>
                    <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                        <x-jet-input type="checkbox" wire:model="description" class="mx-1" />
                        Descriptión Google
                    </div>

                    <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                        <x-jet-input type="checkbox" wire:model="keywords" class="mx-1" />
                        Keywords
                    </div>
                @endcan

            </div>

            {{-- @if ($brands->count()) --}}

            @if (count($brands))


                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            @can('Brand Delete')
                                <th
                                    class="w-12 px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                                    {{-- <input type="checkbox" wire:model="selectAll"> --}}
                                    <x-jet-input type="checkbox" wire:model="selectAll" class="mx-1" />
                                    {{-- {{ $selectAll }} --}}
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
                                wire:click="order('name')">

                                Marca
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

                            @if ($order)
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="order('order')">

                                    Orden
                                    @if ($sort == 'order')
                                        @if ($direction == 'asc')
                                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                        @else
                                            <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                        @endif
                                    @else
                                        <i class="float-right mt-1 fas fa-sort"></i>
                                    @endif

                                </th>
                            @endif

                            @can('Web View')
                                @if ($title)
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                        wire:click="order('title')">

                                        Title
                                        @if ($sort == 'title')
                                            @if ($direction == 'asc')
                                                <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                            @else
                                                <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                            @endif
                                        @else
                                            <i class="float-right mt-1 fas fa-sort"></i>
                                        @endif

                                    </th>
                                @endif

                                @if ($description)
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                        wire:click="order('description')">

                                        Descripción
                                        @if ($sort == 'description')
                                            @if ($direction == 'asc')
                                                <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                            @else
                                                <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                            @endif
                                        @else
                                            <i class="float-right mt-1 fas fa-sort"></i>
                                        @endif

                                    </th>
                                @endif

                                @if ($keywords)
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                        wire:click="order('keywords')">

                                        Keywords
                                        @if ($sort == 'keywords')
                                            @if ($direction == 'asc')
                                                <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                                            @else
                                                <i class="float-right mt-1 fas fa-sort-alpha-down-alt"></i>
                                            @endif
                                        @else
                                            <i class="float-right mt-1 fas fa-sort"></i>
                                        @endif

                                    </th>
                                @endif
                            @endcan

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

                        @foreach ($brands as $brandd)
                            <tr>
                                @can('Brand Delete')
                                    <td class="px-2 py-4 text-sm text-gray-500 ">
                                        {{-- <input type="checkbox" wire:model="selectedBrands.{{ $brandd->id }}"> --}}
                                        <x-jet-input type="checkbox" wire:model="selectedBrands.{{ $brandd->id }}"
                                            class="mx-1" />

                                    </td>
                                @endcan

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $brandd->id }}
                                </td>



                                <td class="flex items-center px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                    <div class="flex-shrink-0 h-10 w-15 ">

                                        @if ($brandd->image)
                                            <img class="object-cover w-20 h-10 rounded-sm"
                                                src="{{ Storage::disk('s3')->url($brandd->image) }}"
                                                alt="{{ $brandd->name }}">
                                            {{-- src="{{ url($category->image) }}" alt="{{ $category->name }}"> --}}
                                            {{-- src="{{ Storage::url($brand->image) }}" storage//storage/brand/default.jpg  en la bd esta puesto esto 	/storage/brands/default.jpg > --}}
                                            {{-- url($brand->image) muestra tal como es la ruta en la bd esta puesto esto 	/storage/brands/default.jpg --}}
                                            {{--  {{ Storage::disk("s3")->url($brand->image) }} --}}
                                        @else
                                            <img class="object-cover h-6 rounded-full w-15"
                                                src="{{ asset('storage/brands/category-default.jpg') }}"
                                                alt="{{ $brandd->name }}" class="m-2">
                                        @endif


                                        {{-- @if ($brandd->image)
                                                <img class="object-cover w-20 h-10 rounded-sm"
                                                    src="{{ url($brandd->image) }}" alt="{{ $brandd->name }}">
                                            @else
                                                <img class="object-cover w-20 h-10 rounded-full"
                                                    src="{{ asset('storage/brands/brand-default.jpg') }}"
                                                    alt="{{ $brandd->name }}">
                                            @endif --}}
                                    </div>
                                    {{-- <div class="ml-4">
                                            {{ $brandd->name }}
                                        </div> --}}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $brandd->name }}
                                </td>

                                @if ($order)
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $brandd->order }}
                                    </td>
                                @endif

                                @can('Web View')
                                    @if ($title)
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $brandd->title }}
                                        </td>
                                    @endif

                                    @if ($description)
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $brandd->description }}
                                        </td>
                                    @endif

                                    @if ($keywords)
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $brandd->keywords }}
                                        </td>
                                    @endif
                                @endcan


                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($brandd->state)
                                        @case(0)
                                            @can('Brand Update')
                                                <span wire:click="activar({{ $brandd }})"
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
                                            @can('Brand Update')
                                                <span wire:click="desactivar({{ $brandd }})"
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

                                    @can('Brand Show')
                                        <a wire:click="show({{ $brandd }})" class="btn btn-blue">
                                            <i class="fa-sharp fa-solid fa-eye"></i></a>
                                    @endcan
                                    @can('Brand Update')
                                        <a wire:click="edit({{ $brandd }})" class="btn btn-green">
                                            <i class="fa-solid fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('Brand Delete')
                                        <a class="btn btn-red" wire:click="$emit('deleteBrand', {{ $brandd->id }})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    @endcan



                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>




                @if ($brands->hasPages())
                    <div class="px-6 py-4">
                        {{ $brands->links() }}
                    </div>
                @endif
            @else
                <div wire:init="loadBrands">

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
            Facturaciòn Electrónica
        </h2>

    </x-slot>





    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Modificando la Marca
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Marca" />
                <x-jet-input type="text" class="w-full uppercase" wire:model="brand.name" />
                <x-jet-input-error for="brand.name" />
            </div>


            @can('Web View')
                <div class="mb-4">
                    <x-jet-label value="Title Google" />
                    <x-jet-input type="text" class="w-full" wire:model="brand.title" />
                    <x-jet-input-error for="title" />
                </div>

                <div class="mb-4">
                    <x-jet-label value="Description Google" />

                    {{-- <textarea name="description" rows="5" cols="50">Descripción para google</textarea> --}}


                    <textarea {{-- wire:model.defer="content" --}} wire:model="brand.description" class="w-full form-control" rows="5">
                        </textarea>


                    <x-jet-input-error for="description" />
                </div>

                <div class="mb-4">
                    <x-jet-label value="Keywords Google" />
                    <x-jet-input type="text" class="w-full" wire:model="brand.keywords" />
                    <x-jet-input-error for="keywords" />
                </div>
            @endcan


            <div class="flex row">
                <div class="mb-4 mr-4">
                    <x-jet-label value="Estado" />
                    <x-jet-input type="checkbox" wire:model="brand.state" />
                    <x-jet-input-error for="state" />
                </div>

                <div class="mb-4">
                    <x-jet-label value="Orden" />
                    <x-jet-input type="number" class="w-full" wire:model="brand.order" />
                    <x-jet-input-error for="order" />
                </div>
            </div>






            <div class="box-border p-4 mb-4 border-2 rounded-md">
                <x-jet-label value="Seleccione una Imagen para Modificar" class="mb-2" />

                {{-- <input type="file" wire:model="brand.image" id="{{ $identificador }}"> --}}
                <input type="file" wire:model="image" id="{{ $identificador }}"> {{-- borramos accept="image/*" --}}
                <x-jet-input-error for="image" />
            </div>

            <div wire:loading wire:target="image"
                class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                <strong class="font-bold">Cargando imagen!</strong>
                <span class="block sm:inline">Espere un momento.</span>

            </div>

            {{-- @if ($image)
                    <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">
                @elseif($brand->image)
                    <img src="{{ url($brand->image) }}" alt="ticom">
                @endif --}}

            @if ($image && in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="cargando imagen">
            @elseif($brand->image)
                {{-- <img src="{{ url($brand->image) }}" alt="ticom"> --}}
                <img class="object-cover w-20 h-10 rounded-sm" src="{{ Storage::disk('s3')->url($brand->image) }}"
                    alt="TICOM">
            @endif


        </x-slot>

        <x-slot name="footer">

            <x-jet-button wire:click="cancelar" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="image"
                    class="disabled:opacity-25">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
                </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="open_view">
        <x-slot name="title">
            Marca
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Marca" />
                <x-jet-input type="text" class="w-full uppercase" wire:model="brand.name" readonly />

            </div>


            @can('Web View')
                <div class="mb-4">
                    <x-jet-label value="Title Google" />
                    <x-jet-input type="text" class="w-full" wire:model="brand.title" readonly />

                </div>

                <div class="mb-4">
                    <x-jet-label value="Description Google" />

                    {{-- <textarea name="description" rows="5" cols="50">Descripción para google</textarea> --}}


                    <textarea {{-- wire:model.defer="content" --}} wire:model="brand.description" class="w-full form-control" rows="5" readonly>
                        </textarea>



                </div>

                <div class="mb-4">
                    <x-jet-label value="Keywords Google" />
                    <x-jet-input type="text" class="w-full" wire:model="brand.keywords" readonly />

                </div>
            @endcan


            <div class="flex row">
                <div class="mb-4 mr-4">
                    <x-jet-label value="Estado" />
                    {{-- <x-jet-input type="checkbox" wire:model="brand.state" readonly /> --}}
                    @if ($brand->state == 1)
                        <x-jet-input type="text" class="w-full" value="activo" readonly />
                    @else
                        <x-jet-input type="text" class="w-full" value="desactivo" readonly />
                    @endif


                </div>

                <div class="mb-4">
                    <x-jet-label value="Orden" />
                    <x-jet-input type="number" class="w-full" wire:model="brand.order" readonly />

                </div>
            </div>


            {{-- @if ($image)
                    <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">
                @elseif($brand->image)
                    <img src="{{ url($brand->image) }}" alt="ticom">
                @endif --}}

            @if ($brand->image)
                <img class="object-cover w-20 h-10 rounded-sm" src="{{ Storage::disk('s3')->url($brand->image) }}"
                    alt="ticom">
            @else
                <p>No hay imagen</p>
            @endif


        </x-slot>

        <x-slot name="footer">

            <x-jet-button wire:click="cerrar" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
                </x-jet-secondary-button>



        </x-slot>

    </x-jet-dialog-modal>

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
