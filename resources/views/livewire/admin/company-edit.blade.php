<div>
    <x-slot name="header">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Configuración de Empresa
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Actualiza datos fiscales, dirección, credenciales, certificado, logo y diseños.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{-- Contenedor general --}}
        <div class="space-y-6">

            {{-- ====== CARD: Datos Empresa ====== --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
                <div class="flex items-start justify-between px-6 py-5 border-b border-gray-100">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Datos de tu Empresa</h3>
                        <p class="mt-1 text-sm text-gray-500">Información principal (RUC, razón social y nombre
                            comercial).</p>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-x-8 gap-y-6">
                        <div class="space-y-1 lg:col-span-1">
                            <x-jet-label value="RUC" />
                            <x-jet-input type="text" wire:model.defer="ruc" class="w-full h-10 uppercase" />
                            <x-jet-input-error for="ruc" />
                        </div>

                        <div class="space-y-1 md:col-span-1 lg:col-span-2">
                            <x-jet-label value="Razón Social" />
                            <x-jet-input type="text" wire:model.defer="razonsocial" class="w-full h-10 uppercase" />
                            <x-jet-input-error for="razonsocial" />
                        </div>

                        <div class="space-y-1 md:col-span-2 lg:col-span-2">
                            <x-jet-label value="Nombre Comercial" />
                            <x-jet-input type="text" wire:model.defer="nombrecomercial" class="w-full h-10" />
                            <x-jet-input-error for="nombrecomercial" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== CARD: Dirección ====== --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Dirección</h3>
                    <p class="mt-1 text-sm text-gray-500">Ubicación y ubigeo.</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-6 lg:grid-cols-12 gap-x-8 gap-y-6">
                        <div class="space-y-1 sm:col-span-6 lg:col-span-5">
                            <x-jet-label value="Dirección" />
                            <x-jet-input wire:model.defer="direccion" type="text" placeholder="Dirección"
                                class="w-full h-10" />
                            <x-jet-input-error for="direccion" />
                        </div>

                        <div class="space-y-1 sm:col-span-3 lg:col-span-2">
                            <x-jet-label value="Departamento" />
                            <select wire:model="department_id"
                                class="w-full h-10 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="" selected disabled>Seleccione</option>
                                @foreach ($departments as $department)
                                    <option value="{{ str_pad($department->id, 2, '0', STR_PAD_LEFT) }}">
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="department_id" />
                        </div>

                        <div class="space-y-1 sm:col-span-3 lg:col-span-2">
                            <x-jet-label value="Provincia" />
                            <select wire:model="province_id"
                                class="w-full h-10 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="" selected disabled>Seleccione</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ str_pad($province->id, 4, '0', STR_PAD_LEFT) }}">
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="province_id" />
                        </div>

                        <div class="space-y-1 sm:col-span-3 lg:col-span-2">
                            <x-jet-label value="Distrito" />
                            <select wire:model="district_id"
                                class="w-full h-10 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="" selected disabled>Seleccione</option>
                                @foreach ($districts as $district)
                                    <option value="{{ str_pad($district->id, 6, '0', STR_PAD_LEFT) }}">
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="district_id" />
                        </div>

                        <div class="space-y-1 sm:col-span-3 lg:col-span-1">
                            <x-jet-label value="Ubigeo" />
                            <x-jet-input type="text" wire:model="ubigeo" class="w-full h-10 uppercase" />
                            <x-jet-input-error for="ubigeo" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== GRID 2 COLUMNAS: Credenciales + Moneda/Estado ====== --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Sol y Client --}}
                <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Datos SOL y Client</h3>
                        <p class="mt-1 text-sm text-gray-500">Credenciales SUNAT / OAuth.</p>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="space-y-1">
                                <x-jet-label value="Sol User" />
                                <x-jet-input type="text" wire:model.defer="soluser" class="w-full h-10" />
                                <x-jet-input-error for="soluser" />
                            </div>

                            <div class="space-y-1">
                                <x-jet-label value="Sol Pass" />
                                <x-jet-input type="text" wire:model.defer="solpass" class="w-full h-10" />
                                <x-jet-input-error for="solpass" />
                            </div>

                            <div class="space-y-1">
                                <x-jet-label value="Client ID" />
                                <x-jet-input type="text" wire:model.defer="cliente_id" class="w-full h-10" />
                                <x-jet-input-error for="cliente_id" />
                            </div>

                            <div class="space-y-1">
                                <x-jet-label value="Client Secret" />
                                <x-jet-input type="text" wire:model.defer="cliente_secret" class="w-full h-10" />
                                <x-jet-input-error for="cliente_secret" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Moneda y Estado --}}
                <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Moneda y Estado</h3>
                        <p class="mt-1 text-sm text-gray-500">Modo de emisión y datos de contacto.</p>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="space-y-1">
                                <x-jet-label value="Moneda" />
                                <select wire:model="currency_id"
                                    class="w-full h-10 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="currency_id" />
                            </div>

                            <div class="space-y-1">
                                <x-jet-label value="Estado" />
                                <select wire:model.defer="production"
                                    class="w-full h-10 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" selected disabled>Seleccione</option>
                                    <option value="0">PRUEBA</option>
                                    <option value="1">PRODUCCIÓN</option>
                                </select>
                                <x-jet-input-error for="production" />
                            </div>

                            <div class="space-y-1">
                                <x-jet-label value="Celular" />
                                <x-jet-input type="text" wire:model.defer="celular"
                                    class="w-full h-10 uppercase" />
                                <x-jet-input-error for="celular" />
                            </div>

                            <div class="space-y-1">
                                <x-jet-label value="Teléfono" />
                                <x-jet-input type="text" wire:model.defer="telefono"
                                    class="w-full h-10 uppercase" />
                                <x-jet-input-error for="telefono" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== CARD: Correo y SMTP ====== --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Correo y SMTP</h3>
                    <p class="mt-1 text-sm text-gray-500">Datos para envío de correos.</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-9 gap-x-8 gap-y-6">
                        <div class="space-y-1 lg:col-span-3">
                            <x-jet-label value="Correo" />
                            <x-jet-input type="text" wire:model.defer="correo" class="w-full h-10" />
                            <x-jet-input-error for="correo" />
                        </div>

                        <div class="space-y-1 lg:col-span-3">
                            <x-jet-label value="SMTP" />
                            <x-jet-input type="text" wire:model.defer="smtp" class="w-full h-10" />
                            <x-jet-input-error for="smtp" />
                        </div>

                        <div class="space-y-1 lg:col-span-2">
                            <x-jet-label value="Password" />
                            <x-jet-input type="text" wire:model.defer="password" class="w-full h-10" />
                            <x-jet-input-error for="password" />
                        </div>

                        <div class="space-y-1 lg:col-span-1">
                            <x-jet-label value="Puerto" />
                            <x-jet-input type="text" wire:model.defer="puerto" class="w-full h-10" />
                            <x-jet-input-error for="puerto" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== CARD: Certificado ====== --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Certificado Digital</h3>
                    <p class="mt-1 text-sm text-gray-500">Sube el certificado PEM y registra vigencia.</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="space-y-1">
                            <x-jet-label value="Cargar Certificado Nuevo (PEM)" />
                            <input type="file" wire:model.defer="certificate_path"
                                class="w-full px-3 py-2 border border-gray-300 rounded-xl bg-white">
                            <x-jet-input-error for="certificate_path" />
                            <p class="text-xs text-gray-500">Recomendado: .pem (cert + private key).</p>
                        </div>

                        <div class="space-y-1">
                            @if ($certificate_path)
                                <x-jet-label value="Certificado Nuevo" />
                                <x-jet-input type="text" wire:model.defer="certificate_path"
                                    class="w-full h-10" />
                            @else
                                <x-jet-label value="Certificado Actual" />
                                <x-jet-input type="text" wire:model.defer="certificate_pathback"
                                    class="w-full h-10" />
                            @endif
                        </div>

                        <div class="space-y-1">
                            <x-jet-label value="Fecha de Inicio Certificado" />
                            <x-jet-input type="date" wire:model="fechainiciocertificado"
                                class="w-full h-10 rounded-xl"
                                wire:change="fechaInicioSeleccionada($event.target.value)" />
                            <x-jet-input-error for="fechainiciocertificado" />
                        </div>

                        <div class="space-y-1">
                            <x-jet-label value="Fecha de Fin Certificado" />
                            <x-jet-input type="date" wire:model="fechafincertificado"
                                class="w-full h-10 rounded-xl" />
                            <x-jet-input-error for="fechafincertificado" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== GRID: Logo + Comprobantes ====== --}}
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
                {{-- Logo --}}
                <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Logo</h3>
                        <p class="mt-1 text-sm text-gray-500">Logo visible en formularios y documentos.</p>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="space-y-1">
                                <x-jet-label value="Nuevo Logo de tu Empresa" />
                                <input type="file" wire:model.defer="logo" accept="image/jpeg,image/png"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-xl bg-white">
                                <x-jet-input-error for="logo" />
                            </div>

                            <div
                                class="flex items-center justify-center p-4 border border-gray-200 rounded-xl bg-gray-50">
                                @if ($logo)
                                    <img src="{{ $logo->temporaryUrl() }}" class="max-h-28 object-contain"
                                        alt="Logo preview">
                                @elseif($logoback)
                                    <img src="{{ Storage::disk('s3_public')->url($logoback) }}"
                                        class="max-h-28 object-contain" alt="Logo actual">
                                @else
                                    <p class="text-sm text-gray-400">Sin logo</p>
                                @endif
                            </div>
                        </div>

                        <div wire:loading wire:target="logo"
                            class="mt-4 p-4 text-red-700 bg-red-50 border border-red-200 rounded-xl">
                            <strong class="font-semibold">Cargando imagen...</strong>
                            <span class="block text-sm">Espere un momento.</span>
                        </div>
                    </div>
                </div>

         
            </div>





            {{-- Comprobantes --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Comprobantes</h3>
                    <p class="mt-1 text-sm text-gray-500">Selecciona el diseño para cada documento y revisa su vista
                        previa.</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-8">

                        {{-- BOLETA --}}
                        @php
                            $boletaSel = $boletadisenos->firstWhere('id', $boletadiseno_id);
                        @endphp
                        <div class="p-4 border border-gray-200 rounded-2xl bg-gray-50">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Diseño de Boletas</p>
                                        <p class="text-xs text-gray-500">Se usará para boletas electrónicas.</p>
                                    </div>

                                    @if ($boletaSel)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-indigo-700 bg-indigo-50 rounded-full">
                                            Seleccionado
                                        </span>
                                    @endif
                                </div>

                                <select wire:model="boletadiseno_id"
                                    class="w-full h-11 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($boletadisenos as $boletadiseno)
                                        <option value="{{ $boletadiseno->id }}">{{ $boletadiseno->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="boletadiseno_id" />

                                {{-- Preview --}}
                                <div class="mt-3">
                                    @if ($boletaSel && $boletaSel->image1)
                                        <div class="p-3 bg-white border border-gray-200 rounded-xl">
                                            <p class="mb-2 text-xs font-semibold text-gray-600">Vista previa</p>
                                            <img src="{{ Storage::disk('s3_public')->url($boletaSel->image1) }}"
                                                class="object-contain w-full max-w-full rounded-lg"
                                                alt="Preview Boleta">
                                        </div>
                                    @else
                                        <div
                                            class="p-3 text-sm text-gray-500 bg-white border border-dashed border-gray-300 rounded-xl">
                                            No hay vista previa disponible.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- FACTURA --}}
                        @php
                            $facturaSel = $facturadisenos->firstWhere('id', $facturadiseno_id);
                        @endphp
                        <div class="p-4 border border-gray-200 rounded-2xl bg-gray-50">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Diseño de Facturas</p>
                                        <p class="text-xs text-gray-500">Se usará para facturas electrónicas.</p>
                                    </div>
                                    @if ($facturaSel)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-indigo-700 bg-indigo-50 rounded-full">
                                            Seleccionado
                                        </span>
                                    @endif
                                </div>

                                <select wire:model="facturadiseno_id"
                                    class="w-full h-11 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($facturadisenos as $facturadiseno)
                                        <option value="{{ $facturadiseno->id }}">{{ $facturadiseno->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="facturadiseno_id" />

                                {{-- Preview --}}
                                <div class="mt-3">
                                    @if ($facturaSel && $facturaSel->image1)
                                        <div class="p-3 bg-white border border-gray-200 rounded-xl">
                                            <p class="mb-2 text-xs font-semibold text-gray-600">Vista previa</p>
                                            <img src="{{ Storage::disk('s3_public')->url($facturaSel->image1) }}"
                                                class="object-contain w-full max-h-44 rounded-lg"
                                                alt="Preview Factura">
                                        </div>
                                    @else
                                        <div
                                            class="p-3 text-sm text-gray-500 bg-white border border-dashed border-gray-300 rounded-xl">
                                            No hay vista previa disponible.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- GUÍA --}}
                        @php
                            $guiaSel = $guiadisenos->firstWhere('id', $guiadiseno_id);
                        @endphp
                        <div class="p-4 border border-gray-200 rounded-2xl bg-gray-50">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Diseño de Guías</p>
                                        <p class="text-xs text-gray-500">Se usará para guías de remisión.</p>
                                    </div>
                                    @if ($guiaSel)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-indigo-700 bg-indigo-50 rounded-full">
                                            Seleccionado
                                        </span>
                                    @endif
                                </div>

                                <select wire:model="guiadiseno_id"
                                    class="w-full h-11 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($guiadisenos as $guiadiseno)
                                        <option value="{{ $guiadiseno->id }}">{{ $guiadiseno->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="guiadiseno_id" />

                                {{-- Preview --}}
                                <div class="mt-3">
                                    @if ($guiaSel && $guiaSel->image1)
                                        <div class="p-3 bg-white border border-gray-200 rounded-xl">
                                            <p class="mb-2 text-xs font-semibold text-gray-600">Vista previa</p>
                                            <img src="{{ Storage::disk('s3_public')->url($guiaSel->image1) }}"
                                                class="object-contain w-full max-h-44 rounded-lg" alt="Preview Guía">
                                        </div>
                                    @else
                                        <div
                                            class="p-3 text-sm text-gray-500 bg-white border border-dashed border-gray-300 rounded-xl">
                                            No hay vista previa disponible.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- NC FACTURA --}}
                        @php
                            $ncFacturaSel = $ncfacturadisenos->firstWhere('id', $ncfacturadiseno_id);
                        @endphp
                        <div class="p-4 border border-gray-200 rounded-2xl bg-gray-50">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Diseño de NC Facturas</p>
                                        <p class="text-xs text-gray-500">Diseño para notas de crédito de facturas.</p>
                                    </div>
                                    @if ($ncFacturaSel)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-indigo-700 bg-indigo-50 rounded-full">
                                            Seleccionado
                                        </span>
                                    @endif
                                </div>

                                <select wire:model="ncfacturadiseno_id"
                                    class="w-full h-11 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($ncfacturadisenos as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="ncfacturadiseno_id" />

                                <div class="mt-3">
                                    @if ($ncFacturaSel && $ncFacturaSel->image1)
                                        <div class="p-3 bg-white border border-gray-200 rounded-xl">
                                            <p class="mb-2 text-xs font-semibold text-gray-600">Vista previa</p>
                                            <img src="{{ Storage::disk('s3_public')->url($ncFacturaSel->image1) }}"
                                                class="object-contain w-full max-h-44 rounded-lg"
                                                alt="Preview NC Factura">
                                        </div>
                                    @else
                                        <div
                                            class="p-3 text-sm text-gray-500 bg-white border border-dashed border-gray-300 rounded-xl">
                                            No hay vista previa disponible.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- NC BOLETA --}}
                        @php
                            $ncBoletaSel = $ncboletadisenos->firstWhere('id', $ncboletadiseno_id);
                        @endphp
                        <div class="p-4 border border-gray-200 rounded-2xl bg-gray-50">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Diseño de NC Boletas</p>
                                        <p class="text-xs text-gray-500">Diseño para notas de crédito de boletas.</p>
                                    </div>
                                    @if ($ncBoletaSel)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-indigo-700 bg-indigo-50 rounded-full">
                                            Seleccionado
                                        </span>
                                    @endif
                                </div>

                                <select wire:model="ncboletadiseno_id"
                                    class="w-full h-11 border-gray-300 rounded-xl shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($ncboletadisenos as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="ncboletadiseno_id" />

                                <div class="mt-3">
                                    @if ($ncBoletaSel && $ncBoletaSel->image1)
                                        <div class="p-3 bg-white border border-gray-200 rounded-xl">
                                            <p class="mb-2 text-xs font-semibold text-gray-600">Vista previa</p>
                                            <img src="{{ Storage::disk('s3_public')->url($ncBoletaSel->image1) }}"
                                                class="object-contain w-full max-h-44 rounded-lg"
                                                alt="Preview NC Boleta">
                                        </div>
                                    @else
                                        <div
                                            class="p-3 text-sm text-gray-500 bg-white border border-dashed border-gray-300 rounded-xl">
                                            No hay vista previa disponible.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            {{-- ====== Acciones ====== --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl">
                <div class="flex flex-col gap-3 p-6 sm:flex-row sm:items-center sm:justify-end">
                    <button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 disabled:opacity-25">
                        <span wire:loading.remove wire:target="save">
                            <i class="mr-2 fa-regular fa-floppy-disk"></i> Guardar cambios
                        </span>
                        <span wire:loading wire:target="save">Guardando...</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
