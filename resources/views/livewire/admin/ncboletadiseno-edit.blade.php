<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('Edición de Diseño de Nota de Crédito Boleta') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Actualiza la plantilla, imágenes y estado del diseño.
                </p>
            </div>

            <a href="{{ route('admin.boletadiseno.list') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
            {{-- Header Card --}}
            <div class="flex items-start justify-between px-6 py-5 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Editar diseño</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Si no subes nuevas imágenes, se mantendrán las actuales.
                    </p>
                </div>

                <div
                    class="flex items-center gap-2 px-3 py-1 text-xs font-semibold text-indigo-700 bg-indigo-50 rounded-full">
                    <span class="w-2 h-2 bg-indigo-600 rounded-full"></span>
                    Modo edición
                </div>
            </div>

            {{-- Body --}}
            <div class="p-6">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4">
                    {{-- Nombre --}}
                    <div class="lg:col-span-1">
                        <x-jet-label value="Nombre" />
                        <x-jet-input wire:model="name" type="text" placeholder="Nombre del diseño"
                            class="w-full h-10 mt-1 uppercase" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    {{-- Nameblade --}}
                    <div class="md:col-span-2 lg:col-span-2">
                        <x-jet-label value="Nombre del Blade" />
                        <x-jet-input wire:model.defer="nameblade" type="text"
                            placeholder="Ej: admin.comprobante.boleta_template" class="w-full h-10 mt-1" />
                        <x-jet-input-error for="nameblade" class="mt-2" />
                    </div>

                    {{-- Estado (toggle) --}}
                    {{-- <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl bg-gray-50">
                        <div>
                            <p class="text-sm font-semibold text-gray-700">Estado</p>
                            <p class="text-xs text-gray-500">Activa/desactiva el diseño.</p>
                        </div>

                        <button type="button" wire:click="$toggle('state')"
                            class="relative inline-flex items-center w-11 h-6 rounded-full transition
                   {{ $state ? 'bg-green-500' : 'bg-gray-300' }}">
                            <span
                                class="inline-block w-4 h-4 bg-white rounded-full transform transition
                     {{ $state ? 'translate-x-6' : 'translate-x-1' }}"></span>
                        </button>
                        <p class="mt-2 text-xs text-gray-500">Valor actual: {{ $state ? 'Activo' : 'Inactivo' }}</p>
                    </div> --}}



                    <div
                        class="p-4 rounded-2xl border shadow-sm transition
                    {{ $state ? 'bg-emerald-50 border-emerald-200' : 'bg-rose-50 border-rose-200' }}">

                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex items-center justify-center w-10 h-10 rounded-xl text-lg
                {{ $state ? 'bg-emerald-200' : 'bg-rose-200' }}">
                                    {{ $state ? '✅' : '⛔' }}
                                </div>

                                <div>
                                    <p
                                        class="text-sm font-semibold
                    {{ $state ? 'text-emerald-800' : 'text-rose-800' }}">
                                        {{ $state ? 'Diseño ACTIVADO' : 'Diseño DESACTIVADO' }}
                                    </p>

                                    <p
                                        class="mt-1 text-xs
                    {{ $state ? 'text-emerald-700' : 'text-rose-700' }}">
                                        {{ $state ? 'Se podrá usar y mostrar en el sistema.' : 'No se mostrará ni se podrá seleccionar.' }}
                                    </p>
                                </div>
                            </div>

                            <button type="button" wire:click="$toggle('state')"
                                class="px-4 py-2 text-sm font-semibold rounded-xl transition shadow-sm
                {{ $state
                    ? 'bg-white text-emerald-800 border border-emerald-200 hover:bg-emerald-100'
                    : 'bg-white text-rose-800 border border-rose-200 hover:bg-rose-100' }}">
                                {{ $state ? 'Desactivar' : 'Activar' }}
                            </button>
                        </div>
                    </div>



                    {{-- <div class="flex items-center gap-3">
                        <input type="checkbox" wire:model="state" class="h-5 w-5">
                        <span class="text-sm text-gray-700">Activo</span>
                    </div>

                    <p class="text-xs text-gray-500 mt-2">Valor actual: {{ $state ? '1' : '0' }}</p> --}}

                    {{-- Imagen 1 --}}
                    <div class="md:col-span-2 lg:col-span-2">
                        <x-jet-label value="Imagen 1 (principal)" />

                        <label
                            class="mt-1 flex items-center justify-between w-full px-4 py-3 border border-dashed border-gray-300 rounded-xl bg-white hover:bg-gray-50 cursor-pointer">
                            <span class="text-sm text-gray-600">
                                Selecciona una imagen (JPG/PNG)
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-lg">
                                Cambiar
                            </span>
                            <input type="file" wire:model.defer="image1" accept="image/jpeg,image/png"
                                class="hidden">
                        </label>
                        <x-jet-input-error for="image1" class="mt-2" />

                        {{-- Preview: nueva o actual --}}
                        <div class="mt-3 p-3 border border-gray-200 rounded-xl bg-gray-50">
                            <p class="text-xs font-semibold text-gray-600 mb-2">Vista previa:</p>

                            @if ($image1)
                                <img src="{{ $image1->temporaryUrl() }}"
                                    class="object-contain w-full max-h-44 rounded-lg" alt="Preview imagen 1">
                            @elseif($image1back)
                                <img src="{{ Storage::disk('s3_public')->url($image1back) }}"
                                    class="object-contain w-full max-h-44 rounded-lg" alt="Imagen 1 actual">
                            @else
                                <div class="text-sm text-gray-400">Sin imagen registrada</div>
                            @endif
                        </div>
                    </div>

                    {{-- Imagen 2 --}}
                    <div class="md:col-span-2 lg:col-span-2">
                        <x-jet-label value="Imagen 2 (opcional)" />

                        <label
                            class="mt-1 flex items-center justify-between w-full px-4 py-3 border border-dashed border-gray-300 rounded-xl bg-white hover:bg-gray-50 cursor-pointer">
                            <span class="text-sm text-gray-600">
                                Selecciona una imagen (JPG/PNG)
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-lg">
                                Cambiar
                            </span>
                            <input type="file" wire:model.defer="image2" accept="image/jpeg,image/png"
                                class="hidden">
                        </label>
                        <x-jet-input-error for="image2" class="mt-2" />

                        {{-- Preview: nueva o actual --}}
                        <div class="mt-3 p-3 border border-gray-200 rounded-xl bg-gray-50">
                            <p class="text-xs font-semibold text-gray-600 mb-2">Vista previa:</p>

                            @if ($image2)
                                <img src="{{ $image2->temporaryUrl() }}"
                                    class="object-contain w-full max-h-44 rounded-lg" alt="Preview imagen 2">
                            @elseif($image2back)
                                <img src="{{ Storage::disk('s3_public')->url($image2back) }}"
                                    class="object-contain w-full max-h-44 rounded-lg" alt="Imagen 2 actual">
                            @else
                                <div class="text-sm text-gray-400">Sin imagen registrada</div>
                            @endif
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="md:col-span-2 lg:col-span-2">
                        <x-jet-label value="Descripción" />
                        <textarea wire:model.defer="description"
                            class="w-full mt-1 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            rows="3" placeholder="Describe el diseño..."></textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    {{-- Orden --}}
                    <div class="lg:col-span-2">
                        <x-jet-label value="Orden" />
                        <x-jet-input wire:model.defer="order" type="number" placeholder="Ej: 1"
                            class="w-full h-10 mt-1" />
                        <x-jet-input-error for="order" class="mt-2" />
                        <p class="mt-2 text-xs text-gray-500">Se usa para ordenar la lista de diseños.</p>
                    </div>
                </div>

                {{-- Loader de imágenes --}}
                <div wire:loading wire:target="image1,image2"
                    class="mt-5 p-4 border border-yellow-200 bg-yellow-50 rounded-xl text-yellow-800">
                    <strong class="font-semibold">Cargando imágenes...</strong>
                    <span class="block text-sm">Por favor espera un momento.</span>
                </div>

                {{-- Acciones --}}
                <div class="flex flex-col gap-3 mt-6 sm:flex-row sm:items-center sm:justify-end">
                    <a href="{{ route('admin.ncboletadiseno.list') }}"
                        class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">
                        Cancelar
                    </a>

                    <button wire:click="update" wire:loading.attr="disabled" wire:target="update"
                        class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 disabled:opacity-25">
                        <span wire:loading.remove wire:target="update">
                            <i class="mr-2 fa-regular fa-floppy-disk"></i> Actualizar
                        </span>
                        <span wire:loading wire:target="update">
                            Actualizando...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

   
</div>

