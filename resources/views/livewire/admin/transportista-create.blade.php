<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('Creación de un Transportista') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Registra un transportista para usarlo en guías, envíos y comprobantes.
                </p>
            </div>

            <a href="{{ url()->previous() }}"
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
                    <h3 class="text-lg font-semibold text-gray-800">Datos del transportista</h3>
                    <p class="mt-1 text-sm text-gray-500">Completa los campos principales y define su estado.</p>
                </div>

                <div class="flex items-center gap-2 px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-50 rounded-full">
                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                    Formulario activo
                </div>
            </div>

            {{-- Body --}}
            <div class="p-6">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-2 lg:grid-cols-4">

                    {{-- Tipo Documento --}}
                    <div class="lg:col-span-1">
                        <x-jet-label value="Tipo Documento" />
                        <select wire:model="tipodocumento_id"
                            class="w-full h-11 mt-1 border-gray-300 rounded-xl shadow-sm
                                   focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="" selected disabled>Seleccione</option>
                            @foreach ($tipodocumentos as $tipodocumento)
                                <option value="{{ $tipodocumento->id }}">
                                    {{ $tipodocumento->abbreviation }}
                                </option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="tipodocumento_id" class="mt-2" />
                    </div>

                    {{-- Número Documento --}}
                    <div class="lg:col-span-1">
                        <x-jet-label value="Número (RUC, DNI...)" />
                        <x-jet-input wire:model="numdoc" type="text" placeholder="Ej: 20447393302"
                            class="w-full h-11 mt-1 uppercase" />
                        <x-jet-input-error for="numdoc" class="mt-2" />
                    </div>

                    {{-- Razón Social --}}
                    <div class="md:col-span-2 lg:col-span-2">
                        <x-jet-label value="Razón Social / Nombre" />
                        <x-jet-input wire:model.defer="nomrazonsocial" type="text"
                            placeholder="Ej: Transportes Los Andes SAC"
                            class="w-full h-11 mt-1" />
                        <x-jet-input-error for="nomrazonsocial" class="mt-2" />
                    </div>

                    {{-- Dirección --}}
                    <div class="md:col-span-2 lg:col-span-3">
                        <x-jet-label value="Dirección" />
                        <x-jet-input wire:model.defer="address" type="text"
                            placeholder="Ej: Av. Principal 123 - Lima"
                            class="w-full h-11 mt-1" />
                        <x-jet-input-error for="address" class="mt-2" />
                    </div>

                    {{-- Nro MTC --}}
                    <div class="lg:col-span-1">
                        <x-jet-label value="Número MTC" />
                        <x-jet-input wire:model.defer="nromtc" type="text"
                            placeholder="Ej: 1513621CNG"
                            class="w-full h-11 mt-1" />
                        <x-jet-input-error for="nromtc" class="mt-2" />
                    </div>

                    {{-- Predeterminado (toggle) --}}
                    <div class="md:col-span-1 lg:col-span-2">
                        <div class="p-4 border border-gray-200 rounded-2xl bg-gray-50">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Predeterminado</p>
                                    <p class="text-xs text-gray-500">Se seleccionará por defecto en formularios.</p>
                                </div>

                                <button type="button" wire:click="$toggle('predeterminado')"
                                    class="relative inline-flex items-center w-12 h-7 rounded-full transition
                                        {{ $predeterminado ? 'bg-emerald-500' : 'bg-gray-300' }}">
                                    <span class="inline-block w-5 h-5 bg-white rounded-full transform transition
                                        {{ $predeterminado ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                            </div>

                            <div class="mt-2 text-xs font-semibold
                                {{ $predeterminado ? 'text-emerald-700' : 'text-gray-500' }}">
                                {{ $predeterminado ? 'Sí, predeterminado' : 'No, normal' }}
                            </div>

                            <x-jet-input-error for="predeterminado" class="mt-2" />
                        </div>
                    </div>

                    {{-- Estado (toggle) --}}
                    <div class="md:col-span-1 lg:col-span-2">
                        <div class="p-4 border rounded-2xl shadow-sm transition
                            {{ $state ? 'bg-emerald-50 border-emerald-200' : 'bg-rose-50 border-rose-200' }}">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-xl text-lg
                                        {{ $state ? 'bg-emerald-200' : 'bg-rose-200' }}">
                                        {{ $state ? '✅' : '⛔' }}
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold
                                            {{ $state ? 'text-emerald-800' : 'text-rose-800' }}">
                                            {{ $state ? 'Activo' : 'Inactivo' }}
                                        </p>
                                        <p class="mt-1 text-xs
                                            {{ $state ? 'text-emerald-700' : 'text-rose-700' }}">
                                            {{ $state ? 'Disponible para usar en comprobantes.' : 'No se mostrará en listas.' }}
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

                            <x-jet-input-error for="state" class="mt-2" />
                        </div>
                    </div>

                </div>

                {{-- Acciones --}}
                <div class="flex flex-col gap-3 mt-8 sm:flex-row sm:items-center sm:justify-end">
                    <a href="{{ url()->previous() }}"
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
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush
</div>
