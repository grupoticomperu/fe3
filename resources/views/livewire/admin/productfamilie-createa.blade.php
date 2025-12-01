<div>
    <div class="flex items-center justify-center" >
        <button class="items-center justify-center sm:flex btn btn-orange" wire:click="nuevo">
           <i class="mx-2 fa-regular fa-file"></i> Nuevo
        </button >

    </div>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear Nuevo Producto
        </x-slot>


        <x-slot name="content">

            <div class="py-2 mb-1" wire:ignore>
                <label>Categorias </label>
                <select wire:model="category_id" class="select2"  data-placeholder="Seleccione una Categoria" style="height:50%; width:100%">
                    <option value="" selected disabled>Seleccione</option>
                    @foreach($categories as $category)
                        @if ($category->id == 1)
                          @continue
                        @endif
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach

                </select>
                <x-jet-input-error for="category_id" />
            </div>






        </x-slot>

        <x-slot name="footer">

            <x-jet-button wire:click="cancel"  class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Continuar
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>

</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        document.addEventListener('livewire:load',function(){
            $('.select2').select2({
            tags:true
        });
            $('.select2').on('change', function(){
                @this.set('category_id', this.value);
            });
        })


    </script>
@endpush
