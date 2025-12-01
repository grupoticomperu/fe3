<div>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Lista de Marcas
            </h2>
        </div

    </x-slot>

        <div class="container py-12 mx-auto border-gray-400 max-w-7xl sm:px-6 lg:px-8">

            <x-table>

                <div class="items-center px-6 py-4 bg-gray-200 sm:flex">


                    <div class="py-2 mb-1" wire:ignore>

                        <label>{{ $category_id }}Sub Categorias </label>
                        <select wire:model="subcategory_id" class="py-2 select21" data-placeholder="Selecccione una subcategoria" style="height:50%; width:100%" > {{-- select21 --}}
                            <option value="" selected disabled>escoge tu subcategoria</option>
                            @foreach($subcategories as $subcategory)
                              <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                            @endforeach

                        </select>
                        <x-jet-input-error for="subcategory_id" />
                    </div>

                    {{ $subcategory_id }}


                    <div class="py-2 mb-1" wire:ignore>
                        <label>Marcas</label>
                        <select wire:model="brand_id" class="py-2 select2ma"  style="height:50%; width:100%">
                             <option value="" selected disabled>Seleccione</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach

                        </select>
                        <x-jet-input-error for="categories" />
                    </div>


                    {{ $brand_id }}

                    <div class="py-2 mb-1"  wire:ignore>
                        <label>Modelos</label>
                        <select wire:model="modelo_id" class="py-2 select2m"  style="height:50%; width:100%">
                             <option value="" selected disabled>Seleccione</option>
                            @foreach($modelos as $modelo)
                            <option value="{{$modelo->id}}">{{$modelo->name}}</option>
                            @endforeach

                        </select>
                        <x-jet-input-error for="categories" />
                    </div>


                    {{ $modelo_id }}


                    <div class="py-2 mb-1">
                        <label>Producto </label>
                        <select wire:model="prod_servicio" class="py-0.5 rounded " data-placeholder="Selecccione" style="height:50%; width:100%">
                            <option value="" selected disabled >Seleccione</option>

                            <option value="1">producto terminado</option>
                            <option value="2">Mercaderia</option>
                           {{--  <option value="3">Servicio</option> --}}

                        </select>
                        <x-jet-input-error for="prod_servicio" />
                    </div>


                {{ $prod_servicio }}


                <div class="py-2 mb-2">
                    <label>Genero</label>
                    <select wire:model="gender" class="py-0.5 rounded " data-placeholder="Seleccione" style="height:50%; width:100%">
                        <option value="" selected disabled>Seleccione</option>

                        <option value="1">Varon</option>
                        <option value="2">Mujer</option>
                        <option value="3">Unisex</option>

                    </select>
                    <x-jet-input-error for="categories" />
                </div>

                {{ $gender}}




                <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                    <x-jet-input type="checkbox" wire:model="haveserialnumber" class="mx-1" />
                    Tiene numero de Serie
                </div>
                {{ $haveserialnumber}}




                <x-jet-secondary-button wire:click="cancel"  class="mr-2">
                    <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
                </x-jet-danger-button>





                </div>
            </x-table>


        </div>

    <x-slot name="footer">

            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Pie
            </h2>


    </x-slot>


</div>
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('livewire:load',function(){
    $('.select21').select2({
       tags:true
    });
    $('.select21').on('change', function(){
        @this.set('subcategory_id', this.value);
    });
})



document.addEventListener('livewire:load',function(){
    $('.select2m').select2({
       tags:true
   });
    $('.select2m').on('change', function(){
        @this.set('modelo_id', this.value);
    });
})


document.addEventListener('livewire:load',function(){
    $('.select2ma').select2({
       tags:true
   });
    $('.select2ma').on('change', function(){
        @this.set('brand_id', this.value);
    });
})


</script>





@endpush
