<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sale;
use App\Models\Boleta;
use App\Models\Boleta_local_productatribute;
use Livewire\Component;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Configuration;
//use Darryldecode\Cart\Facades\CartFacade as Cart;
//use App\Models\Boleta_local_productatribute;
//use App\Models\Boleta;
//use App\Http\Livewire\Admin\SalesCart;
use App\Models\Tipocomprobante;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Localproductatribute;
use App\Models\Productatribute;
use Illuminate\Support\Facades\Auth;

class SaleCreate extends Component
{

    public $mensaje;
    public $itemsQuantity;
    public $customer_id = "", $fechaemision, $fechavencimiento, $formadepago = "", $tipocomprobante_id = "", $serienumero, $currency_id = "";
    public $photo, $nota, $subtotal, $igv, $total, $tipodecambio_id, $paymenttype_id;
    public $serie, $numero, $search, $boleta;

    public $totaldos;

    public $salesCartInstance = 'salesCart';
    public $cart;
    public $cartdos;

    public function mount()
    {

        $this->cart = session('cart', new Collection());
        // establece la propiedad $cart en el contenido de la sesión con la clave 'cart' si existe,
        //y si no existe (por ejemplo, en la primera carga de la página), crea una nueva colección vacía y la asigna a la propiedad $cart.
        //Esto asegura que siempre haya una instancia de Collection disponible para trabajar con los productos en el carrito.
        $this->cartdos = session('cartdos', new Collection());
    }


    public function addToCart($productId, $name, $price, $quantity = 1)
    {
        if ($this->cart) {
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
            //$this->cart->put($product);
            session(['cart' => $this->cart]);
        }
    }







    public function addToCartdos($productId, $name, $price, $quantity = 1)
    {
        if ($this->cartdos) {
            if ($this->cartdos->has($productId)) {
                $product = $this->cartdos->get($productId);
                $product['quantity'] += $quantity;
            } else {
                $product = [
                    'id' => $productId,
                    'name' => $name,
                    'price' => $price,
                    'quantity' => $quantity,
                ];
            }

            $this->cartdos->put($productId, $product);
            session(['cartdos' => $this->cartdos]);
        }
    }



