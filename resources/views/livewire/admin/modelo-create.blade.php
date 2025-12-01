<div>
    <div class="flex items-center justify-center" >
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="$set('open',true)">
           <i class="mx-2 fa-regular fa-file"></i> Nuevo
        </button >

    </div>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear Nuevo Modelo
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Modelo" />
                <x-jet-input type="text" class="w-full" wire:model="name" />
                <x-jet-input-error for="name"/>
            </div>

             <div>
                Estado
                <x-jet-input type="checkbox" wire:model="state" />
                <x-jet-input-error for="state"/>
            </div>


        </x-slot>

        <x-slot name="footer">

            <x-jet-button wire:click="$set('open', false)"  class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>





</div>
