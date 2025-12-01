<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class DropdownCart extends Component
{
    protected $listeners = ['render'];

    public $carttx;

    public function mount()
    {
        $this->carttx = session('carttx', []);//se asigna el valor de la variable sesion y si no hay sesio se le asigna array vacio
    }

    //para actualizar el subtotal cuando cambian la cantidad a comprar
    public function updateQuantity($productId, $quantity)
    {
        if ($this->cart->has($productId)) {
            $product = $this->cart->get($productId);
            $product['quantity'] = $quantity;
            $this->cart->put($productId, $product);
            session()->put('cart', $this->cart);
        }
    }


    public function render()
    {
        //$x=Cart::content();
        //dd($this->carttx[1]['name']);
        return view('livewire.dropdown-cart');
    }
}
