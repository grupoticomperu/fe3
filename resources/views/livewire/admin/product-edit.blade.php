{{-- <div>
    <p>Editar producto</p>

    {{ $productId }}
</div> --}}
<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-600">
                Editar Producto {{ $productId }}
            </h2>
        </div>
    </x-slot>


    <div
        class="grid grid-cols-1 px-4 mx-auto mt-4 sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

        <div class="px-3 bg-white">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="mb-4">

                        <h3 class="text-center profile-username">Escoja la Categoria {{-- {{ $lastSelectedParentCategory }} --}}
                        </h3>

                        <x-table>
                            <div class="items-center px-6 py-4 bg-gray-200 sm:flex">
                                <h2>{{ $breadcrumbs }}</h2>
                            </div>


                            {{-- <div class="mb-4">
                                <x-jet-label value="categoria" />

                                <x-jet-input type="text" class="w-full" wire:model="name"
                                    @focus="editingCategoryId = true" @blur="editingCategoryId = false" />

                                <x-jet-input-error for="name" />
                            </div> --}}


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


                                                    {{ $category->name }} {{-- {{ $selectedParentCategory1 }} --}}
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


                        </x-table>

                        <x-jet-input-error for="category_id" />
                    </div>
                </div>
            </div>

        </div>

        <div class="px-3 py-4 bg-white md:col-span-2">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5">

                {{-- <div class="sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="RUC" />
                        <x-jet-input type="text" wire:model="ruc" class="w-full h-10 max-w-md uppercase" />
                        <x-jet-input-error for="ruc" />
                    </div>
                </div> --}}

                <div class="gap-0 sm:col-span-1 lg:col-span-3">
                    <div class="mr-1">
                        <x-jet-label value="Nombre del producto" />
                        <x-jet-input type="text" wire:model="name" class="w-full h-10 " />
                        <x-jet-input-error for="name" />
                    </div>
                </div>

                <div class="sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="Código" />
                        <x-jet-input type="text" wire:model="codigo" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="codigo" />
                    </div>
                </div>

                <div class="sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="Códigobarras" />
                        <x-jet-input type="text" wire:model="codigobarras" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="codigobarras" />
                    </div>
                </div>


            </div>


            <div>
                <div class="col-span-2 form-group {{ $errors->has('description') ? 'text-danger' : '' }} ">
                    <x-jet-label value="Descripción" />
                    <textarea rows="2" wire:model="description" class="w-full form-control" placeholder="Ingrese Descripción">{{ old('description') }}</textarea>
                    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                </div>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6">

                <div class="mb-1 mr-4">
                    <x-jet-label value="Moneda" />
                    <select wire:model="currency_id"
                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        data-placeholder="Selecccione la moneda" style="width:100%">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}">{{ $currency->abbreviation }}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="currency_id" />
                </div>



                <div class="sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="precio Compra" />
                        <x-jet-input type="number" wire:model="purchaseprice" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="purchaseprice" />
                    </div>
                </div>

                <div class="gap-0 sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="Precio Venta" />
                        <x-jet-input type="number" wire:model="saleprice" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="saleprice" />
                    </div>
                </div>

                <div class="sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="Precio de Venta Min" />
                        <x-jet-input type="number" wire:model="salepricemin" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="salepricemin" />
                    </div>
                </div>

                <div class="sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="Valor Gratuito" />
                        <x-jet-input type="number" wire:model="mtovalorgratuito" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="mtovalorgratuito" />
                    </div>
                </div>
                <div class="sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="Valor Unitario (sin IGV)" />
                        <x-jet-input type="number" wire:model="mtovalorunitario" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="mtovalorunitario" />
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6">

                <div class="mb-1 mr-4">
                    <x-jet-label value="Unidad de Medida" />
                    <select wire:model="um_id"
                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        data-placeholder="Selecccione um" style="width:100%">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($ums as $um)
                            <option value="{{ $um->id }}">{{ $um->name }}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="um_id" />
                </div>


                <div class="mb-1 mr-4">
                    <x-jet-label value="Modelo" />
                    <select wire:model="modelo_id"
                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        data-placeholder="Selecccione un modelo" style="width:100%">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($modelos as $modelo)
                            <option value="{{ $modelo->id }}">{{ $modelo->name }}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="modelo_id" />
                </div>

                <div class="mb-1 mr-4">
                    <x-jet-label value="Marca" />
                    <select wire:model="brand_id"
                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        data-placeholder="Selecccione un modelo" style="width:100%">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="brand_id" />
                </div>

                <div class="mb-1 mr-4">
                    <x-jet-label value="Tipo Afectacion IGV" />
                    <select wire:model="tipoafectacion_id"
                        class="h-10 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        data-placeholder="Selecccione Tipo afectacion del IGV" style="width:100%">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($tipoafectacions as $tipoafectacion)
                            <option value="{{ $tipoafectacion->id }}">{{ $tipoafectacion->name }}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="tipoafectacion_id" />
                </div>


                <div class="sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="Es Bolsa" />
                        <x-jet-input type="text" wire:model="esbolsa" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="esbolsa" />
                    </div>
                </div>

                <div class="gap-0 sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="Detracción" />
                        <x-jet-input type="text" wire:model="detraccion" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="detraccion" />
                    </div>
                </div>

                <div class="sm:col-span-1 lg:col-span-1">
                    <div class="mr-1">
                        <x-jet-label value="Percepción" />
                        <x-jet-input type="text" wire:model="percepcion" class="w-full h-10 max-w-md" />
                        <x-jet-input-error for="percepcion" />
                    </div>
                </div>


                <div class="mb-4 mr-4">
                    <x-jet-label value="Estado" />
                    <x-jet-input type="checkbox" wire:model="state" />
                    <x-jet-input-error for="state" />
                </div>



            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2">

                <div class="mr-2">
                    <x-jet-label value="Seleccione una Imagen para Modificar" class="mt-2" />
                    <div class="box-border p-4 mb-4 border-2 rounded-md">
                        <input type="file" wire:model="image1" accept="image/*">
                        <x-jet-input-error for="image1" />
                    </div>


                    <div wire:loading wire:target="image1"
                        class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded"
                        role="alert">
                        <strong class="font-bold">Cargando imagen!</strong>
                        <span class="block sm:inline">Espere un momento.</span>
                    </div>

                    @if ($image1)
                        <div class="relative px-4 py-3">
                            <img class="mb-4" width="400px" src="{{ $image1->temporaryUrl() }}"
                                alt="cargando imagen">
                        </div>
                    @elseif($image1back)
                        <img src="{{ Storage::disk('s3')->url($image1back) }}" width="200px" alt="">
                    @endif


                </div>

                <div class="mr-2">
                    <x-jet-label value="Seleccione una Imagen para Modificar" class="mt-2" />
                    <div class="box-border p-4 mb-4 border-2 rounded-md">
                        <input type="file" wire:model="image2" accept="image/*">
                        <x-jet-input-error for="image2" />
                    </div>


                    <div wire:loading wire:target="image2"
                        class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded"
                        role="alert">
                        <strong class="font-bold">Cargando imagen!</strong>
                        <span class="block sm:inline">Espere un momento.</span>
                    </div>

                    @if ($image2)
                        <div class="relative px-4 py-3">
                            <img class="mb-4" width="400px" src="{{ $image2->temporaryUrl() }}"
                                alt="cargando imagen">
                        </div>
                    @elseif($image2back)
                        <img src="{{ Storage::disk('s3')->url($image2back) }}" width="200px" alt="">
                    @endif
                </div>

                <div class="mr-2">
                    <x-jet-label value="Seleccione una Imagen para Modificar" class="mt-2" />
                    <div class="box-border p-4 mb-4 border-2 rounded-md">
                        <input type="file" wire:model="image3" accept="image/*">
                        <x-jet-input-error for="image3" />
                    </div>


                    <div wire:loading wire:target="image3"
                        class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded"
                        role="alert">
                        <strong class="font-bold">Cargando imagen!</strong>
                        <span class="block sm:inline">Espere un momento.</span>
                    </div>

                    @if ($image3)
                        <div class="relative px-4 py-3">
                            <img class="mb-4" width="400px" src="{{ $image3->temporaryUrl() }}"
                                alt="cargando imagen">
                        </div>
                    @elseif($image3back)
                        <img src="{{ Storage::disk('s3')->url($image3back) }}" width="200px" alt="">
                    @endif
                </div>

                <div class="mr-2">
                    <x-jet-label value="Seleccione una Imagen para Modificar" class="mt-2" />
                    <div class="box-border p-4 mb-4 border-2 rounded-md">
                        <input type="file" wire:model="image4" accept="image/*">
                        <x-jet-input-error for="image4" />
                    </div>


                    <div wire:loading wire:target="image4"
                        class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded"
                        role="alert">
                        <strong class="font-bold">Cargando imagen!</strong>
                        <span class="block sm:inline">Espere un momento.</span>
                    </div>

                    @if ($image4)
                        <div class="relative px-4 py-3">
                            <img class="mb-4" width="400px" src="{{ $image4->temporaryUrl() }}"
                                alt="cargando imagen">
                        </div>
                    @elseif($image4back)
                        <img src="{{ Storage::disk('s3')->url($image4back) }}" width="200px" alt="">
                    @endif
                </div>





            </div>




            <div class="w-full px-4 mt-6 mb-4">
                {{-- Botón para crear una nueva categoría --}}
                <x-jet-danger-button wire:click="save">
                    <i class="mx-2 fa-regular fa-floppy-disk"></i> {{ __('Guardar Producto') }}
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
