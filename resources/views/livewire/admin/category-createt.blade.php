<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Crear Categoria
            </h2>
        </div>
    </x-slot>


    <div
        class="grid grid-cols-1 px-4 mx-auto mt-4 sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

        <div class="px-3 bg-white">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="mb-4">

                        <h3 class="text-center profile-username">Datos del Usuario</h3>

                        <x-table>
                            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">
                                {{-- <h2>Categorias {{ $lastSelectedParentCategory }}</h2> --}}
                                <h2>{{ $breadcrumbs }}</h2>
                            </div>


                            <div class="mb-4">
                                <x-jet-label value="categoria" />

                                {{--  <x-jet-input type="text" class="w-full" wire:model.defer="name" /> --}}
                                {{-- <x-jet-input type="text" class="w-full" wire:model.defer="name" @click.stop /> --}}

                                <x-jet-input type="text" class="w-full" wire:model="name"
                                    @focus="editingCategoryId = true" @blur="editingCategoryId = false" />

                                <x-jet-input-error for="name" />
                            </div>


                            @if (count($categories))
                                <div>
                                    <ul>
                                        @foreach ($categories as $category)
                                            <div x-data="{ open: false }">
                                                <div @click="open = !open">
                                                    <i class="fas fa-plus" x-show="!open"></i>
                                                    <i class="fas fa-minus" x-show="open"></i>

                                                    <input type="radio" name="category_radio"
                                                        id="category_radio_{{ $category->id }}"
                                                        wire:model="selectedParentCategory1" value="{{ $category->id }}"
                                                        onclick="selectOnlyOneRadio({{ $category->id }})">


                                                    {{ $category->name }} {{ $selectedParentCategory1 }}
                                                </div>
                                                <ul x-show="open">
                                                    @foreach ($category->children as $child)
                                                        <livewire:admin.category-item :category="$child"
                                                            :selectedParentCategory="$selectedParentCategory1" :key="$child->id" />
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>

                                <div>


                                </div>
                            @else
                                <div class="px-6 py-4">
                                    No hay ningún registro coincidente
                                </div>
                            @endif






                            {{-- <div class="w-full px-4 mt-6 mb-4">

                                <x-jet-danger-button wire:click="save">
                                    <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Crear Categoria') }}
                                    </x-jet-button>


                                    <x-jet-button wire:click="cancel">
                                        <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Cancelar') }}
                                    </x-jet-button>
                            </div> --}}

                        </x-table>


                    </div>
                </div>
            </div>

        </div>

        <div class="px-3 py-4 bg-white md:col-span-2">
            <p class="text-lg font-bold underline underline-offset-2">categorias</p>
            <div class="mb-4">


                <div class="col-span-2 form-group {{ $errors->has('shortdescription') ? 'text-danger' : '' }} ">
                    <x-jet-label value="Descripción Corta" />
                    <textarea rows="2" wire:model="shortdescription" class="w-full form-control"
                        placeholder="Ingrese Descripción Corta ">{{ old('shortdescription') }}</textarea>
                    {!! $errors->first('shortdescription', '<span class="help-block">:message</span>') !!}


                </div>

                <div class="col-span-2 form-group {{ $errors->has('longdescription') ? 'text-danger' : '' }} ">
                    <x-jet-label value="Descripción Larga" />
                    <textarea rows="4" wire:model="longdescription" class="w-full form-control"
                        placeholder="Ingrese Descripción Larga">{{ old('longdescription') }}</textarea>
                    {!! $errors->first('longdescription', '<span class="help-block">:message</span>') !!}


                </div>

                <div class="mb-1 mr-4">
                    <x-jet-label value="Orden" />
                    <x-jet-input type="number" placeholder="Orden" class="w-1/2 h-10" wire:model="order" />
                    <x-jet-input-error for="order" />
                </div>


                <x-jet-label value="Seleccione una Imagen" class="mt-2" />
                <div class="box-border p-4 mb-4 border-2 rounded-md">
                    {{-- <x-jet-label value="Seleccione una Imagen" class="mb-2" /> --}}

                    {{-- <input type="file" wire:model="brand.image" id="{{ $identificador }}"> --}}
                    <input type="file" wire:model="image" accept="image/*" {{-- id="{{ $identificador }}" --}}>
                    {{-- borramos accept="image/*" --}}
                    <x-jet-input-error for="image" />
                </div>


                <div wire:loading wire:target="image"
                    class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                    <strong class="font-bold">Cargando imagen!</strong>
                    <span class="block sm:inline">Espere un momento.</span>

                </div>

                @if($image)

                    <div class="relative px-4 py-3">
                        <img class="mb-4" width="400px" src="{{ $image->temporaryUrl() }}" alt="cargando imagen">
                    </div>

                @endif

                {{-- @if ($image)
                    <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">
                @elseif($brand->image)
                    <img src="{{ url($brand->image) }}" alt="ticom">
                @endif --}}

                {{-- @if ($image && in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                    <div class="relative px-4 py-3">
                        <img class="mb-4" width="400px" src="{{ $image->temporaryUrl() }}" alt="cargando imagen">
                    </div>
                @elseif($category->image)
                    <div class="relative px-4 py-3">
                        <img src="{{ Storage::disk('s3')->url($category->image) }}" width="200px" alt="TICOM">
                    </div>
                @endif --}}





            </div>



            <div class="w-full px-4 mt-6 mb-4">
                {{-- Botón para crear una nueva categoría --}}
                <x-jet-danger-button wire:click="save">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Crear Categoria') }}
                    </x-jet-button>

                    {{-- Botón para cancelar la creación de una nueva categoría --}}
                    <x-jet-button wire:click="cancel">
                        <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Cancelar') }}
                    </x-jet-button>
            </div>


        </div>

    </div>









</div>

@section('scripts')
    <script>
        function selectOnlyOneRadio(categoryId) {
            var categoryRadios = document.getElementsByName('category_radio');
            for (var i = 0; i < categoryRadios.length; i++) {
                categoryRadios[i].checked = false;
            }
            document.getElementById('category_radio_' + categoryId).checked = true;
        }
    </script>
@endsection
