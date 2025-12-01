<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Productatribute;
use App\Models\Productfamilie;
use Illuminate\Support\Collection;

class ProductSinglet extends Component
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
    public $talla, $color;//variable para mandar al acarrito e indicar en la descripcion su talla y color del producto
    public $options = [
        'tallas_id' => null,
        'colores_id' => null
    ];

    protected $rules = [
        'tallas_id' => 'required',
        'colores_id' => 'required',
    ];


    protected $listeners = ['render'];

    public function mount(Productfamilie $product)
    {
        //$this->carttx = session('carttx', new Collection());
        $this->carttx = session('carttx', new \Illuminate\Support\Collection());

        //$this->tallas_id = "";
        //$this->price = 100;
        $this->productfamilie = $product;
        //$uniqueAtributes = []; // Para mantener un seguimiento de los valores únicos

        foreach ($this->productfamilie->productatributes as $productatribute) {
            $i=0;
            foreach ($productatribute->local_productatributes as $lpa) {
                $i=$i+1;
                if ($lpa->local_id == 1 && $lpa->stock) {
                   // $stock[$lpa->productatribute_id] = $lpa->stock;

                    $pa = Productatribute::find($lpa->productatribute_id);

                    foreach ($pa->atribute_productatributes as $atribute_productatribute) {
                        $groupAtributeId = $atribute_productatribute->atribute->groupatribute->id;
                        $groupAtributeName = $atribute_productatribute->atribute->groupatribute->name;
                        $atributeId = $atribute_productatribute->atribute->id;
                        $atributeName = $atribute_productatribute->atribute->name;
                        //paa producto atribute acumulado es para buscar lo escogido
                        //aqui guardo toda la familia del producto
                        //paa[$pa->id][]  ponemos []  para que no se repita y no chanque la clave principal
                        //si solo pones esto paa[$pa->id]  chanca la clave y muestra datos erroneos
                        //$this->paa[$pa->id][] =[$groupAtributeName,$atributeName,$lpa->stock,$lpa->pricesale];


                        if($groupAtributeName=='Tallas'){
                            if (!in_array($atributeName, $this->tallas)) {
                                $this->tallas[$atributeId] = $atributeName;
                               // $this->paa[$pa->id] =[$groupAtributeName,$atributeName,$lpa->stock,$lpa->pricesale];

                            }
                            $tallaa = $atributeName;//talla acumulada, ponerlo fuera del if porque esto acumula todo
                        }

                        if($groupAtributeName=='Colores'){
                            if (!in_array($atributeName, $this->colores)) {
                                $this->colores[$atributeId] = $atributeName;
                               // $this->paa[$pa->id] =[$groupAtributeName,$atributeName,$lpa->stock,$lpa->pricesale];

                            }
                            $colora = $atributeName;//color acumulado, ponerlo fuera del if porque esto acumula todo
                        }
                    }

                    $this->paa[] =[$pa->id, $tallaa, $colora, $lpa->stock, $lpa->pricesale];

                    //guardamos datos del productatribute id es el codigo, tallaa es la talla que se acumulo
                    //si el producto tienen volumen seria volumena

                }
            }
        }
        //dd($this->paa);
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
                    $this->price = $valuee[4];//valuee es un registro de paa
                    $this->stock = $valuee[3];
                    $this->codigo = $valuee[0];
                    $this->talla = $valuee[1];
                    $this->color = $valuee[2];
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
                    $this->talla = $valuee[1];
                    $this->color = $valuee[2];
                }

            }

        }

        //dd($this->price);

    }






    public function addToCart($productId, $name,  $talla, $color, $price, $quantity = 1)
    {

        if (!$this->carttx) {
            $this->carttx = new \Illuminate\Support\Collection();
        }
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
                    'talla' => $talla,
                    'color' => $color,
                    'price' => $price,
                    'quantity' => $quantity,
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
        //$this->addToCart($this->codigo, $this->productfamilie->name, $this->price, 5);
        $this->addToCart($this->codigo, $this->productfamilie->name, $this->talla, $this->color, $this->price, 5);

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
        return view('livewire.product-singlet', compact('categories','carttx'))->layout('layouts.appwebt');

    }


}
