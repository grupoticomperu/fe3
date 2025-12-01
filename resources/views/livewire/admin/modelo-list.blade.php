<div wire:init="loadModelos">

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Lista de Modelos
            </h2>
        </div>

    </x-slot>

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
                        placeholder="buscar" />
                </div>




                @livewire('admin.modelo-create')

                {{--                 <div>
                                 <input type="checkbox" class="flex items-center mr-2 leading-tight" wire-model="state"> Activos
                            </div> --}}

                <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                    <x-jet-input type="checkbox" wire:model="state" class="mx-1" />
                    Activos
                </div>

            </div>



            {{-- @if ($modelos->count()) --}}



            @if (count($modelos))

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
                                wire:click="order('name')">

                                Modelo
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

                        @foreach ($modelos as $modeloo)
                            <tr>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $modeloo->id }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $modeloo->name }}
                                </td>



                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($modeloo->state)
                                        @case(0)
                                            <span wire:click="activar({{ $modeloo }})"
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full cursor-pointer">
                                                inactivo
                                            </span>
                                        @break

                                        @case(1)
                                            <span wire:click="desactivar({{ $modeloo }})"
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full cursor-pointer">
                                                activo
                                            </span>
                                        @break

                                        @default
                                    @endswitch

                                </td>




                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    {{--  <a class="btn btn-blue"><i class="fa-sharp fa-solid fa-eye"></i></a> --}}
                                    <a wire:click="edit({{ $modeloo }})" class="btn btn-green"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="btn btn-red" wire:click="$emit('deleteModelo', {{ $modeloo->id }})">
                                        <i class="fa-solid fa-trash-can"></i>

                                    </a>



                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>







                @if ($modelos->hasPages())
                    <div class="px-6 py-4">
                        {{ $modelos->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-4">

                    <div class="flex items-center justify-center">
                        <svg class="w-10 h-10 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                            fill="blue">
                            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M304 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zm0 416c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM48 304c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm464-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM142.9 437c18.7-18.7 18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zm0-294.2c18.7-18.7 18.7-49.1 0-67.9S93.7 56.2 75 75s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zM369.1 437c18.7 18.7 49.1 18.7 67.9 0s18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9z" />
                        </svg>
                    </div>

                </div>

            @endif






        </x-table>

    </div>


    <x-slot name="footer">

        <h2 class="text-xl font-semibold leading-tight text-gray-600">
            Pie
        </h2>


    </x-slot>





    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Modificando El Modelo
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Modelo" />
                <x-jet-input type="text" class="w-full" wire:model="modelo.name" />
                <x-jet-input-error for="name" />
            </div>

            <div>
                Estado
                <x-jet-input type="checkbox" wire:model="modelo.state" />
                <x-jet-input-error for="state" />
            </div>


        </x-slot>

        <x-slot name="footer">

            <x-jet-button wire:click="$set('open_edit', false)" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="save"
                    class="disabled:opacity-25">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
                </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>



    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @endpush



    {{-- @push('scripts')
        <script src="sweetalert2.all.min.js"></script>
        <script>
            Livewire.on('deleteModelo', modeloId => {
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

                        Livewire.emitTo('admin.modelo-list', 'delete', modeloId);

                        Swal.fire(
                            'Eliminado!',
                            'El Registro fue eliminado.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush --}}


    {{-- @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('deleteModelo', modeloId => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No se podrá revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.modelo-list', 'delete', modeloId);
                        Swal.fire('Eliminado!', 'El registro fue eliminado.', 'success');
                    }
                })
            })
        </script>
    @endpush --}}



    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('deleteModelo', modeloId => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No se podrá revertir esta acción.",
                    icon: 'warning',
                    showCancelButton: true,
                    buttonsStyling: false, // ✅ desactiva los estilos propios de SA2
                    confirmButtonText: 'Sí, eliminar!',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'rounded-2xl shadow-lg', // ventana del modal
                        title: 'text-gray-800 text-lg font-semibold',
                        htmlContainer: 'text-gray-700',
                        confirmButton: 'px-4 py-2 rounded-md bg-blue-600 text-white font-semibold hover:bg-blue-700 focus:outline-none',
                        cancelButton: 'ml-2 px-4 py-2 rounded-md bg-gray-300 text-gray-800 font-semibold hover:bg-gray-400 focus:outline-none'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.modelo-list', 'delete', modeloId);

                        Swal.fire({
                            title: 'Eliminado!',
                            text: 'El registro fue eliminado correctamente.',
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: 'rounded-2xl shadow-lg',
                                title: 'text-gray-800 text-lg font-semibold',
                                htmlContainer: 'text-gray-700',
                                confirmButton: 'px-4 py-2 rounded-md bg-blue-600 text-white font-semibold hover:bg-blue-700 focus:outline-none'
                            }
                        });
                    }
                });
            });
        </script>
    @endpush





</div>
