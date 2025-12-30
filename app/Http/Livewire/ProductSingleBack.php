<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Category;
use App\Models\Productatribute;
use App\Models\Productfamilie;
use Illuminate\Support\Collection;
//use Gloudemans\Shoppingcart\Facades\Cart as Carttx;
//use Darryldecode\Cart\Facades\CartFacade as Cart;


class ProductSingled extends Component
{

    public $productfamilie;
    public $selectedAttributes = [];
    public $tallas=[];
    public $colores=[];
    public $tallas_id="";
    public $colores_id="";
    public $paa=[];
    public $selectedTallas, $selectedColores;
    public $atributes;
    public $price;
    public $stock;
    public $codigo;
    public $carttx;
    public $i=8;
    public $options = [
        'tallas_id' => null,
        'colores_id' => null
    ];

    protected $rules = [
        'tallas_id' => 'required',
        'colores_id' => 'required',
    ];

    //la logica es juntar todas las tallas
    //la logica es juntar todos los colores


/*     public function __construct()
    {
        parent::__construct();
        $this->carttx = session('carttx', new Collection());
    }
 */
    //product en realidad era productfamilie
    public function mount(Productfamilie $product)
    {
        $this->i= $this->i+1;

        $this->carttx = session('carttx', new Collection());//si no existe carttx declara la variable de sesion de tipo coleccion de lo contrario no lo declara

        //$this->tallas_id = "";
        //$this->price = 100;
        $this->productfamilie = $product;//asignamos a productfamilie product(que en relidad es productfamilie)
        //$uniqueAtributes = []; // Para mantener un seguimiento de los valores únicos

        foreach ($this->productfamilie->productatributes as $productatribute) {//productfanilie tiene muchos productatributes
            $i=0;
            foreach ($productatribute->local_productatributes as $lpa) {//relacionamos el productatribute con el local_productatributes para ver stock en el local
                $i=$i+1;
                if ($lpa->local_id == 1 && $lpa->stock) {//verificamos si hay stock en el local 1
                   // $stock[$lpa->productatribute_id] = $lpa->stock;

                    $pa = Productatribute::find($lpa->productatribute_id);//pa obtiene un registro de productatribute

                    foreach ($pa->atribute_productatributes as $atribute_productatribute) {//en esta parte estan las tallas colores volumenes, etc
                        $groupAtributeId = $atribute_productatribute->atribute->groupatribute->id;//se obtienen el codigo del grupoatributo
                        $groupAtributeName = $atribute_productatribute->atribute->groupatribute->name;//se obtienen el nombre del grupoatributo
                        $atributeId = $atribute_productatribute->atribute->id;//se obtienen el codigo del atributo
                        $atributeName = $atribute_productatribute->atribute->name;//se obtienen el codigo del atributo
                        //paa producto atribute acumulado es para buscar lo escogido
                        //aqui guardo toda la familia del producto
                        //paa[$pa->id][]  ponemos []  para que no se repita y no chanque la clave principal
                        //si solo pones esto paa[$pa->id]  chanca la clave y muestra datos erroneos
                        //$this->paa[$pa->id][] =[$groupAtributeName,$atributeName,$lpa->stock,$lpa->pricesale];


                        if($groupAtributeName=='Tallas'){//compruebo que $groupAtributeName sea tallas
                            if (!in_array($atributeName, $this->tallas)) {//tallas es un array y comprueba que no exista atributeName, ejemplo S(es atributename) esta en tallas,
                                $this->tallas[$atributeId] = $atributeName;//si S no esta, si no esta lo agrega
                               // $this->paa[$pa->id] =[$groupAtributeName,$atributeName,$lpa->stock,$lpa->pricesale];

                            }
                            $tallaa = $atributeName;//talla acumulada, ponerlo fuera del if porque esto acumula todo, va te tener S.M.L.XL
                        }

                        if($groupAtributeName=='Colores'){
                            if (!in_array($atributeName, $this->colores)) {
                                $this->colores[$atributeId] = $atributeName;
                               // $this->paa[$pa->id] =[$groupAtributeName,$atributeName,$lpa->stock,$lpa->pricesale];

                            }
                            $colora = $atributeName;//color acumulado, ponerlo fuera del if porque esto acumula todo
                        }
                    }

                    $this->paa[] =[$pa->id, $lpa->stock, $lpa->pricesale];

                    //guardamos datos del productatribute id es el codigo, tallaa es la talla que se acumulo
                    //si el producto tienen volumen seria volumena

                }
            }
        }
        dd($this->paa);
        //dd($this->paa[0][1]);//muestra S
        //dd($this->colores_id);
        //dd($this->tallas_id);

        //$this->colores_id="color";
        //$this->tallas_id="talla";
    }

