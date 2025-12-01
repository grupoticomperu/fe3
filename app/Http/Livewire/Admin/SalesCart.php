<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Collection;

class SalesCart extends Component
{


    public $instance; // Nombre de la instancia del carrito
    public $cart;
    public $total;

    public function mount($instance)
    {
        $this->instance = $instance;
        $this->cart = session()->get($this->instance, new Collection());
    }

    public function addToCart($productId, $name, $price, $quantity = 1)
    {
        if ($this->cart->has($productId)) {
            $product = $this->cart->get($productId);
            $product['quantity'] += $quantity;
        } else {
            $product = [
                'id' => $productId,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
            ];
        }

        $this->cart->put($productId, $product);
        session()->put($this->instance, $this->cart);
    }

    public function removeFromCart($productId)
    {
        if ($this->cart->has($productId)) {
            $this->cart->forget($productId);
            session()->put($this->instance, $this->cart);
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        if ($this->cart->has($productId)) {
            $product = $this->cart->get($productId);
            $product['quantity'] = $quantity;
            $this->cart->put($productId, $product);
            session()->put($this->instance, $this->cart);
        }
    }

    public function clearCart()
    {
        session()->forget($this->instance);
    }

    public function getTotal()
    {
        $total = 0;

        foreach ($this->cart as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        return $total;
    }

    public function getTotalQuantity()
    {
        $totalQuantity = 0;

        foreach ($this->cart as $product) {
            $totalQuantity += $product['quantity'];
        }

        return $totalQuantity;
    }

    public function render()
    {
        return view('livewire.admin.sales-cart');
    }


}
