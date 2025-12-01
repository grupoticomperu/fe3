<?php

namespace App\Http\Livewire\Admin;

use App\Models\Um;
use App\Models\Brand;
use App\Models\Modelo;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Tipoafectacion;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;


class ProductEdit extends Component
{
    use WithFileUploads;
    public $productId;
    public $categories;
    public $selectedParentCategory1;
    public $company;
    public $lastSelectedParentCategory;
    public $product;
    public $name, $codigo, $codigobarras, $description;
    public $purchaseprice, $saleprice, $salepricemin, $mtovalorgratuito, $mtovalorunitario, $currency_id = "";
    public $um_id = "", $modelo_id = "", $brand_id = "", $tipoafectacion_id = "";
    public $category_id;
    public $esbolsa, $detraccion, $percepcion, $state;
    public $image1, $image2, $image3, $image4, $image1back, $image2back, $image3back, $image4back;
    public $breadcrumbs;

    public function mount($productId)
    {
        $this->product = Product::find($productId); //actualizaremos este producto
        $this->productId = $productId;

        //dd($this->product->modelo_id);

        $this->company = auth()->user()->employee->company;
        //dd($this->company);
        // Obtener las categorías raíz
        $this->categories = Category::whereNull('parent_id')->where('company_id', $this->company->id)->get()->map(function ($category) {
            $category->depth = $this->calculateDepth($category);
            return $category;
        });

        $this->lastSelectedParentCategory = $this->product->category_id; //es id de la categoria esgogida
        //dd($this->lastSelectedParentCategory);
        $this->selectedParentCategory1 = $this->product->category_id;


        $this->name = $this->product->name;
        $this->codigo = $this->product->codigo;
        $this->codigobarras = $this->product->codigobarras;
        $this->description = $this->product->description;
        $this->purchaseprice = $this->product->purchaseprice;
        $this->saleprice = $this->product->saleprice;
        $this->salepricemin = $this->product->salepricemin;
        $this->mtovalorgratuito = $this->product->mtovalorgratuito;
        $this->mtovalorunitario = $this->product->mtovalorunitario;

        if($this->product->currency_id == null){
            $this->currency_id = "";
        }else{
            $this->currency_id = $this->product->currency_id;
        }

        if($this->product->um_id == null){
            $this->um_id = "";
        }else{
            $this->um_id = $this->product->um_id;
        }


        if($this->product->modelo_id == null){
            $this->modelo_id = "";
        }else{
            $this->modelo_id = $this->product->modelo_id;
        }

        if($this->product->brand_id == null){
            $this->brand_id = "";
        }else{
            $this->brand_id = $this->product->brand_id;
        }

        $this->tipoafectacion_id = $this->product->tipoafectacion_id;
        $this->category_id = $this->product->category_id;
        $this->esbolsa = $this->product->esbolsa;
        $this->detraccion = $this->product->detraccion;
        $this->percepcion = $this->product->percepcion;
        $this->state = $this->product->state;

        $this->image1 = null;
        $this->image1back = $this->product->image1;

        $this->image2 = null;
        $this->image2back = $this->product->image2;

        $this->image3 = null;
        $this->image3back = $this->product->image3;

        $this->image4 = null;
        $this->image4back = $this->product->image4;

    }


    protected $listeners = ['categorySelected', 'updateSelectedParentCategory'];

    protected $rules = [
        'name'=> 'required',
        'codigo'=>'nullable',
        'codigobarras'=>'required',
        'description'=> 'nullable',
        'purchaseprice'=> 'nullable',
        'saleprice'=> 'required',
        'salepricemin'=>'nullable',
        'mtovalorgratuito'=>'nullable',
        'mtovalorunitario'=>'nullable',
        'currency_id'=>'required',
        'um_id'=>'required',
        'modelo_id'=>'required',
        'category_id'=>'required',
        'brand_id'=>'required',
        'tipoafectacion_id'=>'required',
        'esbolsa'=>'nullable',
        'detraccion'=>'nullable',
        'percepcion'=>'nullable',
        'state'=>'nullable',
        'image1'=> 'nullable',
        'image2'=>'nullable',
        'image3'=> 'nullable',
        'image4'=> 'nullable',
    ];






    protected function calculateDepth($category, $depth = 0)
    {
        if (!$category->parent) {
            return $depth;
        } else {
            return $this->calculateDepth($category->parent, $depth + 1);
        }
    }



    public function save()
    {

        $this->product->name = $this->name;
        $this->product->codigo = $this->codigo;
        $this->product->codigobarras = $this->codigobarras;
        $this->product->description = $this->description;
        $this->product->purchaseprice = $this->purchaseprice;
        $this->product->saleprice = $this->saleprice;
        $this->product->salepricemin = $this->salepricemin;
        $this->product->mtovalorgratuito = $this->mtovalorgratuito;
        $this->product->mtovalorunitario = $this->mtovalorunitario;
        $this->product->currency_id = $this->currency_id;
        $this->product->um_id = $this->um_id;
        if($this->modelo_id==""){//"" es diferente de null
            $this->product->modelo_id = null;
        }else{
            $this->product->modelo_id = $this->modelo_id;
        }

        $this->product->brand_id = $this->brand_id;
        $this->product->tipoafectacion_id = $this->tipoafectacion_id;
        $this->product->category_id = $this->category_id;
        $this->product->esbolsa = $this->esbolsa;
        $this->product->detraccion = $this->detraccion;
        $this->product->percepcion = $this->percepcion;
        $this->product->state = $this->state;
        $this->product->category_id = $this->lastSelectedParentCategory;

        //$this->category->parent_id = $this->selectedParentCategory1 ?? null;
        //dd($this->image1);
        if($this->image1){
            // $rules['image1'] ='required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
             //$this->validate($rules);
            $this->product->image1 = Storage::disk('s3')->put('fe/'.$this->company->id.'/products', $this->image1 , 'public');

            //$this->category->image = Storage::disk('s3')->put('fe/'.$this->company->id.'/categories', $this->image , 'public');


         }else{
            $this->product->image1 = $this->image1back;
         }

        //dd($this->category->parent_id);

        //dd($this->product->image1);

        $this->product->save();

        $this->emit('alert', 'El producto se Modifico correctamente');
        return redirect()->route('product.list');


    }



    public function updatedSelectedParentCategory1($value)
    {
        $this->lastSelectedParentCategory = $value;
        $this->category_id = $this->lastSelectedParentCategory;
    }

    public function updateSelectedParentCategory($value)
    {
        // Actualizar la variable lastSelectedParentCategory cuando se seleccione un nuevo radio button
        $this->selectedParentCategory1 = $value;
        //$this->lastSelectedParentCategory = $value;

    }



    public function categorySelected($value)
    {
        $this->lastSelectedParentCategory = $value;
        $this->category_id = $this->lastSelectedParentCategory;
    }






    public function render()
    {


        if ($this->lastSelectedParentCategory != 9999) {
            if($this->lastSelectedParentCategory){
                $categoryreference = Category::find($this->lastSelectedParentCategory);
                $this->breadcrumbs = $categoryreference->path;//path es el campo guardado en la tabla
            }else{
                $this->breadcrumbs ="";
            }
        } else {
            $this->breadcrumbs = '/';
        }


        $currencies = Currency::all();
        $ums = Um::all();
        $modelos = Modelo::all();
        $brands = Brand::all();
        $tipoafectacions = Tipoafectacion::all();

        return view('livewire.admin.product-edit', compact('currencies', 'modelos', 'brands', 'tipoafectacions', 'ums'));
    }
}
