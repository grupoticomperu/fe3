<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;

class TotalProduct extends Component
{
    //protected $listeners = ['render'];
    protected $listeners = ['render'];

    public $carttx;
    public $total;

   /*  public function mount()
    {
        $this->carttx = session('carttx', []); //se asigna el valor de la variable sesion y si no hay sesio se le asigna array vacio

    } */

    public function getTotalProducts()
    {
        $total = 0;

        foreach ($this->carttx as $product) {
            $total += $product['quantity'];
        }

        return $total;
    }

/*     public function reloadPage()
    {
        $this->reset(); // Esto reinicia los datos del componente
        $this->emitTo('total-product', 'render'); // Vuelve a emitir el evento render
        $this->emitTo('dropdown-cart', 'render'); // Vuelve a emitir el evento render
        $this->dispatchBrowserEvent('reloadPage'); // Esto recargará la página
    } */

    public function render()
    {
        $this->carttx = session('carttx', new Collection());
        $this->total = $this->getTotalProducts();
        return view('livewire.total-product');
    }
}
