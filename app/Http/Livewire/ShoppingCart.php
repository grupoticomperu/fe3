<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Collection;

class ShoppingCart extends Component
{
    public $carttx;

    //protected $listeners = ['render'];
    protected $listeners = ['render' => 'render'];

/*     public function mount()
    {
        //$this->carttx = session('carttx', []); //se asigna el valor de la variable sesion y si no hay sesio se le asigna array vacio
        $this->carttx = session('carttx', new Collection());

    } */


    public function render()
    {   $this->carttx = session('carttx', new Collection());
        $carttx = $this->carttx;
        $this->emit('updateCart', $this->carttx->toArray());
        //dd($carttx);
        $categories = Category::where('state', 1)->get();
        return view('livewire.shopping-cart', compact('categories','carttx'))->layout('layouts.appwebd');
    }
}
