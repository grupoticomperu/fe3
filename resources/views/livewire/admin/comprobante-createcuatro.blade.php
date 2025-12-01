<div class="min-h-screen bg-gray-100 text-gray-800">
    {{-- 🔹 Header --}}
    <div class="bg-indigo-600 text-white py-4 px-6 shadow">
        <h2 class="text-2xl font-semibold">🧾 Punto de Venta</h2>
        <p class="text-sm opacity-80">Registro de comprobantes de venta</p>
    </div>

    {{-- 🔹 Buscadores (arriba, 100% ancho) --}}
    <div class="bg-white shadow-md p-4 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Código de barras --}}
            <div>
                <x-jet-label value="Código de barras" />
                <input id="code" type="text" wire:keydown.enter.prevent="ScanCode($('#code').val())"
                    class="w-full h-11 border-gray-300 rounded-md px-3 focus:ring-indigo-200"
                    placeholder="Escanea o escribe el código de barras...">
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

    {{-- 🔹 Contenido principal --}}
    <div class="max-w-7xl mx-auto mt-6 px-4 grid grid-cols-1 lg:grid-cols-12 gap-4">
        {{-- 🔸 Columna izquierda: datos del cliente y comprobante --}}
        <div class="lg:col-span-4 space-y-4">
            {{-- Datos del cliente --}}
            <div class="bg-white rounded-2xl shadow p-5">
                <h3 class="text-lg font-semibold mb-4 text-indigo-700">👤 Datos del Cliente</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <x-jet-label value="Tipo Documento" />
                        <select wire:model="tipodocumento_id"
                            class="w-full h-10 border-gray-400 rounded-md shadow-sm focus:ring-indigo-200 focus:border-indigo-300">
                            <option value="">Seleccione</option>
                            @foreach ($tipodocumentos as $t)
                                <option value="{{ $t->id }}">{{ $t->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <x-jet-label for="ruc" value="Número" class="text-sm font-semibold text-gray-700" />
                        <div class="flex items-center">
                            <x-jet-input id="ruc" wire:model="ruc" wire:keydown.enter="searchRuc"
                                class="flex-1 h-11 border border-gray-400 rounded-l-lg uppercase text-sm px-3
                   focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500
                   transition-all duration-200 placeholder-gray-400"
                                placeholder="Ingrese RUC o DNI" />

                            <button wire:click="searchRuc"
                                class="h-11 px-5 bg-indigo-600 text-white font-semibold rounded-r-lg 
                   hover:bg-indigo-700 active:scale-95 transition-all duration-150 flex items-center justify-center border border-indigo-600">
                                🔍
                            </button>
                        </div>
                        <x-jet-input-error for="ruc" class="text-red-500 text-xs mt-1" />
                    </div>

                    <div>
                        <x-jet-label for="razon_social" value="Razón Social"
                            class="text-sm font-semibold text-gray-700" />
                        <x-jet-input id="razon_social" wire:model.defer="razon_social" disabled
                            class="w-full h-11 border border-gray-400 rounded-lg bg-gray-100 uppercase text-sm px-3
               text-gray-700 font-medium placeholder-gray-400
               focus:ring-0 focus:border-gray-400 cursor-not-allowed transition-all duration-200"
                            placeholder="Nombre o razón social" />
                    </div>

                    <div>
                        <x-jet-label for="direccion" value="Dirección" class="text-sm font-semibold text-gray-700" />
                        <x-jet-input id="direccion" wire:model.defer="direccion" disabled
                            class="w-full h-11 border border-gray-400 rounded-lg bg-gray-100 uppercase text-sm px-3
               text-gray-700 font-medium placeholder-gray-400
               focus:ring-0 focus:border-gray-400 cursor-not-allowed transition-all duration-200"
                            placeholder="Dirección fiscal o domicilio" />
                    </div>
                </div>
            </div>

            {{-- Datos del comprobante --}}


            {{-- Datos del comprobante --}}
            {{-- Datos del comprobante --}}
            <div class="bg-white rounded-2xl shadow p-5 border border-gray-300">
                <h3 class="text-lg font-semibold mb-4 text-indigo-700">🧾 Datos del Comprobante</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                    {{-- Tipo de Comprobante --}}
                    <div>
                        <x-jet-label for="tipocomprobante_id" value="Tipo de Comprobante"
                            class="text-sm font-semibold text-gray-700" />
                        <select id="tipocomprobante_id" wire:model="tipocomprobante_id"
                            class="w-full h-11 border border-gray-400 rounded-lg text-sm px-3
                       focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500
                       transition-all duration-200 bg-white text-gray-700">
                            <option value="">Seleccione</option>
                            @foreach ($tipocomprobantes as $c)
                                <option value="{{ $c->id }}">{{ $c->namecorto }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Forma de Pago --}}
                    <div>
                        <x-jet-label for="paymenttype_id" value="Forma de Pago"
                            class="text-sm font-semibold text-gray-700" />
                        <select id="paymenttype_id" wire:model="paymenttype_id"
                            class="w-full h-11 border border-gray-400 rounded-lg text-sm px-3
                       focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500
                       transition-all duration-200 bg-white text-gray-700">
                            <option value="">Seleccione</option>
                            <option value="1">Contado</option>
                            <option value="2">Crédito</option>
                        </select>
                    </div>

                    {{-- Serie --}}
                    <div>
                        <x-jet-label value="Serie" class="text-sm font-semibold text-gray-700" />
                        <x-jet-input wire:model="serie" disabled
                            class="w-full h-11 text-center border border-gray-400 bg-gray-100 rounded-lg text-sm uppercase
                       text-gray-700 focus:ring-0 cursor-not-allowed" />
                    </div>

                    {{-- Número --}}
                    <div>
                        <x-jet-label value="Número" class="text-sm font-semibold text-gray-700" />
                        <x-jet-input wire:model="numero" disabled
                            class="w-full h-11 text-center border border-gray-400 bg-gray-100 rounded-lg text-sm
                       text-gray-700 focus:ring-0 cursor-not-allowed" />
                    </div>

                    {{-- Fecha de Emisión --}}
                    <div>
                        <x-jet-label value="Fecha de Emisión" class="text-sm font-semibold text-gray-700" />
                        <x-jet-input type="date" max="{{ date('Y-m-d') }}"
                            min="{{ date('Y-m-d', strtotime('-3 days')) }}" wire:model="fechaemision"
                            class="w-full h-11 border border-gray-400 rounded-lg text-sm px-3
                       focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500
                       transition-all duration-200 bg-white text-gray-700" />
                    </div>

                    {{-- Fecha de Vencimiento --}}
                    <div>
                        <x-jet-label value="Fecha de Vencimiento" class="text-sm font-semibold text-gray-700" />
                        <x-jet-input type="date" min="{{ date('Y-m-d', strtotime('-3 days')) }}"
                            wire:model="fechavencimiento"
                            class="w-full h-11 border border-gray-400 rounded-lg text-sm px-3
                       focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500
                       transition-all duration-200 bg-white text-gray-700" />
                    </div>

                    {{-- Moneda --}}
                    <div>
                        <x-jet-label for="currency_id" value="Moneda" class="text-sm font-semibold text-gray-700" />
                        <select id="currency_id" wire:model="currency_id"
                            class="w-full h-11 border border-gray-400 rounded-lg text-sm px-3
                       focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500
                       transition-all duration-200 bg-white text-gray-700">
                            <option value="">Seleccione</option>
                            @foreach ($currencies as $c)
                                <option value="{{ $c->id }}">{{ $c->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tipo de Operación --}}
                    <div>
                        <x-jet-label value="Tipo de Operación" class="text-sm font-semibold text-gray-700" />
                        <select wire:model="tipodeoperacion_id"
                            class="w-full h-11 border border-gray-400 rounded-lg text-sm px-3
                       focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500
                       transition-all duration-200 bg-white text-gray-700">
                            <option value="">Seleccione</option>
                            @foreach ($tipodeoperacions as $t)
                                <option value="{{ $t->id }}">{{ $t->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nota del Comprobante --}}
                    <div class="md:col-span-2">
                        <x-jet-label value="Nota del Comprobante" class="text-sm font-semibold text-gray-700" />
                        <textarea wire:model="nota" rows="2"
                            class="w-full border border-gray-400 rounded-lg text-sm px-3 py-2
                       focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500
                       transition-all duration-200 bg-white text-gray-700 resize-none"
                            placeholder="Ingrese nota o comentario del comprobante..."></textarea>
                    </div>
                </div>
            </div>







        </div>

        {{-- 🔸 Columna derecha: Carrito --}}
        <div class="lg:col-span-8 bg-white rounded-2xl shadow p-6 flex flex-col">
            <h3 class="text-lg font-semibold mb-5 text-indigo-700">🛒 Carrito de Venta</h3>

            @if ($total > 0)
                <div class="overflow-x-auto flex-1">
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
                                        @if ($item->image)
                                            <img src="{{ Storage::disk('s3')->url($item->image) }}"
                                                class="w-10 h-10 object-cover rounded" alt="img">
                                        @else
                                            <img src="{{ asset('storage/products/productdefault.jpg') }}"
                                                class="w-10 h-10 object-cover rounded" alt="default">
                                        @endif
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
                            {{-- 🔸 Subtotal --}}
                            <tr>
                                <td colspan="4"></td>
                                <td class="p-2 text-right">SUBTOTAL</td>
                                <td class="p-2 text-right text-gray-800">
                                    S/ {{ number_format((float) $valorventa, 2) }}
                                </td>
                                <td></td>
                            </tr>

                            {{-- 🔸 ICBPER --}}
                            <tr>
                                <td colspan="4"></td>
                                <td class="p-2 text-right">ICBPER</td>
                                <td class="p-2 text-right text-gray-800">
                                    S/ {{ number_format((float) $icbper, 2) }}
                                </td>
                                <td></td>
                            </tr>

                            {{-- 🔸 IGV --}}
                            <tr>
                                <td colspan="4"></td>
                                <td class="p-2 text-right">IGV</td>
                                <td class="p-2 text-right text-gray-800">
                                    S/ {{ number_format((float) $mtoigv, 2) }}
                                </td>
                                <td></td>
                            </tr>

                            {{-- 🔹 TOTAL FINAL --}}
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
                <p class="text-center text-gray-500 flex-1 flex items-center justify-center">
                    Agrega productos al carrito...
                </p>
            @endif
        </div>
    </div>

    {{-- 🔹 Guardar --}}
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

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script>
        Livewire.on('deleteTemporal', temporalId => {
            Swal.fire({
                title: '¿Eliminar producto?',
                text: "No se podrá revertir esta acción.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                buttonsStyling: false,
                customClass: {
                    popup: 'rounded-2xl shadow-xl p-4',
                    confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md mx-2',
                    cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md mx-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.comprobante-createcuatro', 'delete', temporalId);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Producto eliminado del carrito',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });
    </script>
@endpush
