<div class="min-h-screen bg-gray-100 flex flex-col relative"
    x-data="{ showCart: @entangle('showCart'), page: 1 }"
    x-init="
        let observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    $wire.loadMore();
                }
            });
        });
        observer.observe($refs.loadMore);
    "
    x-cloak>

    {{-- 🔹 Header --}}
    <header class="bg-indigo-600 text-white py-3 px-4 flex justify-between items-center shadow-md">
        <h1 class="text-lg font-semibold truncate">POS Móvil</h1>
        <div @click="showCart = true" class="relative cursor-pointer select-none">
            <span class="material-icons text-3xl">shopping_cart</span>
            @if(!empty($cart))
                <span class="absolute -top-1 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5">
                    {{ count($cart) }}
                </span>
            @endif
        </div>
    </header>

    {{-- 🔍 Buscador --}}
    <div class="p-3 bg-white shadow-sm sticky top-0 z-10">
        <input type="text" wire:model.debounce.400ms="productSearch"
            class="w-full h-11 border-gray-300 rounded-lg px-3 focus:ring focus:ring-indigo-200 focus:border-indigo-300 text-sm"
            placeholder="Buscar producto por nombre o código...">
    </div>

    {{-- 🧃 Catálogo --}}
    <div class="flex-1 overflow-y-auto p-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 pb-24">

        @foreach($products as $product)
            <div wire:key="prod-{{ $product->id }}"
                class="bg-white rounded-xl border shadow-sm hover:shadow-md transition flex flex-col overflow-hidden">

                {{-- Imagen + Botón --}}
                <div class="relative">
                    <img src="{{ $product->image1 ? Storage::disk('s3')->url($product->image1) : asset('img/noimage.png') }}"
                         alt="{{ $product->name }}"
                         class="w-full h-32 object-cover rounded-t-xl sm:h-36 md:h-40">

                    {{-- Botón agregar sobre la imagen --}}
                    <button wire:click="addToCart({{ $product->id }})"
                        class="absolute bottom-2 right-2 bg-emerald-600 text-white rounded-full w-9 h-9 flex items-center justify-center shadow-lg hover:bg-emerald-700 active:scale-95">
                        +
                    </button>
                </div>

                {{-- Nombre + Precio --}}
                <div class="p-2 text-center">
                    <p class="text-[13px] font-semibold text-gray-800 line-clamp-2 leading-tight">{{ $product->name }}</p>
                    <p class="text-[12px] text-gray-500">{{ $product->codigobarras }}</p>
                    <p class="text-[14px] font-bold text-indigo-700 mt-1">S/ {{ number_format($product->saleprice, 2) }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 🔄 Paginación infinita --}}
    <div x-ref="loadMore" class="text-center text-gray-400 text-sm pb-28">
        @if($products->hasMorePages())
            <span>Cargando más productos...</span>
        @else
            <span>No hay más productos</span>
        @endif
    </div>

    {{-- 🔸 Barra inferior fija --}}
    <div class="fixed bottom-0 left-0 w-full bg-white shadow-lg border-t p-3 flex justify-between items-center z-40">
        <div>
            <p class="text-xs text-gray-500">Total</p>
            <p class="text-lg font-bold text-indigo-700">S/ {{ number_format($this->total, 2) }}</p>
        </div>
        <button @click="showCart = true"
            class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-semibold text-sm active:scale-95 transition">
            @if(!empty($cart))
                Ver Carrito ({{ count($cart) }})
            @else
                Carrito vacío
            @endif
        </button>
    </div>

    {{-- 🛒 Modal del carrito --}}
    <div x-show="showCart"
         x-transition.opacity
         class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-end justify-center">

        <div x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             @click.away="showCart = false"
             class="bg-white w-full rounded-t-2xl shadow-xl p-4 max-h-[80vh] overflow-y-auto">

            <div class="flex justify-between items-center mb-3 border-b pb-2">
                <h2 class="text-lg font-semibold text-gray-800">Carrito</h2>
                <button @click="showCart = false"
                        class="text-gray-500 text-xl hover:text-gray-700">&times;</button>
            </div>

            @if(!empty($cart))
                @foreach($cart as $item)
                    <div class="flex justify-between items-center border-b py-2">
                        <div class="flex-1">
                            <p class="font-semibold text-sm">{{ $item['name'] }}</p>
                            <p class="text-xs text-gray-500">S/ {{ number_format($item['price'], 2) }} c/u</p>
                        </div>
                        <div class="flex items-center gap-1">
                            <button class="bg-gray-200 rounded-full w-6 h-6 flex items-center justify-center"
                                wire:click="updateQty({{ $item['id'] }}, {{ max($item['qty'] - 1, 1) }})">-</button>
                            <input type="number" min="1" class="w-10 text-center text-sm border rounded"
                                value="{{ $item['qty'] }}"
                                wire:change="updateQty({{ $item['id'] }}, $event.target.value)">
                            <button class="bg-gray-200 rounded-full w-6 h-6 flex items-center justify-center"
                                wire:click="updateQty({{ $item['id'] }}, {{ $item['qty'] + 1 }})">+</button>
                        </div>
                        <div class="text-right ml-2 text-sm font-semibold">
                            S/ {{ number_format($item['price'] * $item['qty'], 2) }}
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 text-right">
                    <p class="font-semibold text-gray-700 text-base">Total: S/ {{ number_format($this->total, 2) }}</p>
                    <button wire:click="save"
                        class="mt-3 w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
                        💾 Guardar y Emitir
                    </button>
                </div>
            @else
                <div class="text-center py-10 text-gray-500">
                    No hay productos en el carrito.
                </div>
            @endif
        </div>
    </div>
</div>
