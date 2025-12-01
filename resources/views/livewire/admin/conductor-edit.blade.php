<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edición de Conductor') }}
        </h2>
    </x-slot>

    <div class="grid px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8">
        <div class="px-3 bg-white">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div>
                        <div class="grid gap-4 p-4 mt-4 mb-4 ml-1 bg-blue-100 border border-gray-400 lg:grid-cols-4">

                            <!-- Tipo Documento -->
                           
                            <div>
                                <x-jet-label value="Tipo Documento" />
                                <select wire:model="tipodocumento_id"
                                    class="w-full h-10 border-gray-300 rounded-md shadow-sm">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($tipodocumentos as $td)
                                        <option value="{{ $td->id }}">{{ $td->abbreviation }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="tipodocumento_id" />
                            </div>




                            <!-- Número de Documento -->
                            <div>
                                <x-jet-label value="Número (RUC, DNI...)" />
                                <x-jet-input wire:model="numdoc" type="text" placeholder="Número de documento"
                                    class="w-full h-10 uppercase" />
                                <x-jet-input-error for="numdoc" />
                            </div>

                            <!-- Razón Social -->
                            <div class="col-span-2">
                                <x-jet-label value="Nombres y Apellidos" />
                                <x-jet-input wire:model.defer="nomape" type="text" placeholder="Nombres y Apellidos"
                                    class="w-full h-10" />
                                <x-jet-input-error for="nomape" />
                            </div>

                            <!-- Licencia -->
                            <div class="col-span-3">
                                <x-jet-label value="licencia" />
                                <x-jet-input wire:model.defer="licencia" type="text" placeholder="licencia"
                                    class="w-full h-10" />
                                <x-jet-input-error for="licencia" />
                            </div>

                            <!-- celular -->
                            <div>
                                <x-jet-label value="Celular" />
                                <x-jet-input wire:model.defer="celular" type="text" placeholder="Celular"
                                    class="w-full h-10" />
                                <x-jet-input-error for="celular" />
                            </div>



                            <!-- Estado -->
                            <div>
                                <x-jet-label value="Estado" />
                                <input type="checkbox" wire:model="state"
                                    class="h-5 w-5 text-indigo-600 border-gray-300 rounded">
                                <x-jet-input-error for="state" />
                            </div>

                        </div>

                        <!-- Botón Guardar -->
                         <x-jet-button wire:click="update"
                            wire:loading.attr="disabled"
                            wire:target="update"
                            class="w-full mt-4 mb-3 disabled:opacity-25">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar
                        </x-jet-button>

                    </div>

                </div>
            </div>
        </div>
    </div>

   {{--  @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush --}}

</div>
