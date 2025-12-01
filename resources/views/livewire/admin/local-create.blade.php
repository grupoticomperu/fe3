<div>
    <div>
        <div class="flex items-center justify-center">
            <button class="items-center justify-center sm:flex btn btn-orange" wire:click="nuevo">
                <i class="mx-2 fa-regular fa-file"></i> Nuevo
            </button>

        </div>

        <x-jet-dialog-modal wire:model="open">
            <x-slot name="title">
                Crear Nuevo Local
            </x-slot>

            $name, $codigopostal, $address, $email, $phone, $movil, $anexo, $serie, $inicia, $company_id, $state

            <x-slot name="content">
                <div class="flex w-full row">
                    <div class="mb-4 mr-2 md:w-3/4">
                        <x-jet-label value="Local" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="name" />
                        <x-jet-input-error for="name" />
                    </div>
                    <div class="mb-4">
                        <x-jet-label value="Código Postal" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="codigopostal" />
                        <x-jet-input-error for="codigopostal" />
                    </div>
                </div>
                <div class="mb-4">
                    <x-jet-label value="Dirección" />
                    <x-jet-input type="text" class="w-full uppercase" wire:model="address" />
                    <x-jet-input-error for="address" />
                </div>

                <div class="mb-4">
                    <x-jet-label value="Email" />
                    <x-jet-input type="text" class="w-full uppercase" wire:model="email" />
                    <x-jet-input-error for="email" />
                </div>
                <div class="flex w-full row">
                    <div class="mb-4 mr-2 md:w-1/2">
                        <x-jet-label value="Teléfono" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="phone" />
                        <x-jet-input-error for="phone" />
                    </div>
                    <div class="mb-4 md:w-1/2">
                        <x-jet-label value="Celular" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="movil" />
                        <x-jet-input-error for="movil" />
                    </div>
                </div>

                <div class="flex row">
                    <div class="mb-4 mr-2">
                        <x-jet-label value="Anexo" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="anexo" />
                        <x-jet-input-error for="anexo" />
                    </div>
                   {{--  <div class="mb-4 mr-2">
                        <x-jet-label value="Serie" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="serie" />
                        <x-jet-input-error for="serie" />
                    </div>
                    <div class="mb-4 mr-2">
                        <x-jet-label value="Inicia" />
                        <x-jet-input type="text" class="w-full uppercase" wire:model="inicia" />
                        <x-jet-input-error for="inicia" />
                    </div> --}}




                    <div class="mb-4 mr-4">
                        <x-jet-label value="Estado" />
                        <x-jet-input type="checkbox" wire:model="state" />
                        <x-jet-input-error for="state" />
                    </div>





                </div>




            </x-slot>

            <x-slot name="footer">

                <x-jet-button wire:click="$set('open', false)" class="mr-2">
                    <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
                </x-jet-button>

                <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                    class="disabled:opacity-25">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
                </x-jet-danger-button>

            </x-slot>

        </x-jet-dialog-modal>





    </div>

</div>
