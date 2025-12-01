<div class="w-full min-h-screen bg-gray-100 overflow-hidden" 
    x-data="{
        animateAdd(id) {
            const card = document.querySelector(`#product-${id}`);
            const cart = document.querySelector('#cart-icon');
            if (!card || !cart) return;
            const img = card.querySelector('img');
            if (!img) return;

            const clone = img.cloneNode(true);
            const rectCard = img.getBoundingClientRect();
            const rectCart = cart.getBoundingClientRect();

            clone.style.position = 'fixed';
            clone.style.left = rectCard.left + 'px';
            clone.style.top = rectCard.top + 'px';
            clone.style.width = rectCard.width + 'px';
            clone.style.height = rectCard.height + 'px';
            clone.style.zIndex = 1000;
            clone.style.borderRadius = '9999px';
            clone.style.transition = 'all 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
            document.body.appendChild(clone);

            requestAnimationFrame(() => {
                clone.style.left = rectCart.left + 'px';
                clone.style.top = rectCart.top + 'px';
                clone.style.width = '30px';
                clone.style.height = '30px';
                clone.style.opacity = '0';
            });

            setTimeout(() => clone.remove(), 700);
        }
    }">

    {{-- 🔹 Encabezado --}}
    <div class="bg-white shadow p-3 flex justify-between items-center sticky top-0 z-10">
        <h2 class="text-2xl font-bold text-gray-800">🧾 Punto de Venta Rápido</h2>
        <div id="cart-icon" 
            class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white text-sm shadow">🛒</div>
    </div>

    {{-- 🧩 Estructura principal: Izquierda catálogo / Derecha carrito --}}
    <div class="flex h-[calc(100vh-60px)] overflow-hidden">
        
        {{-- 🧍 Sección izquierda --}}
        <div class="flex-1 flex flex-col overflow-hidden px-4 py-3">

            {{-- 🔸 Cliente --}}
            <div class="bg-white rounded-2xl shadow p-4 mb-4">
                <div class="flex items-end gap-3">
                    <div class="flex-1">
                        <x-jet-label value="RUC / DNI" />
                        <div class="flex">
                            <input type="text"
                                class="w-full h-11 border-gray-300 rounded-l-xl focus:ring focus:ring-indigo-200 focus:border-indigo-300"
                                placeholder="Ingrese 8 (DNI) u 11 (RUC)" wire:model.debounce.500ms="docInput"
                                @keydown.enter.prevent="$wire.buscarCliente()" />
                            <button wire:click="buscarCliente"
                                class="h-11 px-4 bg-indigo-600 text-white rounded-r-xl hover:bg-indigo-700 transition">Buscar</button>
                        </div>
                    </div>
                    <div class="hidden lg:flex flex-wrap gap-2 text-xs">
                        <span class="px-2 py-1 bg-gray-100 rounded">Pago: Contado</span>
                        <span class="px-2 py-1 bg-gray-100 rounded">Fecha: {{ $fechaemision }}</span>
                        <span class="px-2 py-1 bg-gray-100 rounded">Moneda: PEN</span>
                        <span class="px-2 py-1 bg-gray-100 rounded">Operación: 1001</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mt-3 text-sm">
                    <div><div class="text-gray-500">Razón Social</div><div class="font-semibold text-gray-800">{{ $razon_social ?: '-' }}</div></div>
                    <div><div class="text-gray-500">Nombre Comercial</div><div class="font-semibold text-gray-800">{{ $nombre_comercial ?: '-' }}</div></div>
                    <div class="sm:col-span-2"><div class="text-gray-500">Dirección</div><div class="font-semibold text-gray-800">{{ $direccion ?: '-' }}</div></div>
                </div>
            </div>

            {{-- 🔸 Catálogo --}}
            <div class="flex-1 bg-white rounded-2xl shadow p-4 overflow-y-auto">
                <div class="flex items-center gap-2 mb-4">
                    <input type="text"
                        class="w-full h-11 border-gray-300 rounded-xl focus:ring focus:ring-indigo-200 focus:border-indigo-300"
                        placeholder="Buscar producto por nombre o código" wire:model.debounce.400ms="productSearch" />
                </div>

                {{-- 🧃 Productos 4 por fila con imágenes pequeñas --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
                    @forelse($products as $product)
                        <div id="product-{{ $product->id }}"
                            class="border rounded-xl overflow-hidden bg-white hover:shadow-lg transition transform hover:scale-[1.02] cursor-pointer"
                            @click="animateAdd({{ $product->id }}); $wire.addToCart({{ $product->id }})">

                            <div class="aspect-[5/4] bg-gray-50 flex items-center justify-center">
                                @if ($product->image1)
                                    <img src="{{ Storage::disk('s3')->url($product->image1) }}" 
                                        alt="{{ $product->name }}" class="object-cover w-full h-full scale-90">
                                @else
                                    <div class="p-3 text-center text-gray-400 text-xs">Sin imagen</div>
                                @endif
                            </div>

                            <div class="p-2 text-center">
                                <div class="text-[12px] font-semibold text-gray-800 line-clamp-2">{{ $product->name }}</div>
                                <div class="text-[11px] text-gray-500">{{ $product->codigobarras }}</div>
                                <div class="mt-1 text-[13px] font-bold text-indigo-700">S/ {{ number_format($product->saleprice, 2) }}</div>
                                <button type="button"
                                    class="mt-1 w-full bg-emerald-600 text-white rounded-md py-1 text-[12px] hover:bg-emerald-700 transition"
                                    @click.stop="animateAdd({{ $product->id }}); $wire.addToCart({{ $product->id }})">
                                    Agregar
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-10">No hay productos disponibles.</div>
                    @endforelse
                </div>

                <div class="mt-4">{{ $products->links() }}</div>
            </div>
        </div>

        {{-- 🧾 Carrito a la derecha --}}
        <div class="w-[36%] bg-white rounded-l-2xl shadow p-4 flex flex-col">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">🛒 Carrito de Venta</h3>

            @if (count($cart))
                <div class="flex-1 overflow-y-auto">
                    <table class="w-full text-[15px] border-collapse">
                        <thead class="bg-gray-100 text-gray-700 border-b">
                            <tr>
                                <th class="px-2 py-2 text-center w-8">#</th>
                                <th class="px-2 py-2">Código</th>
                                <th class="px-2 py-2">Producto</th>
                                <th class="px-2 py-2 text-center w-20">Cant.</th>
                                <th class="px-2 py-2 text-center w-24">Precio</th>
                                <th class="px-2 py-2 text-center w-24">Subtotal</th>
                                <th class="px-2 py-2 text-center w-8">🗑️</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $index => $item)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-2 py-2 text-center font-medium">{{ $loop->iteration }}</td>
                                    <td class="px-2 py-2 text-gray-600 text-xs">{{ $item['codigobarras'] }}</td>
                                    <td class="px-2 py-2 font-semibold text-gray-800 truncate">{{ $item['name'] }}</td>

                                    {{-- Cantidad editable --}}
                                    <td class="px-2 py-2 text-center">
                                        <input type="number" min="1"
                                            class="w-16 h-9 border-gray-300 rounded-lg text-center text-sm"
                                            value="{{ $item['qty'] }}"
                                            wire:change="updateQty({{ $item['id'] }}, $event.target.value)">
                                    </td>

                                    {{-- Precio editable --}}
                                    <td class="px-2 py-2 text-center">
                                        <input type="number" step="0.01" min="{{ $item['salepricemin'] }}"
                                            class="w-24 h-9 border-gray-300 rounded-lg text-center text-sm"
                                            value="{{ number_format($item['price'], 2, '.', '') }}"
                                            wire:change="updatePrice({{ $item['id'] }}, $event.target.value)">
                                        <p class="text-[11px] text-gray-400">Min: S/
                                            {{ number_format($item['salepricemin'], 2) }}</p>
                                    </td>

                                    {{-- Subtotal --}}
                                    <td class="px-2 py-2 text-right font-semibold text-gray-700">
                                        S/ {{ number_format($item['price'] * $item['qty'], 2) }}
                                    </td>

                                    {{-- Quitar --}}
                                    <td class="px-2 py-2 text-center">
                                        <button wire:click="removeFromCart({{ $item['id'] }})"
                                            class="text-red-500 hover:text-red-700 transition">✖</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Totales --}}
                <div class="mt-4 border-t pt-3 space-y-1 text-base text-gray-700">
                    <div class="flex justify-between"><span>Subtotal</span><span>S/
                            {{ number_format($this->subtotal, 2) }}</span></div>
                    <div class="flex justify-between"><span>IGV (incluido)</span><span>S/
                            {{ number_format($this->igvTotal, 2) }}</span></div>
                    <div class="flex justify-between"><span>ICBPER</span><span>S/
                            {{ number_format($this->icbperTotal, 2) }}</span></div>
                    <div class="flex justify-between text-xl font-semibold text-gray-900">
                        <span>Total</span><span>S/ {{ number_format($this->total, 2) }}</span>
                    </div>
                </div>
            @else
                <div class="flex-1 flex items-center justify-center text-gray-500">
                    Aún no hay productos agregados.
                </div>
            @endif

            <button class="mt-4 w-full bg-indigo-600 text-white rounded-xl py-3 text-lg hover:bg-indigo-700 transition">
                💾 Guardar y Emitir
            </button>
        </div>
    </div>
</div>
