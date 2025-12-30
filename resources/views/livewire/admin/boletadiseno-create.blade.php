<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('Creación de Diseño de Boleta') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Registra una plantilla para boletas (nombre, vista blade e imágenes de diseño).
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
                    <h3 class="text-lg font-semibold text-gray-800">Datos del diseño</h3>
                    <p class="mt-1 text-sm text-gray-500">Completa la información y sube las imágenes (JPG/PNG).</p>
                </div>

                <div
                    class="flex items-center gap-2 px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-50 rounded-full">
                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                    Formulario activo
                </div>
            </div>

            {{-- Body --}}
            <div class="p-6">
                 <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4">
               {{--  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-6"> --}}
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

                    {{-- Estado --}}


                    <div class="lg:col-span-1">
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
                                            {{ $state ? 'El diseño estará disponible para usar.' : 'El diseño se guardará pero no se mostrará.' }}
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

                        <x-jet-input-error for="state" class="mt-2" />
                    </div>



                    {{-- Imagen 1 --}}
                    <div class="md:col-span-2 lg:col-span-2">
                        <x-jet-label value="Imagen 1 (principal)" />
                        <label
                            class="mt-1 flex items-center justify-between w-full px-4 py-3 border border-dashed border-gray-300 rounded-xl bg-white hover:bg-gray-50 cursor-pointer">
                            <span class="text-sm text-gray-600">
                                Selecciona una imagen (JPG/PNG)
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-lg">
                                Examinar
                            </span>
                            <input type="file" wire:model.defer="image1" accept="image/jpeg,image/png"
                                class="hidden">
                        </label>
                        <x-jet-input-error for="image1" class="mt-2" />

                        @if ($image1)
                            <div class="mt-3 p-3 border border-gray-200 rounded-xl bg-gray-50">
                                <p class="text-xs font-semibold text-gray-600 mb-2">Vista previa:</p>
                                <img src="{{ $image1->temporaryUrl() }}"
                                    class="object-contain w-full max-h-44 rounded-lg" alt="Preview imagen 1">
                            </div>
                        @endif
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
                                Examinar
                            </span>
                            <input type="file" wire:model.defer="image2" accept="image/jpeg,image/png"
                                class="hidden">
                        </label>
                        <x-jet-input-error for="image2" class="mt-2" />

                        @if ($image2)
                            <div class="mt-3 p-3 border border-gray-200 rounded-xl bg-gray-50">
                                <p class="text-xs font-semibold text-gray-600 mb-2">Vista previa:</p>
                                <img src="{{ $image2->temporaryUrl() }}"
                                    class="object-contain w-full max-h-44 rounded-lg" alt="Preview imagen 2">
                            </div>
                        @endif
                    </div>

                    {{-- Descripción --}}
                    <div class="md:col-span-2 lg:col-span-2">
                        <x-jet-label value="Descripción" />
                        <textarea wire:model.defer="description"
                            class="w-full mt-1 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            rows="3" placeholder="Describe el uso o detalles del diseño..."></textarea>
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

                {{-- Acciones --}}
                <div class="flex flex-col gap-3 mt-6 sm:flex-row sm:items-center sm:justify-end">
                    <a href="{{ route('admin.boletadiseno.list') }}"
                        class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">
                        Cancelar
                    </a>

                    <button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                        class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 disabled:opacity-25">
                        <span wire:loading.remove wire:target="save">
                            <i class="mr-2 fa-regular fa-floppy-disk"></i> Guardar
                        </span>
                        <span wire:loading wire:target="save">
                            Guardando...
                        </span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Loader simple cuando suben imágenes --}}
        <div wire:loading wire:target="image1,image2"
            class="mt-4 p-4 border border-yellow-200 bg-yellow-50 rounded-xl text-yellow-800">
            <strong class="font-semibold">Cargando imágenes...</strong>
            <span class="block text-sm">Por favor espera un momento.</span>
        </div>
    </div>

    {{-- Si no usas select2 aquí, puedes quitar esto --}}
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush
</div>
