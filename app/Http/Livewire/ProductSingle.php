<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Category;
use App\Models\Productatribute;
use App\Models\Productfamilie;

class ProductSingle extends Component
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


    protected $rules = [
        'tallas_id' => 'required',
        'colores_id' => 'required',
    ];



    public function mount(Productfamilie $product)
    {

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

        if($this->colores && $this->tallas){
            //si escogiste colores, buscamos lo escogido en paa
            foreach ($this->paa as $valuee) {//$key tiene el codigo del producto
                //dd($valuee[2]);
                if($valuee[1]==$value && $valuee[2]==$this->colores_id){
                    $this->price = $valuee[4];
                    $this->stock = $valuee[3];
                    $this->codigo = $valuee[0];
                }

            }

        }

    }


    public function updatedColoresId($value){
        //dd($value);

        if($this->colores && $this->tallas){
            //si escogiste colores, buscamos lo escogido en paa
            foreach ($this->paa as $valuee) {//$key tiene el codigo del producto
                //dd($valuee[1], $valuee[2], $this->tallas_id, $this->colores_id );
                if($valuee[1]==$this->tallas_id && $valuee[2]==$value){
                    $this->price = $valuee[4];
                    $this->stock = $valuee[3];
                    $this->codigo = $valuee[0];
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




    public function render()
    {
        $categories = Category::where('state', 1)->get();
        return view('livewire.product-single', compact('categories'))->layout('layouts.appweb');
    }
}
