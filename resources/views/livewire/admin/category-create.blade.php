<div>
    <div class="flex items-center justify-center" >
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="nuevo">
           <i class="mx-2 fa-regular fa-file"></i> Nueva
        </button >

    </div>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear Nueva Categoria
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Categoria" />
                <x-jet-input type="text" class="w-full" wire:model="name" />
                <x-jet-input-error for="name"/>
            </div>

            <div class="flex row">
                <div class="mb-4 mr-4">
                    <x-jet-label value="Estado" />
                    <x-jet-input type="checkbox" wire:model="state" />
                    <x-jet-input-error for="state"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Orden" />
                    <x-jet-input type="number" class="w-full" wire:model="order" />
                    <x-jet-input-error for="order"/>
                </div>
            </div>


            <div class="mb-4">
                <x-jet-label value="Descripción Corta" />
                <x-jet-input type="text" class="w-full" wire:model="shortdescription" />
                <x-jet-input-error for="shortdescription"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Descripción Larga" />
                <x-jet-input type="text" class="w-full" wire:model="longdescription" />
                <x-jet-input-error for="longdescription"/>
            </div>



            <div class="mb-4">
                <x-jet-label value="Titulo Google" />
                <x-jet-input type="text" class="w-full" wire:model="title" />
                <x-jet-input-error for="title"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Descripción Google" />
                <x-jet-input type="text" class="w-full" wire:model="description" />
                <x-jet-input-error for="description"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Keywords Google" />
                <x-jet-input type="text" class="w-full" wire:model="keywords" />
                <x-jet-input-error for="keywords"/>
            </div>

            <div class="mb-4">
                <input type="file" wire:model="image" id="{{$identificador}}">
                <x-jet-input-error for="image"/>
                <p class="text-red-400">tamaño 300px ancho por 200px alto</p>
            </div>

            <div wire:loading wire:target="image" class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                <strong class="font-bold">Cargando imagenn!</strong>
                <span class="block sm:inline">Espero un momento.</span>

            </div>



            @if($image)
                <img class="mb-4" src="{{$image->temporaryUrl()}}" alt="">
            @endif


        </x-slot>

        <x-slot name="footer">

            <x-jet-button wire:click="$set('open', false)"  class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
            </x-jet-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>





</div>

