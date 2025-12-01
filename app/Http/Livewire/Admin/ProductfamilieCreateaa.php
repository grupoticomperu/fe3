<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Modelo;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Productfamilie;

class ProductfamilieCreateaa extends Component
{

    public $modelos = [], $brands = [];
    public $category;
    public  $subcategories=[];
    public $prod_servicio="", $subcategory_id="", $category_id="",  $brand_id="", $modelo_id="",  $gender="", $haveserialnumber=0;
    public $name, $slug, $description, $price, $quantity;



    protected $rules = [
        'prod_servicio' => 'required',
        //'category_id' => 'required',
        'brand_id' => 'required',
        'modelo_id' => 'required',
        'gender' => 'required',
       // 'simplecompound'=>'required',
        'subcategory_id' => 'required',

    ];



    public function mount(Category $category){
       //dd($category);
        $this->category = $category;
        $this->category_id = $category->id;
        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
        //dd($this->subcategories);
        //$this->subcategories= Subcategory::all();
        $this->brands = Brand::all();
        $this->modelos = Modelo::all();

    }




    public function render()
    {
        //$this->subcategories= Subcategory::all();
        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
       // dd($this->subcategory_id);

        return view('livewire.admin.productfamilie-createaa');
    }



    public function save(){
        $this->validate();

       // Productfamilie::


        $product = new Productfamilie();

        //$product->simplecompound = $this->simplecompound;//si el producto es simple o cimpuesto
        $product->tipo = $this->prod_servicio;//producto terminado, mercaderia o servicio
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
       return redirect()->route('productcompuesto.create', $product);


     }







}
