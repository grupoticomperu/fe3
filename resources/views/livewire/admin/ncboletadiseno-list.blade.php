<div wire:init="loadNcboletadisenos">
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="mr-4 text-xl font-semibold leading-tight text-gray-600">
                Lista de Diseños de NC Boletas
            </h2>

        </div>
    </x-slot>

    <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">
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
                <a href="{{ route('admin.ncboletadiseno.create') }}"
                    class="items-center justify-center sm:flex btn btn-orange">
                    <i class="mx-2 fa-regular fa-file"></i> Nuevo
                </a>
            </div>
            <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                <x-jet-input type="checkbox" wire:model="state" class="mx-1" />
                Activos
            </div>

        </div>

        <x-table>
            @if (count($ncboletasdisenos))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('id')">
                                Id

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
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">

                                Nombre
                            </th>
                            <th scope="col"
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('numdoc')">
                                Nombre Blade
                                @if ($sort == 'numdoc')
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
                                class="w-36 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                wire:click="order('nomrazonsocial')">
                                Imagén
                                @if ($sort == 'nomrazonsocial')
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
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                                Estado
                            </th>
                            <th scope="col"
                                class="w-24 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($ncboletasdisenos as $ncboletasdiseno)
                            <tr>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $ncboletasdiseno->id }}
                                </td>




                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $ncboletasdiseno->name }}

                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $ncboletasdiseno->nameblade }}
                                </td>


                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                    @if ($ncboletasdiseno->image1)
                                        <img src="{{ Storage::disk('s3_public')->url($ncboletasdiseno->image1) }}"
                                            width="200" alt="">
                                    @else
                                        <span class="text-gray-400">Sin imagen</span>
                                    @endif

                                </td>


                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($ncboletasdiseno->state)
                                        @case(0)
                                            {{-- @canboletasdisenos Update') --}}
                                            <span wire:click="activar({{ $ncboletasdiseno->id }})"
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full cursor-pointer">
                                                inactivo
                                            </span>
                                            {{-- @else
                                                <span
                                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                    inactivo
                                                </span>
                                            @endcan --}}
                                        @break

                                        @case(1)
                                            {{-- @canboletasdisenos Update') --}}
                                            <span wire:click="desactivar({{ $ncboletasdiseno->id }})"
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full cursor-pointer">
                                                activo
                                            </span>
                                            {{-- @else
                                                <span
                                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                    activo
                                                </span>
                                            @endcan --}}
                                        @break

                                        @default
                                    @endswitch

                                </td>


                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">


                                    {{-- @can('Boletadiseno Update') --}}
                                        <a href=" {{ route('admin.ncboletadiseno.edit', $ncboletasdiseno->id) }} "
                                            class="btn btn-green">
                                            <i class="fa-solid fa-pen-to-square"></i></a>
                                   {{--  @endcan

                                    @can('Boletadiseno Delete') --}}
                                        <a class="btn btn-red"
                                            wire:click="$emit('deleteNcboletadiseno', {{ $ncboletasdiseno->id }}) ">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    {{-- @endcan --}}





                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>



                </table>


                @if ($ncboletasdisenos->hasPages())
                    <div class="px-6 py-4">
                        {{ $ncboletasdisenos->links() }}
                    </div>
                @endif
            @endif
        </x-table>
    </div>




    @push('scripts')
        <script src="sweetalert2.all.min.js"></script>

        <script>
            Livewire.on('deleteNcboletadiseno', ncboletasdisenoId => {
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

                        Livewire.emitTo('admin.ncboletadiseno-list', 'delete', ncboletasdisenoId);

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
