<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('Creación de Conductor') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Registra los datos del conductor que será asignado a los traslados.
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
                    <h3 class="text-lg font-semibold text-gray-800">Datos del conductor</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Completa la información personal y licencia.
                    </p>
                </div>

                <div
                    class="flex items-center gap-2 px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-50 rounded-full">
                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                    Formulario activo
                </div>
            </div>

            {{-- Body --}}
            <div class="p-6">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-2 lg:grid-cols-4">

                    {{-- Tipo Documento --}}
                    <div>
                        <x-jet-label value="Tipo de Documento" />
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
                    <div>
                        <x-jet-label value="Número de Documento" />
                        <x-jet-input wire:model="numdoc" type="text"
                            placeholder="DNI / RUC"
                            class="w-full h-11 mt-1 uppercase" />
                        <x-jet-input-error for="numdoc" class="mt-2" />
                    </div>

                    {{-- Nombres --}}
                    <div class="lg:col-span-2">
                        <x-jet-label value="Nombres y Apellidos" />
                        <x-jet-input wire:model.defer="nomape" type="text"
                            placeholder="Nombre completo del conductor"
                            class="w-full h-11 mt-1" />
                        <x-jet-input-error for="nomape" class="mt-2" />
                    </div>

                    {{-- Licencia --}}
                    <div class="md:col-span-2 lg:col-span-3">
                        <x-jet-label value="Licencia de Conducir" />
                        <x-jet-input wire:model.defer="licencia" type="text"
                            placeholder="Número de licencia"
                            class="w-full h-11 mt-1 uppercase" />
                        <x-jet-input-error for="licencia" class="mt-2" />
                    </div>

                    {{-- Celular --}}
                    <div>
                        <x-jet-label value="Celular" />
                        <x-jet-input wire:model.defer="celular" type="text"
                            placeholder="Ej: 999 999 999"
                            class="w-full h-11 mt-1" />
                        <x-jet-input-error for="celular" class="mt-2" />
                    </div>

                    {{-- Estado --}}
                    <div>
                        <div
                            class="p-4 rounded-2xl border shadow-sm transition
                            {{ $state ? 'bg-emerald-50 border-emerald-200' : 'bg-rose-50 border-rose-200' }}">

                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="flex items-center justify-center w-10 h-10 rounded-xl text-lg
                                        {{ $state ? 'bg-emerald-200' : 'bg-rose-200' }}">
                                        {{ $state ? '🚗' : '⛔' }}
                                    </div>

                                    <div>
                                        <p
                                            class="text-sm font-semibold
                                            {{ $state ? 'text-emerald-800' : 'text-rose-800' }}">
                                            {{ $state ? 'Conductor Activo' : 'Conductor Inactivo' }}
                                        </p>

                                        <p
                                            class="mt-1 text-xs
                                            {{ $state ? 'text-emerald-700' : 'text-rose-700' }}">
                                            {{ $state ? 'Disponible para asignación.' : 'No podrá ser asignado.' }}
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
</div>