<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Modelo;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Productfamilie;

class ProductfamilieCreate extends Component
{
    public $open = false;



    public $categories=[], $subcategories=[], $modelos = [], $brands = [];
    public $categoryy="";
    public $prod_servicio="", $subcategory_id, $category_id,  $brand_id, $modelo_id,  $gender="", $simplecompound="", $haveserialnumber=0;
    public $name, $slug, $description, $price, $quantity;


    protected $rules = [
        'prod_servicio' => 'required',
        'category_id' => 'required',
        'brand_id' => 'required',
        'modelo_id' => 'required',
        'gender' => 'required',
        //'simplecompound'=>'required',
        'subcategory_id' => 'required',

    ];



    public function mount(){

        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->modelos = Modelo::all();
        $this->subcategories = [];
        //$this->categoryy="";

        $this->category_id="";

    }


    public function cancelu(){

        $this->category_id = 0;
       // $this->reset(['open','prod_servicio','category_id','brand_id','modelo_id', 'gender', 'simplecompound', 'haveserialnumber']);
       $this->open = false;
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
        $categories = Category::all();
        //$subcategoriesss = Subcategory::where('category_id', $this->category_id)->get();
        $subcategoriesss = $this->subcategories;
        $brands = Brand::all();
        $modelos = Modelo::all();
        return view('livewire.admin.productfamilie-create', compact('categories', 'brands', 'modelos', 'subcategoriesss'));
    }

    public function save(){
        $this->validate();

       // Productfamilie::


        $product = new Productfamilie();

        $product->simplecompound = $this->simplecompound;
        $product->tipo = $this->prod_servicio;
        $product->haveserialnumber = $this->haveserialnumber;
        $product->gender = $this->gender;

        $categoriasel = Category::find($this->category_id);
       // dd($categoriasel);
        if($categoriasel){
            $product->category_id = $categoriasel->id;
            $categorianame = $categoriasel->name;
        }
        else {
            $newcategory = Category::create(['name'=>$this->category_id]);
            $product->category_id = $newcategory->id;
            $categorianame = $newcategory->name;
        }
        //->first()? $cat : Category::create(['name'=>$cat]);
        //dd($categorianame );

        //$categorianame = $categoriasel->name;

        $modelosel = Modelo::find($this->modelo_id);
       // dd($categoriasel);
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

        $product->name = $categorianame." ".$modeloname." ".$brandname;

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
