<?php
namespace App\Http\Livewire\Admin;

use App\Models\Configuration;
use Livewire\Component;
use App\Models\Currency;
use App\Models\Shopping;
use App\Models\Supplier;
use App\Models\Productatribute;
use App\Models\Tipocomprobante;
use App\Models\Localproductatribute;
use Illuminate\Support\Facades\Auth;
use App\Models\Productatribute_shopping;
use Darryldecode\Cart\Facades\CartFacade as Cart;

use Illuminate\Support\Facades\DB;
//use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCreate extends Component
{

    public $mensaje;
    public $itemsQuantity;
    public $supplier_id="", $fechaemision, $fechavencimiento, $formadepago="", $tipocomprobante_id="", $serienumero, $currency_id="";
    public $photo, $nota, $subtotal, $igv, $total, $tipodecambio_id;



    protected $rules = [
        'supplier_id'=> 'required',
        'fechaemision'=> 'required',
        'formadepago'=> 'required',
        'tipocomprobante_id'=> 'required',
        'serienumero'=> 'required',
        'currency_id'=> 'required',
        'total'=> 'required'
    ];



    public function mount()
    {
        //$this->total  = Cart::instance('compras')->getTotal(); //inicializxa el total del comprobante
    }


    // buscar y agregar producto por escaner y/o manual
    public function ScanCode($barcode,  $cant = 1)
    {
        //$this->ScanearCode($barcode, $cant);
        $product = Productatribute::where('codigo', $barcode)->first();
        //dd($product);
        //if ($product == null || empty($product))
        if ($product == null || empty($product)) {
            $this->mensaje = 'El producto no está registrado';
            //$this->emit('alert', $this->mensaje);
            //$title = 'El producto no está registrado';
        } elseif ($product->pricesale === null) {
            $this->mensaje = 'El producto no tiene precio';
           // $this->emit('alert', $this->mensaje);
        } else {

            if ($this->InCart($product->codigo)) {
                $this->IncreaseQuantity($product, $cant = 1);
                return;
            }

            //ingresamos al producto nuevo
            Cart::add($product->codigo, $product->slug, $product->pricesale, $cant, $product->id);
            //$this->mensaje = 'Producto agregado';
            //Cart::add($product->id, $product->name, $product->saleprice, $cant, $product->image);
            $this->total = Cart::getTotal();
            // $this->itemsQuantity = Cart::getTotalQuantity();
           // $this->emit('alert', $this->mensaje);
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
        //$title = '';

        $exist = Cart::get($product->codigo); //exist es el carrito
        //dd($exist->price);
        if ($exist) {
            $this->mensaje = 'Cantidad actualizada';
            $price = $exist->price; //price es la columna del carrito
        } else {
            //$title = 'Producto agregado';
            $price = $product->pricesale;
        }


        //importante si el producto ya existe el add adiciona un producto no es necesario poner cant = cant +1
        Cart::add($product->codigo, $product->slug, $price, $cant, $product->id);
        //$title = 'producto agregado';
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('alert', $this->mensaje);
    }




    public function render()
    {

        $cart = Cart::getContent()->sortBy('name');
        $suppliers = Supplier::all();
        $currencies = Currency::all();
        $tipocomprobantes = Tipocomprobante::all();
        $this->total  = Cart::getTotal();
        return view('livewire.admin.shopping-create', compact('suppliers', 'currencies', 'tipocomprobantes', 'cart'));
    }

    // vaciar carrito
    public function limpiar()
    {
        Cart::clear();
        $this->total = Cart::getTotal();
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


    public function removeItem($product)
    {
            Cart::remove($product);

            $this->total = Cart::getTotal();
            // $this->itemsQuantity = Cart::getTotalQuantity();

            // $this->emit('scan-ok', 'Producto eliminado*');
    }



    public function updateQuantity($product, $price, $cant = 1)
    {
        //$title = '';

        $product = Productatribute::where('codigo', $product)->first();

        //dd( $product );
        $exist = Cart::get($product->codigo);
        if ($exist) {
            $this->removeItem($product->codigo);
        }

        if ($price > 0 and $cant > 0) {
            //$product->images->url
            Cart::add($product->codigo, $product->slug, $price, $cant, $product->id);
            $this->total = Cart::getTotal();
            // $this->itemsQuantity = Cart::getTotalQuantity();

            // $this->emit('scan-ok', $title);

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


    public function save()
    {
        //validamos los datos cabecera y detalle
        $configuration = Configuration::first();
        $igv = $configuration->igv;

        $this->validate();
        DB::beginTransaction();

        try {
            //guardamos la cabecera
            $shopping = Shopping::create([
                'supplier_id' => $this->supplier_id,
                'fechaemision' => $this->fechaemision,
                'fechavencimiento' => $this->fechavencimiento,
                'formadepago' => $this->formadepago,
                'tipocomprobante_id' => $this->tipocomprobante_id,
                'serienumero' => $this->serienumero,
                'currency_id' => $this->currency_id,
                'nota' => $this->nota,
                'total' => $this->total,
                'igv'=> $this->total*$igv/100,
                'subtotal' => $this->total - $this->total*$igv/100,
            ]);


            //guardamos el detalle

            if($shopping)
            {
                $items = Cart::getContent();
                foreach ($items as  $item) {
                    Productatribute_shopping::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'productatribute_id' => $item->attributes[0],
                        'shopping_id' => $shopping->id,
                    ]);

                    //actualizamos el stock em local_productatributes
                    $localproductatribute = Localproductatribute::where('local_id', Auth::user()->employee->local->id)->where('productatribute_id', $item->attributes[0])->first();
                    //dd($localproductatribute);
                    $localproductatribute->stock = $localproductatribute->stock + $item->quantity;
                    $localproductatribute->save();
                }

            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }


        return redirect()->route('admin.shopping.index');

    }



    protected $listeners = ['fechaSeleccionada' => 'actualizarFechaEmision'];

    public function actualizarFechaEmision($selectedDate)
    {
        $this->fechaemision = $selectedDate;
    }

}
