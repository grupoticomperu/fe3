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

            {{-- @if($this->withcategory[0]) --}}

            <div class="py-2 mb-1">
                <label>Categorias </label>
                <select wire:model="category_id" class="py-0.5 rounded" style="height:50%; width:100%">
                    <option value="" selected disabled>escoge tu categoria</option>
                    @foreach($categories as $id=>$category)
                       {{--  @if ($id == 1)
                             @continue
                        @endif --}}
                        <option value="{{$id}}">{{$category}}</option>
                    @endforeach

                </select>
                <x-jet-input-error for="category_id" />
            </div>
            {{-- {{ $category_id }} --}}
            {{-- @endif --}}





            <div class="py-2 mb-1" >

                <label>Sub Categorias </label>
                <select wire:model="subcategory_id" class="py-0.5 rounded" style="height:50%; width:100%" >
                    <option value="" selected disabled>escoge tu subcategoria</option>
                    @foreach($subcategories as $subcategory)
                      <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                    @endforeach

                </select>
                <x-jet-input-error for="subcategory_id" />
            </div>

            {{-- <input type="text" wire:model="subcategory_id">
            {{ $subcategory_id }} --}}


{{--                 <div class="py-2 mb-1" wire:ignore>
                    <label>Marcas</label>
                    <select wire:model="brand_id" class="py-2 select2mar"  style="height:50%; width:100%">
                         <option value="" selected disabled>Seleccione</option>
                        @foreach($brands as $id=>$brand)
                        <option value="{{$id}}">{{$brand}}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="brand_id" />
                </div> --}}


                <div class="py-2 mb-1">
                    <label>Marcas</label>
                    <select wire:model="brand_id" class="py-0.5 rounded" style="height:50%; width:100%">
                         <option value="" selected disabled>Seleccione</option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="brand_id" />
                </div>

                {{-- {{ $brand_id }} --}}

                <div class="py-2 mb-1">
                    <label>Modelos</label>
                    <select wire:model="modelo_id" class="py-0.5 rounded "  style="height:50%; width:100%">
                         <option value="" selected disabled>Seleccione</option>
                        @foreach($modelos as $id=>$modelo)
                        <option value="{{$id}}">{{$modelo}}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="modelo_id" />
                </div>


                {{-- {{ $modelo_id }} --}}


                <div class="py-2 mb-1">
                    <label>Producto </label>
                    <select wire:model="prod_servicio" class="py-0.5 rounded " style="height:50%; width:100%">
                        <option value="" selected disabled >Seleccione</option>

                        <option value="1">producto terminado</option>
                        <option value="2">Mercaderia</option>
                       {{--  <option value="3">Servicio</option> --}}

                    </select>
                    <x-jet-input-error for="prod_servicio" />
                </div>


            {{-- {{ $prod_servicio }} --}}




           {{-- <div class="py-2 mb-2">
                    <label>Producto simple o compuesto</label>
                    <select wire:model="simplecompound" class="py-0.5 rounded" data-placeholder="Seleccione" style="height:50%; width:100%">
                        <option value="" selected disabled>Seleccione</option>
                        <option value="1">producto simple</option>
                        <option value="2">producto con combinacines</option>


                    </select>
                    <x-jet-input-error for="categories" />
                </div> --}}

                {{-- {{ $simplecompound }} --}}

                <div class="py-2 mb-2">
                    <label>Genero</label>
                    <select wire:model="gender" class="py-0.5 rounded " style="height:50%; width:100%">
                        <option value="" selected disabled>Seleccione</option>

                        <option value="1">Varon</option>
                        <option value="2">Mujer</option>
                        <option value="3">Unisex</option>

                    </select>
                    <x-jet-input-error for="categories" />
                </div>

               {{--  {{ $gender}} --}}

                <div class="flex items-center justify-center px-2 mt-2 mr-4 md:mt-0">

                    <x-jet-input type="checkbox" wire:model="haveserialnumber" class="mx-1" />
                    Tiene numero de Serie
                </div>
                {{-- {{ $haveserialnumber}} --}}


        </x-slot>

        <x-slot name="footer">

            <x-jet-button wire:click="cancel"  class="mr-2">
                <i class="mx-2 fa-sharp fa-solid fa-xmark"></i>Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                <i class="mx-2 fa-regular fa-floppy-disk"></i> Guardar
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
        $('.select2mo').select2({
           tags:true
       });
        $('.select2mo').on('change', function(){
            @this.set('modelo_id', this.value);
        });
    })
</script>


<script>

    document.addEventListener('livewire:load',function(){
        $('.select2mar').select2({
           tags:true
       });
        $('.select2mar').on('change', function(){
            @this.set('brand_id', this.value);
        });
    })
</script>



@endpush
