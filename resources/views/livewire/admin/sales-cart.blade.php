<div>
    <h2>Carrito de Ventas</h2>
    <ul>
        @foreach ($cart as $product)
            <li>{{ $product['name'] }} - Cantidad: {{ $product['quantity'] }}</li>
        @endforeach
    </ul>
    <p>Total: ${{ $total }}</p>
</div>
