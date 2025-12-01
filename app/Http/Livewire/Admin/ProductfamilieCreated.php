<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;

use App\Models\Modelo;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Configuration;
use App\Models\Productfamilie;
use Illuminate\Database\Eloquent\Builder;

class ProductfamilieCreated extends Component
{

    public $open = false;



    public $categories=[], $subcategories=[], $modelos = [], $brands = [];
    public $categoryy="";
    public $prod_servicio="", $subcategory_id="", $category_id="",  $brand_id="", $modelo_id="",  $gender="", $simplecompound="", $haveserialnumber=0;
    public $name, $slug, $description, $price, $quantity;
    public $withcategory;//esta opcion vienen de configuracion 1 es con categoria


    protected $rules = [
        'prod_servicio' => 'required',
        'category_id' => 'required',
        'brand_id' => 'required',
        'modelo_id' => 'required',
        'gender' => 'required',
       // 'simplecompound'=>'required',
        'subcategory_id' => 'required',

    ];



    public function mount(){

       // $this->withcategory = Configuration::pluck('withcategory');//es un array y el valor se guarda en this->withcategory[0]
       //// if(!$this->withcategory[0]){//esto es sin categoria
       //     $this->categories = Category::where('id', 1)->first();
      //      $this->category_id = 1;
      //      $this->subcategories = Subcategory::where('category_id', 1)->get();
      //  }else{
            //$this->categories = Category::all();
            $this->categories = Category::pluck('name','id');
     //   }




       // $this->brands = Brand::all();
       // $this->brands= Brand::pluck('name','id');
       /// $this->modelos = Modelo::all();
       $this->modelos = Modelo::pluck('name','id');

        $this->subcategories = [];
        $this->brands = [];
        //$this->categoryy="";

        //$this->category_id=0;
       // $this->subcategory_id=0;

    }




    public function cancel(){

        $this->category_id = 0;
       // $this->reset(['open','prod_servicio','category_id','brand_id','modelo_id', 'gender', 'simplecompound', 'haveserialnumber']);
       $this->open = false;
    }


    public function nuevo(){
       // $this->identificador=rand();
        $this->open = true;
       // $this->reset(['image']);

    }





    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get();

         $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value){
            $query->where('category_id', $value);
        })->get();

        $this->reset(['subcategory_id']);
    }



    public function render()
    {

        $this->withcategory = Configuration::pluck('withcategory');//es un array y el valor se guarda en this->withcategory[0]
        if(!$this->withcategory[0]){//esto es sin categoria
            $this->categories = Category::where('id', 1)->first();
            $this->category_id=1;
            $this->subcategories = Subcategory::where('category_id', 1)->get();
        }else{
            //$this->categories = Category::all();
            $this->categories = Category::pluck('name','id');
        }


       // $categories = Category::all();
       //$categories = $this->categories;
       // $subcategories = Subcategory::where('category_id', $this->category_id)->get();
        //$brands = Brand::all();
        //$brands = Brand::select('id','name')->get();
        //$brands= Brand::pluck('name','id');

        //$modelos = Modelo::all();
       // return view('livewire.admin.productfamilie-created', compact('categories', 'brands', 'modelos'));

       return view('livewire.admin.productfamilie-created');
    }

    public function save(){
        $this->validate();

       // Productfamilie::


        $product = new Productfamilie();

        //$product->simplecompound = $this->simplecompound;//si el producto es simple o cimpuesto
        $product->tipo = $this->prod_servicio;//producto o servicio
        $product->haveserialnumber = $this->haveserialnumber;//para indicar si el producto tiene numero de serie
        $product->gender = $this->gender;//genero varon, mujer o unisex

        $subcategoriasel = Subcategory::find($this->subcategory_id);
        //dd($subcategoriasel);
        if($subcategoriasel){
            $product->subcategory_id = $subcategoriasel->id;
            $subcategorianame = $subcategoriasel->name;
        }
        else {
            $newsubcategory = Subcategory::create(['name'=>$this->subcategory_id, 'category_id'=>$this->category_id]);//se crea la subcategoria, esto cuando usamos select2, subcategoria_id tiene el nombre
            $product->subcategory_id = $newsubcategory->id;//id de la nueva subcategoria
            $subcategorianame = $newsubcategory->name;//nombre de la nueva subcategoria creada
        }
        //->first()? $cat : Category::create(['name'=>$cat]);
        //dd($categorianame );

        //$categorianame = $subcategoriasel->name;

        $modelosel = Modelo::find($this->modelo_id);
       // dd($subcategoriasel);
        if($modelosel){
            $product->modelo_id = $modelosel->id;
            $modeloname = $modelosel->name;
        }
        else {
            $newmodelo = Modelo::create(['name'=>$this->modelo_id]);
            $product->modelo_id = $newmodelo->id;
            $modeloname = $newmodelo->name;
        }



        $brandsel = Brand::find($this->brand_id);
       // dd($categoriasel);
        if($brandsel){
            $product->brand_id = $brandsel->id;
            $brandname = $brandsel->name;
        }
        else {
            $newbrand = Brand::create(['name'=>$this->brand_id]);
            $product->brand_id = $newbrand->id;
            $brandname = $newbrand->name;
        }



/*
        $modelosel = Modelo::find($mod= $this->modelo_id)? $mod : Modelo::create(['name'=>$mod]);
        $modeloname = $modelosel->name;
        $product->modelo_id = $modelosel->id; */

/*         $brandsel = Brand::find($bran = $this->brand_id)? $bran : Brand::create(['name'=>$bran]);
        $brandname = $brandsel->name;
        $product->brand_id = $brandsel->id; */

        $product->name = $subcategorianame." ".$modeloname." ".$brandname;

        $prodcreado = $product->save();

       // dd($product);
        //$name =
        // $this->identificador=rand();
        // $this->open = true;
        // $this->reset(['image']);
       // $this->open = false;
       // return view('livewire.admin.productcompuesto-create');

       //$var= session()->put('lang', 'es');
       //$valor_almacenado = session('idCarrito');
       session(['idCarrito' => '123456']);
       return redirect()->route('productcompuesto.create', $product);


     }



}
