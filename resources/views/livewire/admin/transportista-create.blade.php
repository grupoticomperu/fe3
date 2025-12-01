<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Creación de un Transportista') }}
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
                                    class="w-full h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($tipodocumentos as $tipodocumento)
                                        <option value="{{ $tipodocumento->id }}">{{ $tipodocumento->abbreviation }}</option>
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
                                <x-jet-label value="Razón Social" />
                                <x-jet-input wire:model.defer="nomrazonsocial" type="text"
                                    placeholder="Razón Social / Nombre"
                                    class="w-full h-10" />
                                <x-jet-input-error for="nomrazonsocial" />
                            </div>

                            <!-- Dirección -->
                            <div class="col-span-3">
                                <x-jet-label value="Dirección" />
                                <x-jet-input wire:model.defer="address" type="text" placeholder="Dirección"
                                    class="w-full h-10" />
                                <x-jet-input-error for="address" />
                            </div>

                            <!-- Número MTC -->
                            <div>
                                <x-jet-label value="Número MTC" />
                                <x-jet-input wire:model.defer="nromtc" type="text" placeholder="Nro MTC"
                                    class="w-full h-10" />
                                <x-jet-input-error for="nromtc" />
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

                        <!-- Botón Guardar -->
                        <x-jet-danger-button wire:click="save"
                            wire:loading.attr="disabled"
                            wire:target="save"
                            class="w-full mt-4 mb-3 disabled:opacity-25">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
                        </x-jet-danger-button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush
</div>

