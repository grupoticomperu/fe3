<?php

namespace App\Http\Livewire\Admin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Currency;
use App\Models\Local_tipocomprobante;
use App\Models\Tipocomprobante;
use Darryldecode\Cart\Facades\CartFacade as Cart;
//use App\Traits\CartTrait;
use App\Models\Product;
use App\Models\Comprobante;


    class ComprobanteSave extends Component
{
        // use CartTrait;
        public $search;
        public $total;
        public $mensaje;
        public $tipocomprobante_id;
        public $serie, $numero;
        public $customer_id;
        public $numdoc;
        public $itemsQuantity;


        //public $default;

        public function mount()
        {
                $ltc = Local_tipocomprobante::where('local_id', Auth::user()->local->id )
                                                ->where('default',1)->get();

                $this->tipocomprobante_id = $ltc[0]['tipocomprobante_id'];//obtienen el tipo de comprobante
                $this->serie = $ltc[0]['serie'];//obtienen la serie


               // $this->$default = $ltc[0]['default'];
                $this->total  = Cart::getTotal();//inicializxa el total del comprobante
                //$this->itemsQuantity = Cart::getTotalQuantity();
               // $consulta = Comprobante::select("numero")->latest()->first();
                $consulta = Comprobante::where('local_id', Auth::user()->local->id)
                                        ->where('tipocomprobante_id', $this->tipocomprobante_id )->first();//
                //dd($consulta);
               // $this->numero = Comprobante::all();
               if(isset($consulta))//isset comprueba que consulta este definita osea consulta no es null
                    $this->numero = $consulta->numero +1;
               else//cuando isset es null
                    $this->numero = 1;

        }

/*         public function comprobante(){
                $this->numero = Comprobante::select("id")->latest()->first();
                //dd($ultimo);
        } */


        public function updatedTipocomprobanteId($value){
                $seriee = Local_tipocomprobante::where('tipocomprobante_id',$value)
                                                     ->where('local_id', Auth::user()->local->id)->get();

               // $this->serie = $seriee;
                //$namee = $seriee[0][1];
                $this->serie = $seriee[0]['serie'];


                $consulta = Comprobante::where('local_id', Auth::user()->local->id)
                                         ->where('tipocomprobante_id', $this->tipocomprobante_id )->first();

                $this->numero = $consulta->numero +1;

        }


        public function updatedCustomerId($value){
                $numdocc = Customer::where('id', $value)->first();

                /* dd($numdocc->numdoc);         */
                $this->numdoc = $numdocc->numdoc;

        }


        // vaciar carrito
        public function limpiar()
        {
                Cart::clear();
                $this->total = Cart::getTotal();
        }



        public function render()
        {
                $cart = Cart::getContent()->sortBy('name');
                $customers =  Customer::all();
                $currencies =  Currency::all();
                $tipocomprobantes = Tipocomprobante::all();
                return view('livewire.admin.comprobante-save', compact('customers', 'currencies', 'tipocomprobantes', 'cart'));
        }

        /*         public function getResultsProperty(){
                return Customer::where('nomrazonsocial', 'LIKE', '%'. $this->search .'%')->take(8)->get();
        } */

        /*         public function agregar($valor){
                $this->search = $valor;
        } */

        // buscar y agregar producto por escaner y/o manual
        public function ScanCode($barcode,  $cant = 1)
        {
                //$this->ScanearCode($barcode, $cant);
                $product = Product::where('codigobarras', $barcode)->first();

                if ($product == null || empty($product)) {
                        $this->mensaje = 'El producto no está registrado';
                } else {

                        if ($this->InCart($product->codigobarras)) {
                                $this->IncreaseQuantity($product, $cant = 1);
                                return;
                        }


                        Cart::add($product->codigobarras, $product->name, $product->saleprice, $cant, $product->image);
                        //Cart::add($product->id, $product->name, $product->saleprice, $cant, $product->image);
                        $this->total = Cart::getTotal();
                        // $this->itemsQuantity = Cart::getTotalQuantity();

                }
        }

        public function InCart($productId)
        {
                $exist = Cart::get($productId);
                if ($exist)
                        return true;
                else
                        return false;
        }


        public function IncreaseQuantity($product, $cant = 1)
        {
                $title = '';

                $exist = Cart::get($product->codigobarras);//exist es el carrito
                //dd($exist->price);
                if ($exist)
                       // $title = 'Cantidad actualizada*';
                        $price = $exist->price;//price es la columna del carrito
                else
                       // $title = 'Producto agregado*';
                       $price = $product->saleprice;


            //importante si el producto ya existe el add adiciona un producto
                Cart::add($product->codigobarras, $product->name, $price, $cant, $product->image);

                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();

                $this->emit('scan-ok', $title);
        }


        // incrementar cantidad item en carrito
        /* 	public function increaseQty(Product $product, $cant = 1)
	{
		$this->IncreaseQuantity($product, $cant);
	} */


        public function removeItem($productId)
        {
                Cart::remove($productId);

                $this->total = Cart::getTotal();
                // $this->itemsQuantity = Cart::getTotalQuantity();

                // $this->emit('scan-ok', 'Producto eliminado*');
        }


        // actualizar cantidad item en carrito
        public function updateQty($product, $price, $cant = 1)
        {
                //dd($product);
                if ($cant <= 0)
                        $this->removeItem($product);
                else
                        $this->updateQuantity($product, $price, $cant);
        }


        public function updateQuantity($product, $price, $cant = 1)
        {
                $title = '';

                $product = Product::where('codigobarras', $product)->first();
                //$product = Product::find($product, ['codigobarras']);
                //dd($product );
                $exist = Cart::get($product->codigobarras);
                if ($exist) {
                        $this->removeItem($product->codigobarras);
                }

                if ($price > 0 and $cant > 0) {
                        Cart::add($product->codigobarras, $product->name, $price, $cant, $product->image);
                        $this->total = Cart::getTotal();
                        // $this->itemsQuantity = Cart::getTotalQuantity();

                        // $this->emit('scan-ok', $title);

                }
        }

        public function updatePrice($product, $price, $cant)
        {
                $title = '';

                $product = Product::where('codigobarras', $product)->first();
                //$product = Product::find($product, ['codigobarras']);
                //dd($product );
                $exist = Cart::get($product->codigobarras);
                if ($exist) {
                        $this->removeItem($product->codigobarras);
                }

                if ($price > 0 and $cant > 0) {
                        Cart::add($product->codigobarras, $product->name, $price, $cant, $product->image);
                        $this->total = Cart::getTotal();
                        // $this->itemsQuantity = Cart::getTotalQuantity();

                        // $this->emit('scan-ok', $title);

                }
        }
}
