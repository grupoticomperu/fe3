<div>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-indigo-700 flex items-center gap-2">
            🧾 {{ __('Punto de Venta') }}
        </h2>
    </x-slot>

    {{-- 🧍 DATOS DEL CLIENTE --}}
    <div class="max-w-7xl mx-auto mt-6 px-4">
        <div class="bg-white shadow-md rounded-2xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-indigo-700 mb-4">👤 Datos del Cliente</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Tipo Documento --}}
                <div>
                    <x-jet-label value="Tipo Documento" />
                    <select wire:model="tipodocumento_id"
                        class="w-full h-11 border border-gray-400 rounded-lg shadow-sm px-3
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition">
                        <option value="">Seleccione</option>
                        @foreach ($tipodocumentos as $t)
                            <option value="{{ $t->id }}">{{ $t->abbreviation }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Número (RUC/DNI) --}}
                <div>
                    <x-jet-label value="Número (RUC / DNI)" />
                    <div class="flex items-center">
                        <x-jet-input wire:model="ruc" wire:keydown.enter="searchRuc"
                            class="flex-1 h-11 border border-gray-400 rounded-l-lg uppercase text-sm px-3
                                   focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition"
                            placeholder="RUC o DNI" />
                        <button wire:click="searchRuc"
                            class="h-11 px-5 bg-indigo-600 text-white font-semibold rounded-r-lg 
                                   hover:bg-indigo-700 transition">
                            🔍
                        </button>
                    </div>
                </div>

                {{-- Razón Social --}}
                <div>
                    <x-jet-label value="Razón Social" />
                    <x-jet-input wire:model.defer="razon_social" disabled
                        class="w-full h-11 border border-gray-300 rounded-lg bg-gray-100 uppercase text-sm px-3" />
                </div>

                {{-- Nombre Comercial --}}
                <div>
                    <x-jet-label value="Nombre Comercial" />
                    <x-jet-input wire:model.defer="nombre_comercial" disabled
                        class="w-full h-11 border border-gray-300 rounded-lg bg-gray-100 uppercase text-sm px-3" />
                </div>

                {{-- Dirección --}}
                <div>
                    <x-jet-label value="Dirección" />
                    <x-jet-input wire:model.defer="direccion" disabled
                        class="w-full h-11 border border-gray-300 rounded-lg bg-gray-100 uppercase text-sm px-3" />
                </div>

                {{-- Departamento --}}
                <div>
                    <x-jet-label value="Departamento" />
                    <x-jet-input wire:model.defer="departamento" disabled
                        class="w-full h-11 border border-gray-300 rounded-lg bg-gray-100 uppercase text-sm px-3" />
                </div>

                {{-- Provincia --}}
                <div>
                    <x-jet-label value="Provincia" />
                    <x-jet-input wire:model.defer="provincia" disabled
                        class="w-full h-11 border border-gray-300 rounded-lg bg-gray-100 uppercase text-sm px-3" />
                </div>

                {{-- Distrito --}}
                <div>
                    <x-jet-label value="Distrito" />
                    <x-jet-input wire:model.defer="distrito" disabled
                        class="w-full h-11 border border-gray-300 rounded-lg bg-gray-100 uppercase text-sm px-3" />
                </div>
            </div>
        </div>
    </div>

    {{-- 🧾 DATOS DEL COMPROBANTE --}}
    <div class="max-w-7xl mx-auto mt-6 px-4">
        <div class="bg-white shadow-md rounded-2xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-indigo-700 mb-4">🧾 Datos del Comprobante</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Tipo Comprobante --}}
                <div>
                    <x-jet-label value="Comprobante" />
                    <select wire:model="tipocomprobante_id"
                        class="w-full h-11 border border-gray-400 rounded-lg shadow-sm px-3
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition">
                        <option value="">Seleccione</option>
                        @foreach ($tipocomprobantes as $c)
                            <option value="{{ $c->id }}">{{ $c->namecorto }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Serie --}}
                <div>
                    <x-jet-label value="Serie" />
                    <x-jet-input wire:model="serie" disabled
                        class="w-full h-11 text-center border border-gray-300 rounded-lg bg-gray-100 uppercase text-sm" />
                </div>

                {{-- Número --}}
                <div>
                    <x-jet-label value="Número" />
                    <x-jet-input wire:model="numero" disabled
                        class="w-full h-11 text-center border border-gray-300 rounded-lg bg-gray-100 text-sm" />
                </div>

                {{-- Forma de Pago --}}
                <div>
                    <x-jet-label value="Forma de Pago" />
                    <select wire:model="paymenttype_id"
                        class="w-full h-11 border border-gray-400 rounded-lg shadow-sm px-3
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition">
                        <option value="">Seleccione</option>
                        <option value="1">Contado</option>
                        <option value="2">Crédito</option>
                    </select>
                </div>

                {{-- Fecha Emisión --}}
                <div>
                    <x-jet-label value="Fecha de Emisión" />
                    <x-jet-input type="date" wire:model="fechaemision"
                        class="w-full h-11 border border-gray-400 rounded-lg shadow-sm px-3" />
                </div>

                {{-- Fecha Vencimiento --}}
                <div>
                    <x-jet-label value="Fecha de Vencimiento" />
                    <x-jet-input type="date" wire:model="fechavencimiento"
                        class="w-full h-11 border border-gray-400 rounded-lg shadow-sm px-3" />
                </div>

                {{-- Moneda --}}
                <div>
                    <x-jet-label value="Moneda" />
                    <select wire:model="currency_id"
                        class="w-full h-11 border border-gray-400 rounded-lg shadow-sm px-3">
                        <option value="">Seleccione</option>
                        @foreach ($currencies as $m)
                            <option value="{{ $m->id }}">{{ $m->abbreviation }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tipo de Operación --}}
                <div>
                    <x-jet-label value="Tipo de Operación" />
                    <select wire:model="tipodeoperacion_id"
                        class="w-full h-11 border border-gray-400 rounded-lg shadow-sm px-3">
                        <option value="">Seleccione</option>
                        @foreach ($tipodeoperacions as $t)
                            <option value="{{ $t->id }}">{{ $t->descripcion }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Nota --}}
                <div class="col-span-1 sm:col-span-2 lg:col-span-4">
                    <x-jet-label value="Nota del Comprobante" />
                    <textarea wire:model="nota" rows="2"
                        class="w-full border border-gray-400 rounded-lg text-sm px-3 py-2 bg-white
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition"
                        placeholder="Ingrese Nota del Comprobante"></textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- 🔍 BUSCADORES --}}
    <div class="max-w-7xl mx-auto mt-6 px-4">
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
            <h3 class="text-lg font-semibold mb-4 text-indigo-700">🔍 Buscar Productos</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Código de Barras --}}
                <div>
                    <x-jet-label value="Código de Barras" />
                    <input id="code" type="text" wire:keydown.enter.prevent="ScanCode($('#code').val())"
                        class="w-full h-11 border border-gray-400 rounded-lg px-3 focus:ring-2 focus:ring-indigo-300"
                        placeholder="Escanea o escribe el código...">
                </div>

                {{-- Buscar por Nombre --}}
                <div class="relative">
                    <x-jet-label value="Buscar por Nombre" />
                    <input wire:model="searchh" type="text"
                        class="w-full h-11 border border-gray-400 rounded-lg px-3 pr-10 focus:ring-2 focus:ring-indigo-300"
                        placeholder="Escribe el nombre del producto...">

                    @if ($searchh)
                        <ul
                            class="absolute left-0 w-full bg-white border rounded-lg mt-1 shadow max-h-60 overflow-y-auto z-50">
                            @forelse ($this->results as $r)
                                <li wire:click.prevent="ScanCoded('{{ $r->id }}')"
                                    class="px-4 py-2 cursor-pointer hover:bg-indigo-100 flex justify-between">
                                    <span>{{ $r->name }}</span>
                                    <span class="text-indigo-600 font-semibold">S/
                                        {{ number_format($r->saleprice, 2) }}</span>
                                </li>
                            @empty
                                <li class="px-4 py-2 text-sm text-gray-500">Sin coincidencias...</li>
                            @endforelse
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 🛒 CARRITO --}}
    <div class="max-w-7xl mx-auto mt-6 px-4">
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
            <h3 class="text-lg font-semibold mb-4 text-indigo-700">🛒 Carrito de Venta</h3>

            @if ($total > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead class="bg-indigo-50 text-indigo-700 text-xs uppercase">
                            <tr>
                                <th class="p-3 text-left">Imagen</th>
                                <th class="p-3 text-left">Código</th>
                                <th class="p-3 text-left">Producto</th>
                                <th class="p-3 text-center">Cantidad</th>
                                <th class="p-3 text-center">Precio</th>
                                <th class="p-3 text-right">Subtotal</th>
                                <th class="p-3 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3 text-center">
                                        <img src="{{ $item->image ? Storage::disk('s3')->url($item->image) : asset('storage/products/productdefault.jpg') }}"
                                            class="w-10 h-10 object-cover rounded" alt="img">
                                    </td>
                                    <td class="p-3">{{ $item->codigobarras }}</td>
                                    <td class="p-3 font-medium text-gray-800">{{ $item->name }}</td>
                                    <td class="p-3 text-center">
                                        <input type="number" min="0"
                                            wire:change="updateQty('{{ $item->id }}', '{{ $item->saleprice }}', $event.target.value, '{{ $item->mtovalorunitario }}')"
                                            value="{{ $item->quantity }}"
                                            class="w-16 text-center border-gray-300 rounded">
                                    </td>
                                    <td class="p-3 text-center">
                                        <input type="text"
                                            wire:change="updatePrice('{{ $item->id }}', $event.target.value, '{{ $item->quantity }}')"
                                            value="{{ number_format($item->saleprice, 2) }}"
                                            class="w-20 text-center border-gray-300 rounded">
                                    </td>
                                    <td class="p-3 text-right font-semibold">
                                        S/ {{ number_format($item->subtotal, 2) }}
                                    </td>
                                    <td class="p-3 text-center">
                                        <button wire:click="$emit('deleteTemporal', {{ $item->id }})"
                                            class="text-red-500 hover:text-red-700">🗑</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 text-sm font-semibold">
                            <tr>
                                <td colspan="4"></td>
                                <td class="p-2 text-right">SUBTOTAL</td>
                                <td class="p-2 text-right text-gray-800">S/ {{ number_format((float) $valorventa, 2) }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="p-2 text-right">ICBPER</td>
                                <td class="p-2 text-right text-gray-800">S/ {{ number_format((float) $icbper, 2) }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="p-2 text-right">IGV</td>
                                <td class="p-2 text-right text-gray-800">S/ {{ number_format((float) $mtoigv, 2) }}</td>
                                <td></td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-indigo-50">
                                <td colspan="4" class="p-2 text-left font-medium text-indigo-700">
                                    {{ $totalenletras ?? '' }} {{ $monedadescription ?? '' }}
                                </td>
                                <td class="p-2 text-right font-semibold text-indigo-700">TOTAL {{ $moneda ?? '' }}</td>
                                <td class="p-2 text-right text-lg font-bold text-indigo-700">
                                    S/ {{ number_format((float) str_replace(',', '', $subtotall), 2) }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <p class="text-center text-gray-500">Agrega productos al carrito...</p>
            @endif
        </div>
    </div>

    {{-- 💾 GUARDAR --}}
    <div class="max-w-7xl mx-auto mt-6 px-4 mb-8">
        <div class="bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex space-x-5 text-sm">
                <label class="flex items-center space-x-2">
                    <input wire:model="sending_method" type="radio" value="1">
                    <span>Enviar a SUNAT</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input wire:model="sending_method" type="radio" value="2">
                    <span>Generar XML</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input wire:model="sending_method" type="radio" value="3">
                    <span>Solo Guardar</span>
                </label>
            </div>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled"
                class="w-full md:w-auto px-6 py-3 text-lg font-semibold">
                💾 Guardar Comprobante
            </x-jet-danger-button>
        </div>
    </div>
</div>
