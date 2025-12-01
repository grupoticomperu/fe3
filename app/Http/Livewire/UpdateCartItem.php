<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;

class UpdateCartItem extends Component
{
    public $qty;
    public $carttx, $idshoping, $product;

    protected $listeners = ['updateCart'];

    public function updateCart($data)
    {
        $this->carttx = new Collection($data);
    }

    public function mount($id){
        $this->idshoping = $id;

        $this->carttx = session('carttx', new Collection());
        if($this->idshoping){
            $this->product = $this->carttx->get($this->idshoping);
            //collect($this->product);
            $this->qty = $this->product['quantity'];
        }

        //dd(collect($this->product));
        //dd($this->idshoping);
        //$this->carttx = session('carttx', []);
       // $this->carttx = collect(session('carttx', []));

        //}
     }


     public function actualizar()
     {
         //$product = $this->carttx->get($this->idshoping);

         if ($this->product) {
             $this->product['quantity'] = $this->qty;
             $this->carttx->put($this->product['id'], $this->product);

         }
         session(['carttx' => $this->carttx]);
        // session(['carttx' => $this->carttx->toArray()]);

         $this->emitTo('shopping-cart', 'render');
         $this->emitTo('total-product', 'render');
         //$this->refresh();
         //return redirect()->route('shoppingcart.ecommerce');
         //$this->reset('product');
     }


/*     public function updatedQty($value)
    {
        $this->qty = $value;
        $item = $this->carttx->get($this->idshoping);

        if ($item) {
            $item['quantity'] = $this->qty;
            //dd($item);
            $this->carttx->put($this->idshoping, $item);//poniendo en el carrito
            session(['carttx' => $this->carttx]);//actualizando la sesion
            //dd($this->carttx);
        }

        $this->emitTo('shopping-cart', 'render');

    }
 */

/*     public function decrement(){
        $this->qty = $this->qty - 1;
       // $item = $this->carttx->get($this->idshoping);
        $this->itemm['quantity'] = $this->qty;

        //Cart::update($this->rowId, $this->qty);//lo actualiza en el carrito la cantidad del producto disminuido
        $this->carttx->put($this->idshoping, $this->itemm);//poniendo en el carrito
        session(['carttx' => $this->carttx]);//actualizando la sesion
        $this->emitTo('shopping-cart', 'render');//para renderizar en DropdownCart
        $this->emitTo('total-product', 'render');//para renderizar en DropdownCart
        $this->reset('itemm');
    }

    public function increment(){
        $this->qty = $this->qty + 1;
        //$item = $this->carttx->get($this->idshoping);
        $this->itemm['quantity'] = $this->qty;
        $this->carttx->put($this->idshoping, $this->itemm);//poniendo en el carrito
        session(['carttx' => $this->carttx]);//actualizando la sesion
        $this->emitTo('shopping-cart', 'render');//para renderizar en DropdownCart
        $this->emitTo('total-product', 'render');
        $this->reset('itemm');
    }
 */

 public function decrement(){
    $this->qty = $this->qty - 1;
    $this->actualizar();
    //$this->reset('itemm');
}

public function increment(){
    $this->qty = $this->qty + 1;
    $this->actualizar();
    //$this->reset('itemm');
}

    public function render()
    {



        //dd($this->product['quantity']);
        //dd($this->carttx);
        //dd($this->product);

       // $this->carttx = session('carttx', new Collection());
       // $this->itemm = $this->carttx->get($this->idshoping);
        //dd($this->itemm);
        //dd($this->carttx);
        //$product = $this->carttx->get($productId);
        //if ($item) {
         //   $this->qty = $this->itemm['quantity'];
        return view('livewire.update-cart-item');
    }
}