     public function updatedTallasId($value){
        //dd($value);
        $this->options['tallas_id'] = $value;


        if($this->colores && $this->tallas){
            //si escogiste colores, buscamos lo escogido en paa
            foreach ($this->paa as $valuee) {//$key tiene el codigo del producto
                //dd($valuee[2]);
                if($valuee[1]==$value && $valuee[2]==$this->colores_id){
                    $this->price = $valuee[4];
                    $this->stock = $valuee[3];
                    $this->codigo = $valuee[0];
                  /*   $this->tallas_id = $valuee[1];
                    $this->colores_id = $valuee[2]; */

                }

            }

        }

    }


    public function updatedColoresId($value){
        //dd($value);
        $this->options['color_id'] = $value;

        if($this->colores && $this->tallas){
            //si escogiste colores, buscamos lo escogido en paa
            foreach ($this->paa as $valuee) {//$key tiene el codigo del producto
                //dd($valuee[1], $valuee[2], $this->tallas_id, $this->colores_id );
                if($valuee[1]==$this->tallas_id && $valuee[2]==$value){
                    $this->price = $valuee[4];
                    $this->stock = $valuee[3];
                    $this->codigo = $valuee[0];
                   /*  $this->tallas_id = $valuee[1];
                    $this->colores_id = $valuee[2];*/
                }

            }

        }

        //dd($this->price);

    }


/*     public function updatedColoresId($value){
        if($this->colores && $this->tallas){
            //si escogiste colores, buscamos lo escogido en paa
            foreach ($this->paa as $key => $valuee) {//$key tiene el codigo del producto
                if($valuee[0][1]==$value && $valuee[1][1]==$this->colores){
                    $this->price = 180;
                }

            }

        }

    } */



    //public function addToCart($productId, $name, $price, $quantity = 1, $tallas_id, $colores_id)
    public function addToCart($productId, $name, $price, $quantity = 1)
    {
        $this->i= $this->i+1;
        if ($this->carttx) {//cart es una variable tipo sesion
            if ($this->carttx->has($productId)) {
                //dd('existe');
                $product = $this->carttx->get($productId); //Si el producto ya existe en el carrito, esta línea recupera el producto existente del carrito utilizando su $productId
                //con get se busca, get es una propidad de las colecciones
                $product['quantity'] += $quantity;
               // $this->cart->put($productId, $product);
            } else {
                $product = [
                    'id' => $productId,
                    'name' => $name,
                    'price' => $price,
                    'quantity' => $quantity
                  /*   'talla' => $tallas_id,
                    'color' => $colores_id */
                ];

            }

            $this->carttx->put($productId, $product);
            //$this->cart->put($product);
            session(['carttx' => $this->carttx]);
        }
    }




    //Cart::add($this->codigo, $this->productfamilie->name, $this->price, 5, 7);
    public function addItem(){
        //$this->i= $this->i+1;
        //$this->addToCart($this->codigo, $this->productfamilie->slug, $this->price, 5, $this->tallas_id, $this->colores_id);
        $this->addToCart($this->codigo, $this->productfamilie->slug, $this->price, 5);

        //dump($this->carttx);//este dd muestra solo el ultimo
        $this->emitTo('total-product', 'render');
        $this->emitTo('dropdown-cart', 'render');

        //para forzar la actualizacion de la página
        // Luego, utiliza JavaScript para forzar la recarga de la página
        //$this->dispatchBrowserEvent('reloadPage');

    }

    public function clearCart()
    {
        session()->forget('carttx');
        $this->carttx = new Collection();
    }

    public function getTotalProducts()
    {
        $total = 0;

        foreach ($this->carttx as $product) {
            $total += $product['quantity'];
        }

        return $total;
    }


    public function render()
    {
        //dd($this->carttx);
        $carttx = $this->carttx;
        $categories = Category::where('state', 1)->get();
        return view('livewire.product-singled', compact('categories','carttx'))->layout('layouts.appwebd');
    }


}
