<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edición de un Vehículo}') }}
        </h2>
    </x-slot>

    <div class="grid px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8">
        <div class="px-3 bg-white">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div>
                        <div class="grid gap-4 p-4 mt-4 mb-4 ml-1 bg-blue-100 border border-gray-400 lg:grid-cols-4">

           
                           
                            <!-- Número de Documento -->
                            <div>
                                <x-jet-label value="Número Placa" />
                                <x-jet-input wire:model="numeroplaca" type="text" placeholder="Número de placa"
                                    class="w-full h-10 uppercase" />
                                <x-jet-input-error for="numeroplaca" />
                            </div>

                            <!-- Razón Social -->
                            <div class="col-span-2">
                                <x-jet-label value="Modelo" />
                                <x-jet-input wire:model.defer="modelo" type="text" placeholder="Modelo"
                                    class="w-full h-10" />
                                <x-jet-input-error for="modelo" />
                            </div>

                            <!-- marca -->
                            <div class="col-span-3">
                                <x-jet-label value="Marca" />
                                <x-jet-input wire:model.defer="marca" type="text" placeholder="Marca"
                                    class="w-full h-10" />
                                <x-jet-input-error for="marca" />
                            </div>

                            <!-- Número MTC -->
                            <div>
                                <x-jet-label value="TUCE" />
                                <x-jet-input wire:model.defer="tuce" type="text" placeholder="TUCE"
                                    class="w-full h-10" />
                                <x-jet-input-error for="tuce" />
                            </div>

                            <!-- Predeterminado -->
                            <div>
                                <x-jet-label value="Predeterminado" />
                                <input type="checkbox" wire:model="predeterminado"
                                    class="h-5 w-5 text-indigo-600 border-gray-300 rounded">
                                <x-jet-input-error for="predeterminado" />
                            </div>

                            <!-- Estado -->
                            <div>
                                <x-jet-label value="Estado" />
                                <input type="checkbox" wire:model="state"
                                    class="h-5 w-5 text-indigo-600 border-gray-300 rounded">
                                <x-jet-input-error for="state" />
                            </div>

                        </div>


                        <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="update"
                            class="w-full mt-4 mb-3 disabled:opacity-25">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar
                        </x-jet-button>



                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush --}}
</div>
