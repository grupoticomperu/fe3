<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Modificando Local') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="pb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <p class="mt-4 text-lg font-bold text-center">Editar datos del Local</p>

                <div class="flex flex-wrap mt-4 -mx-4">
                    <div class="w-full px-4 mb-4 md:w-3/4">
                        <x-jet-label value="Nombre del Local" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="local.name" />
                        <x-jet-input-error for="name" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Código Postal" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="local.codigopostal" />
                        <x-jet-input-error for="codigopostal" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/2">
                        <x-jet-label value="Dirección" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="local.address" />
                        <x-jet-input-error for="address" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/2">
                        <x-jet-label value="Email" />
                        <x-jet-input type="email" class="w-full lowercase" wire:model="local.email" />
                        <x-jet-input-error for="email" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Teléfono" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="local.phone" />
                        <x-jet-input-error for="phone" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Celular" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="local.movil" />
                        <x-jet-input-error for="movil" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Anexo" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="local.anexo" />
                        <x-jet-input-error for="anexo" />
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <x-jet-label value="Estado" />
                        <x-jet-input type="checkbox" wire:model="local.state" />
                        <x-jet-input-error for="state" />
                    </div>


                    <div class="w-full px-4 mt-6 mb-4">
                        <x-jet-danger-button wire:click="crearLocal" wire:click="save">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Actualizar Local') }}
                            </x-jet-button>

                            <x-jet-button wire:click="cancel">
                                <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Cancelar') }}
                            </x-jet-button>

                    </div>


                </div>

            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="pb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <p class="mt-4 text-lg font-bold text-center">Agregar Tipo de Comprobante</p>
                <form wire:submit.prevent="agregarcomprobante">
                    <div class="flex flex-wrap mt-4 -mx-4">
                        <div class="w-full px-4 mb-4 md:w-1/4">

                            <x-jet-label value="Tipo Comprobante" />
                            <select class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            wire:model="tipocomprobante_id">
                                <option value="" selected disabled>Tipo Comprobante</option>
                                @foreach ($tipocomprobantes as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach

                            </select>
                            <x-jet-input-error for="tipocomprobante_id" />
                        </div>


                        <div class="w-full px-4 mb-4 md:w-1/4">
                            <x-jet-label value="Serie" />
                            <x-jet-input type="text" class="w-full uppercase" wire:model="serie" />
                            <x-jet-input-error for="serie" />
                        </div>

                        <div class="w-full px-4 mb-4 md:w-1/4">
                            <x-jet-label value="inicio" />
                            <x-jet-input type="text" class="w-full uppercase" wire:model="inicio" />
                            <x-jet-input-error for="inicio" />
                        </div>


                        {{-- <div class="w-full px-4 mt-6 mb-4 md:w-1/4"">
                            <x-jet-danger-button wire:click="agregarcomprobante">
                                <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Agregar Comprobante') }}
                                </x-jet-button>

                        </div> --}}

                        <div class="w-full px-4 mt-6 mb-4 md:w-1/4">
                            <x-jet-danger-button type="submit">
                                <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Agregar') }}
                            </x-jet-button>
                        </div>



                    </div>
                </form>

            </div>
        </div>
    </div>



    <div class="py-3">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <p class="mt-4 text-lg font-bold text-center">Lista de Comprobantes del Local</p>
                @livewire('admin.local-tipocomprobante', ['local' => $local])
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            Livewire.on('recargarPagina', () => {
                window.location.reload();
            });
        </script>
    @endpush


</div>
