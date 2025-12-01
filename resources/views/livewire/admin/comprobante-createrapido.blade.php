<div>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-indigo-700 flex items-center gap-2">
            🧾 {{ __('Punto de Venta') }}
        </h2>
    </x-slot>

    {{-- 🧍 CLIENTE + COMPROBANTE --}}
    <div class="max-w-7xl mx-auto mt-6 px-4">
        <div class="bg-white shadow-lg rounded-2xl border border-gray-200 p-6 transition hover:shadow-xl">

            {{-- CLIENTE --}}
            <div class="grid grid-cols-12 gap-4 items-end">
                <div class="col-span-12 sm:col-span-2">
                    <x-jet-label value="Tipo Documento" />
                    <select wire:model="tipodocumento_id"
                        class="w-full h-11 border border-gray-300 rounded-lg shadow-sm px-3 bg-white
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition">
                        <option value="">Seleccione</option>
                        @foreach ($tipodocumentos as $t)
                            <option value="{{ $t->id }}">{{ $t->abbreviation }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-12 sm:col-span-3">
                    <x-jet-label value="Número (RUC / DNI)" />
                    <div class="flex items-center">
                        <x-jet-input wire:model="ruc" wire:keydown.enter="searchRuc"
                            class="flex-1 h-11 border border-gray-300 rounded-l-lg uppercase text-sm px-3
                                   focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition"
                            placeholder="RUC o DNI" />
                        <button wire:click="searchRuc"
                            class="h-11 px-5 bg-indigo-600 text-white font-semibold rounded-r-lg 
                                   hover:bg-indigo-700 transition flex items-center justify-center">
                            🔍
                        </button>
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <x-jet-label value="Razón Social" />
                    <x-jet-input wire:model.defer="razon_social" disabled
                        class="w-full h-11 border border-gray-200 rounded-lg bg-gray-50 uppercase text-sm px-3
                               text-gray-700 font-medium" />
                </div>

                <div class="col-span-12 sm:col-span-3">
                    <x-jet-label value="Dirección" />
                    <x-jet-input wire:model.defer="direccion" disabled
                        class="w-full h-11 border border-gray-200 rounded-lg bg-gray-50 uppercase text-sm px-3
                               text-gray-700 font-medium" />
                </div>
            </div>

            {{-- COMPROBANTE --}}
            <div class="grid grid-cols-12 gap-4 items-end mt-4 border-t border-gray-200 pt-4">
                <div class="col-span-12 sm:col-span-2">
                    <x-jet-label value="Comprobante" />
                    <select wire:model="tipocomprobante_id"
                        class="w-full h-11 border border-gray-300 rounded-lg shadow-sm px-3
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition">
                        <option value="">Seleccione</option>
                        @foreach ($tipocomprobantes as $c)
                            <option value="{{ $c->id }}">{{ $c->namecorto }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-12 sm:col-span-2">
                    <x-jet-label value="Serie" />
                    <x-jet-input wire:model="serie" disabled
                        class="w-full h-11 text-center border border-gray-300 rounded-lg bg-gray-100 uppercase text-sm" />
                </div>

                <div class="col-span-12 sm:col-span-2">
                    <x-jet-label value="Número" />
                    <x-jet-input wire:model="numero" disabled
                        class="w-full h-11 text-center border border-gray-300 rounded-lg bg-gray-100 text-sm" />
                </div>

                <div class="col-span-12 sm:col-span-2">
                    <x-jet-label value="Forma de Pago" />
                    <select wire:model="paymenttype_id"
                        class="w-full h-11 border border-gray-300 rounded-lg shadow-sm px-3
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition">
                        <option value="">Seleccione</option>
                        <option value="1">Contado</option>
                        <option value="2">Crédito</option>
                    </select>
                </div>

                <div class="col-span-12 sm:col-span-2">
                    <x-jet-label value="Fecha de Emisión" />
                    <x-jet-input type="date" wire:model="fechaemision"
                        class="w-full h-11 border border-gray-300 rounded-lg shadow-sm px-3
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition" />
                </div>

                <div class="col-span-12 sm:col-span-2">
                    <x-jet-label value="Moneda" />
                    <select wire:model="currency_id"
                        class="w-full h-11 border border-gray-300 rounded-lg shadow-sm px-3
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition">
                        <option value="">Seleccione</option>
                        @foreach ($currencies as $m)
                            <option value="{{ $m->id }}">{{ $m->abbreviation }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- BUSCADORES --}}
            {{--  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <div>
                    <x-jet-label value="Código de Barras" />
                    <input id="code" type="text" wire:keydown.enter.prevent="ScanCode($('#code').val())"
                        class="w-full h-11 border border-gray-300 rounded-lg px-3
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition"
                        placeholder="Escanea o escribe el código...">
                </div>

                <div class="relative">
                    <x-jet-label value="Buscar por Nombre" />
                    <input wire:model="searchh" type="text"
                        class="w-full h-11 border border-gray-300 rounded-lg px-3 pr-10
                               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition"
                        placeholder="Escribe el nombre del producto...">

                    @if ($searchh)
                        <ul
                            class="absolute left-0 w-full bg-white border border-gray-200 rounded-lg mt-1 shadow-lg max-h-60 overflow-y-auto z-50">
                            @forelse ($this->results as $r)
                                <li wire:click.prevent="ScanCoded('{{ $r->id }}')"
                                    class="px-4 py-2 cursor-pointer hover:bg-indigo-50 flex justify-between text-sm">
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
            </div>  --}}


            <div class="bg-white shadow-md p-4 sticky top-0 z-40">
                <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Código de barras --}}
                    {{-- 🔹 Código de barras --}}
                    <div class="relative">
                        <x-jet-label value="Código de barras" />

                        <input id="code" type="text" wire:keydown.enter.prevent="ScanCode($('#code').val())"
                            class="w-full h-11 border border-gray-300 rounded-md px-3 pr-10
               focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition"
                            placeholder="Escanea o escribe el código de barras...">

                        {{-- 🔸 Botón limpiar con JavaScript --}}
                        {{-- <button type="button"
                            onclick="document.getElementById('code').value=''; document.getElementById('code').focus();"
                            class="absolute inset-y-0 right-2 flex items-center text-gray-400 hover:text-gray-600 transition"
                            title="Limpiar campo">
                            ✖
                        </button> --}}
                    </div>



                    <div class="relative">
                        <x-jet-label value="Buscar por nombre" />
                        <div class="relative">
                            <input wire:model="searchh" wire:blur="$set('searchh', '')" type="text"
                                class="w-full h-11 border-gray-300 rounded-md px-3 pr-10 focus:ring-indigo-200"
                                placeholder="Buscar producto por nombre...">

                            {{-- 🔸 Botón limpiar --}}
                            @if ($searchh)
                                <button type="button" wire:click="$set('searchh', '')"
                                    class="absolute inset-y-0 right-2 flex items-center text-gray-400 hover:text-gray-600"
                                    title="Limpiar búsqueda">
                                    ✖
                                </button>
                            @endif
                        </div>

                        {{-- 🔹 Resultados dinámicos --}}
                        @if ($searchh)
                            <ul
                                class="absolute left-0 w-full bg-white border rounded-lg mt-1 shadow max-h-60 overflow-y-auto z-50">
                                @forelse ($this->results as $r)
                                    <li wire:click.prevent="ScanCoded('{{ $r->id }}')"
                                        class="px-4 py-2 cursor-pointer hover:bg-indigo-100 flex justify-between items-center">
                                        <span class="truncate">{{ $r->name }}</span>
                                        <span class="text-indigo-600 font-semibold">S/
                                            {{ number_format($r->saleprice, 2) }}</span>
                                    </li>
                                @empty
                                    <li class="px-4 py-2 text-sm text-gray-500 flex justify-between items-center">
                                        Sin coincidencias...
                                        <button type="button" wire:click="$set('searchh', '')"
                                            class="text-xs text-indigo-600 hover:underline">
                                            Limpiar
                                        </button>
                                    </li>
                                @endforelse
                            </ul>
                        @endif
                    </div>


                </div>
            </div>








            {{-- CARRITO --}}
            <div class="mt-6 border-t border-gray-200 pt-4">
                @if ($total > 0)
                    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
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
                                    <tr class="border-b hover:bg-gray-50 transition">
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
                                                class="text-red-500 hover:text-red-700 transition">🗑</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50 text-sm font-semibold">
                                <tr>
                                    <td colspan="4"></td>
                                    <td class="p-2 text-right">SUBTOTAL</td>
                                    <td class="p-2 text-right text-gray-800">
                                        S/ {{ number_format((float) $valorventa, 2) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td class="p-2 text-right">IGV</td>
                                    <td class="p-2 text-right text-gray-800">
                                        S/ {{ number_format((float) $mtoigv, 2) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr class="border-t border-gray-300 bg-indigo-50">
                                    <td colspan="4" class="p-2 text-left font-medium text-indigo-700">
                                        {{ $totalenletras ?? '' }} {{ $monedadescription ?? '' }}
                                    </td>
                                    <td class="p-2 text-right font-semibold text-indigo-700">
                                        TOTAL {{ $moneda ?? '' }}
                                    </td>
                                    <td class="p-2 text-right text-lg font-bold text-indigo-700">
                                        S/ {{ number_format((float) str_replace(',', '', $subtotall), 2) }}
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <p class="text-center text-gray-500 py-6 italic">Agrega productos al carrito...</p>
                @endif
            </div>
        </div>
    </div>

    {{-- 💾 GUARDAR --}}
    <div class="max-w-7xl mx-auto mt-6 px-4 mb-8">
        <div
            class="bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row justify-between items-center gap-4 border border-gray-200 hover:shadow-lg transition">
            <div class="flex space-x-5 text-sm text-gray-700">
                <label class="flex items-center space-x-2">
                    <input wire:model="sending_method" type="radio" value="1" class="text-indigo-600">
                    <span>Enviar a SUNAT</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input wire:model="sending_method" type="radio" value="2" class="text-indigo-600">
                    <span>Generar XML</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input wire:model="sending_method" type="radio" value="3" class="text-indigo-600">
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

@push('scripts')
    <script>
        window.addEventListener('clear-barcode', () => {
            const input = document.getElementById('code');
            input.value = '';
            input.focus();
        });
    </script>
@endpush
