<x-table>



    @if($local)


        <table class="min-w-full mt-8 divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>

                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                        Comprobante
                    </th>


                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                        Serie
                    </th>

                    <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                        Numero


                    </th>

                   <th scope="col"
                        class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                        ACCIONES
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">



                 @foreach ($local->tipocomprobantes as $tipocomprobante)
                    <tr>

                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                            {{ $tipocomprobante->name }}
                        </td>


                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                            {{ $tipocomprobante->pivot->serie }}
                        </td>



                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                            {{ $tipocomprobante->pivot->inicio }}
                        </td>






                        {{-- <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap"> --}}

                            {{-- @can('Local Delete') --}}
                                {{-- <a class="btn btn-red"  wire:click="$emit('deletipocomprobante', {{ $tipocomprobante->id }})">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a> --}}
                           {{--  @endcan --}}
                        {{-- </td> --}}


                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                            <a class="btn btn-red"
                           {{--  wire:click="deletipocomprobante({{ $tipocomprobante->id }})" --}}
                            wire:click="$emit('deleteTc', {{ $tipocomprobante->id }})" >
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>




                    </tr>
                 @endforeach

            </tbody>
        </table>


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
                    <svg class="w-10 h-10 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        fill="blue">
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


    @push('scripts')
    <script src="sweetalert2.all.min.js"></script>

    <script>
        Livewire.on('deleteTc', tipocomprobanteId => {
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

                    Livewire.emitTo('admin.local-edit', 'deleteTipocomprobante', tipocomprobanteId);

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


</x-table>