    public function save()
    {
        //validamos los datos cabecera y detalle
        $configuration = Configuration::first();
        $igv = $configuration->igv;

        //$this->validate();
        DB::beginTransaction();

        try {
            //guardamos la table sales
            $sale = Sale::create([
                //'local_tipocomprobante_id' => 2,
                'local_id' =>  Auth::user()->employee->local->id,
                'tipocomprobante_id' => $this->tipocomprobante_id,
                'customer_id' => $this->customer_id,
                'paymenttype_id' => $this->paymenttype_id,
                'user_id' => 1,
                'currency_id' => $this->currency_id,

                'serie' => $this->serie,
                'numero' => $this->numero,

                'fechaemision' => $this->fechaemision,
                'fechavencimiento' => $this->fechavencimiento,

                'subtotal' => $this->total - $this->total * $igv / 100,
                'igv' => $this->total * $igv / 100,
                'total' => $this->total,

                'formadepago' => $this->formadepago,
                'tipocomprobante_id' => $this->tipocomprobante_id,
            ]);
            //guardamos la table boletas

            $boleta = Boleta::create([
                'serie' => $this->serie,
                'numero' => $this->numero,
                'serienumero' => $this->serie . $this->numero,
                'total' => $this->total,
                'sale_is' => $sale,
            ]);
            //guardamos la table boleta_local_productatribute

            foreach ($this->cart as $item) {
                $pa = Productatribute::where('codigo', $item['id'])->first(); //buscamos el producto en Productatribute
                $lpa = Localproductatribute::where('local_id', Auth::user()->employee->local->id)->where('productatribute_id', $pa->id)->first(); //buscamos el producto en localproductatribute
                Boleta_local_productatribute::create([
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                    'local_productatribute_id' => $lpa->id,
                    'boleta_id' => $boleta->id,
                ]);

                //quitamos el stock
                $lpa->stock = $lpa->stock - $item['quantity'];
                $lpa->save();
            }



            DB::commit();
            $this->clearCart();
            //falta restar el stock

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return redirect()->route('admin.sale.index');
    }







    public function getTotal()
    {
        $this->total = 0;

        if ($this->cart) {
            foreach ($this->cart as $product) {
                $this->total += $product['price'] * $product['quantity'];
            }
        }

        return $this->total;
    }


    public function getTotaldos()
    {
        $this->totaldos = 0;

        if ($this->cartdos) {
            foreach ($this->cartdos as $product) {
                $this->totaldos += $product['price'] * $product['quantity'];
            }
        }

        return $this->totaldos;
    }





    public function ScanCode($barcode,  $quantity = 1)
    {
        $this->search = $barcode;


        //buscamos el producto en Localproductatribute
        $local_productatribute = Localproductatribute::with('productatribute')
            ->where('local_id', Auth()->user()->employee->local->id)
            ->whereHas('productatribute', function ($query) {
                $query->where('codigo', $this->search);
            })->first();

        //dd($local_productatribute->productatribute->codigo);


        if ($local_productatribute == null || empty($local_productatribute)) {
            $this->mensaje = 'El producto no está registrado';
            //$this->emit('alert', $this->mensaje);
            //$title = 'El producto no está registrado';
        } elseif ($local_productatribute->productatribute->pricesale === null) {
            $this->mensaje = 'El producto no tiene precio';
            // $this->emit('alert', $this->mensaje);
        } else {

            $this->addToCart(
                $local_productatribute->productatribute->codigo,
                $local_productatribute->productatribute->slug,
                $local_productatribute->productatribute->pricesale,
                $quantity
            );
            $this->total = $this->getTotal();
        }
    }



    public function ScanCodedos($barcode,  $quantity = 1)
    {
        $this->search = $barcode;


        //buscamos el producto en Localproductatribute
        $local_productatribute = Localproductatribute::with('productatribute')
            ->where('local_id', Auth()->user()->employee->local->id)
            ->whereHas('productatribute', function ($query) {
                $query->where('codigo', $this->search);
            })->first();

        //dd($local_productatribute->productatribute->codigo);


        if ($local_productatribute == null || empty($local_productatribute)) {
            $this->mensaje = 'El producto no está registrado';
            //$this->emit('alert', $this->mensaje);
            //$title = 'El producto no está registrado';
        } elseif ($local_productatribute->productatribute->pricesale === null) {
            $this->mensaje = 'El producto no tiene precio';
            // $this->emit('alert', $this->mensaje);
        } else {

            $this->addToCartdos(
                $local_productatribute->productatribute->codigo,
                $local_productatribute->productatribute->slug,
                $local_productatribute->productatribute->pricesale,
                $quantity
            );
            $this->totaldos = $this->getTotaldos();
        }
    }



    public function removeFromCart($productId)
    {
        if ($this->cart->has($productId)) {
            $this->cart->forget($productId);
            session()->put('cart', $this->cart);
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        if ($this->cart->has($productId)) {
            $product = $this->cart->get($productId);
            $product['quantity'] = $quantity;
            $this->cart->put($productId, $product);
            session()->put('cart', $this->cart);
        }
    }

    public function updatePrice($product, $price, $cant)
    {
        //$title = '';

        //dd($price);

        $product = Productatribute::where('codigo', $product)->first();

        //$product = Product::find($product, ['codigobarras']);
        //dd($product );
        $exist = Cart::get($product->codigo);
        if ($exist) {
            $this->removeItem($product->codigo);
        }

        if ($price > 0 and $cant > 0) {
            Cart::add($product->codigo, $product->slug, $price, $cant, $product->id);
            $this->total = Cart::getTotal();
            // $this->itemsQuantity = Cart::getTotalQuantity();

            // $this->emit('scan-ok', $title);

        }
    }




    public function clearCart()
    {
        session()->forget('cart');
        $this->cart = new Collection();
    }

    /*     public function updated($propertyName)
    {
        if ($propertyName === 'cart') {
            $this->emit('cartUpdated');
        }
    } */

    /*     public function updatedCart()
    {
        $this->emit('cartUpdated');
    }
 */

    public function render()
    {
        //$cart = Cart::getContent()->sortBy('name');
        $cart = $this->cart;
        $cartdos = $this->cartdos;
        //$total = $this->total;
        $customers = Customer::all();
        $currencies = Currency::all();
        $tipocomprobantes = Tipocomprobante::all();
        $this->total = $this->getTotal();
        $this->totaldos = $this->getTotaldos();



        return view('livewire.admin.sale-create', compact('customers', 'currencies', 'tipocomprobantes', 'cart', 'cartdos'));
    }
}
