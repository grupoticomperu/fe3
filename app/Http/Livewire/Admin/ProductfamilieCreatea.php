<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class ProductfamilieCreatea extends Component
{

    public $open = false;
    public $category_id="";

    protected $rules = [
        'category_id' => 'required',
    ];

    public function nuevo(){

         $this->open = true;

     }


    public function cancel(){

       $this->category_id = "";
       $this->open = false;
       $this->reset(['open','category_id']);

    }



    public function mount(){

        $this->categories = Category::all();

        $this->category_id="";

    }


    public function render()
    {
        $categories = Category::all();

        return view('livewire.admin.productfamilie-createa', compact('categories'));
    }

    public function save(){
        $this->validate();



/*
        $categoriasel = Category::find($this->category_id);
        //dd($subcategoriasel);
        if($categoriasel){
            $product->subcategory_id = $subcategoriasel->id;
            $subcategorianame = $subcategoriasel->name;
        }
        else {
            $newsubcategory = Subcategory::create(['name'=>$this->subcategory_id, 'category_id'=>$this->category_id]);//se crea la subcategoria, esto cuando usamos select2, subcategoria_id tiene el nombre
            $product->subcategory_id = $newsubcategory->id;//id de la nueva subcategoria
            $subcategorianame = $newsubcategory->name;//nombre de la nueva subcategoria creada
        }
 */

        $categoriasel = Category::find($this->category_id);
        if (!$categoriasel) {
            $newcategory = Category::create(['name'=>$this->category_id]);
            return redirect()->route('productfamilie.createaa', $newcategory);
        }else{
            return redirect()->route('productfamilie.createaa', $categoriasel);
        }

     /**********************solucion usando url amigables************************/
     /**********************debemos activar en la clase Categoria getRouteKeyName slug************************/
        //$category = Category::where('id', $this->category_id)->first();//usar first, all,
        //return redirect()->route('productfamilie.createaa', $category);//parametro de ruta no tiene compact
     /**********************solucion usando url amigables************************/
     /**********************debemos activar en la clase Categoria getRouteKeyName slug************************/






       /**********************solucion usando colecciones************************/
        /**********************hacer esto si no usamos url amigables************************/
        //$category = Category::where('id', $this->category_id)->get();  //nooooooo,  en este caso $category es una coleccion y debe tratarse como array ejemplo $category[0]->slug
        //return redirect()->route('productfamilie.createaa', $category[0]->id);
         /**********************hacer esto si no usamos url amigables************************/
        /**********************solucion usando colecciones************************/



        /**********************hacer esto si no usamos url amigables************************/
        //$category = $this->category_id;//$category toma el valor del select puede ser 1, 2, 3
        //return redirect()->route('productfamilie.createaa', $category);//en este caso en el url viaja un numero el id
        /***********************hacer esto si no usamos url amigables***********************/

    }


}
