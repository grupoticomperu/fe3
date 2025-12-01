<div>
    <div class="flex items-center justify-center">
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="$set('open',true)">
            <i class="mx-2 fa-regular fa-file"></i> Nuevo
        </button>

    </div>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear Nuevo Envio
        </x-slot>

        <x-slot name="content">


            <div class="py-2 mb-1 mr-4">
                <x-jet-label value="Local a donde se enviará la mercadería" />
                <select wire:model="local_recibe_id"
                    class="h-8 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    data-placeholder="Selecccione el Local" style="height:70%; width:100%">
                    <option value="" selected disabled>Seleccione</option>
                    @foreach ($locales as $local)
                        <option value="{{ $local->id }}">{{ $local->address }}
                        </option>
                    @endforeach

                </select>
                <x-jet-input-error for="local_recibe_id" />
            </div>


            <div class="py-2 mb-1 mr-4">
                <x-jet-label value="Usuario que recibirá o solicitó la mercadería" />
                <select wire:model="user_recibe_id"
                    class="h-8 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    data-placeholder="Selecccione el usuario que recibira" style="height:70%; width:100%">
                    <option value="" selected disabled>Seleccione</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->user->id }}">{{ $employee->user->name }}
                        </option>
                    @endforeach

                </select>
                <x-jet-input-error for="user_recibe_id" />
            </div>




            <div class="mb-4">
                <x-jet-label value="Nombre del envio:" />
                <x-jet-input type="text" class="w-full" wire:model="name" />
                <x-jet-input-error for="name" />
            </div>



        </x-slot>

        <x-slot name="footer">

            <x-jet-button wire:click="$set('open', false)" class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="saveok" wire:loading.attr="disabled" wire:target="save"
                    class="disabled:opacity-25">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
                </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>





</div>
