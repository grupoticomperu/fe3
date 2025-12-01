<?php

namespace App\Http\Livewire\Admin;

use App\Models\Um;
use App\Models\Brand;

use App\Models\Modelo;
use Livewire\Component;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Tipoafectacion;
use Illuminate\Support\Facades\Storage;


class ProductCreate extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $company;
    public $categories;
    public $lastSelectedParentCategory;
    public $selectedParentCategory1; // Agrega esta propiedad
    public $name, $codigo, $codigobarras, $description;
    public $purchaseprice, $saleprice, $salepricemin, $mtovalorgratuito, $mtovalorunitario, $currency_id = "";
    public $um_id = "", $modelo_id = "", $brand_id = "", $tipoafectacion_id = "";
    public $category_id;
    public $esbolsa, $detraccion, $percepcion, $state;
    public $image1, $image2, $image3, $image4;
    /* public $paranombredecategoria; */
    //public $currencies;

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
        //'company_id'=>'nullable',
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





    public function mount()
    {
        $this->company = auth()->user()->employee->company;

        // Obtener las categorías raíz
        $this->categories = Category::whereNull('parent_id')->where('company_id', $this->company->id)->get()->map(function ($category) {
            $category->depth = $this->calculateDepth($category);
            return $category;
        });

        $this->lastSelectedParentCategory = null;
        $this->selectedParentCategory1 = null;


    }

    protected function calculateDepth($category, $depth = 0)
    {
        if (!$category->parent) {
            return $depth;
        } else {
            return $this->calculateDepth($category->parent, $depth + 1);
        }
    }

    public function updatedSaleprice($value)
    {
        //$this->mtovalorunitario = floatval($this->saleprice)/1.18;
        $this->mtovalorunitario = number_format(floatval($this->saleprice) / 1.18, 2, '.', '');
        $this->category_id = $this->lastSelectedParentCategory;
    }


    public function updatedSelectedParentCategory1($value)
    {
        $this->lastSelectedParentCategory = $value;
        $this->category_id = $this->lastSelectedParentCategory;
         /* $this->paranombredecategoria = Category::find($this->lastSelectedParentCategory); */
    }

    public function categorySelected($value)
    {
        $this->lastSelectedParentCategory = $value;
        $this->category_id = $this->lastSelectedParentCategory;
        /* $this->paranombredecategoria = Category::find($this->lastSelectedParentCategory); */
    }

    public function updateSelectedParentCategory($value)
    {
        // Actualizar la variable lastSelectedParentCategory cuando se seleccione un nuevo radio button
        $this->selectedParentCategory1 = $value;
        //$this->lastSelectedParentCategory = $value;

    }

    public function save()
    {
        //dd($this->lastSelectedParentCategory);
        /* $categoria = Category::find($this->lastSelectedParentCategory);
        $modelo = Modelo::find($this->modelo_id);
        $marca = Brand::find($this->brand_id);

        if($categoria and $modelo and $marca){
            $this->name = $categoria->name ." ". $modelo->name ." ".$marca->name;
        } */


        //dd($this->name);

        //dd($marca->name);
        //dd($modelo->name);
       // dd($categoria->name);
        //$this->authorize('create', new Product);

        // Validación del nombre de la categoría
        /* $this->validate([
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,parent_id,NULL',
        ]); */
        //$categoriespadres = Category::whereNull('parent_id')->get();

        if($this->lastSelectedParentCategory == NULL){
            $this->emit('alert', 'Tienes que escoger una categoria...');
        }

        if($this->image1){
            $rules = $this->rules;
            $rules['image1'] = 'require|image|mimes:jpeg,png|max:2048';
            //$this->validate();
            //$urlimage1 = $this->image1->store('products');
            $urlimage1 = Storage::disk('s3')->put('fe/'.$this->company->razonsocial.'/products', $this->image1 , 'public');
        }
        else {

            //$this->validate();
            $urlimage1 = 'fe/default/products/productdefault.jpg';

        }



        if($this->image2){
            $rules = $this->rules;
            $rules['image2'] = 'require|image|mimes:jpeg,png|max:2048';
            //$this->validate();
            $urlimage2 = Storage::disk('s3')->put('fe/'.$this->company->razonsocial.'/products', $this->image2 , 'public');
        }
        else {
            //$this->validate();

            $urlimage2 = 'fe/default/products/productdefault.jpg';

        }


        if($this->image3){
            $rules = $this->rules;
            $rules['image3'] = 'require|image|mimes:jpeg,png|max:2048';
            //$this->validate();
            $urlimage3 = Storage::disk('s3')->put('fe/'.$this->company->razonsocial.'/products', $this->image3 , 'public');
        }
        else {
            //$this->validate();

            $urlimage3 = 'fe/default/products/productdefault.jpg';

        }


        if($this->image4){
            $rules = $this->rules;
            $rules['image4'] = 'require|image|mimes:jpeg,png|max:2048';
            //$this->validate();
            $urlimage4 = Storage::disk('s3')->put('fe/'.$this->company->razonsocial.'/products', $this->image4 , 'public');
        }
        else {
            //$this->validate();

            $urlimage4 = 'fe/default/products/productdefault.jpg';

        }

        $this->validate();


        // Crear Producto
        Product::create([
            'codigo'=> $this->codigo,
            'codigobarras'=> $this->codigobarras,
            'name' => $this->name,
            'description' => $this->description,
            'purchaseprice' => $this->purchaseprice,
            'saleprice' => $this->saleprice,
            'salepricemin' => $this->salepricemin,
            'mtovalorgratuito' => $this->mtovalorgratuito,
            'mtovalorunitario' => $this->mtovalorunitario,
            'company_id' => $this->company->id,
            'currency_id' => $this->currency_id,
            'um_id' => $this->um_id,
            'modelo_id' => $this->modelo_id,
            'category_id' => $this->lastSelectedParentCategory,
            'brand_id' => $this->brand_id,
            'tipoafectacion_id' => $this->tipoafectacion_id,
            'esbolsa' => $this->esbolsa,
            'detraccion' => $this->detraccion,
            'percepcion' => $this->percepcion,
            'state' => $this->state,
            'image1'=> $urlimage1,
            'image2'=> $urlimage2,
            'image3'=> $urlimage3,
            'image4'=> $urlimage4,
        ]);
        // Limpiar los campos después de la creación
        //$this->name = '';
        //$this->selectedCategory = null;
        $this->emit('alert', 'El Producto se creo correctamente');

        //return view('livewire.admin.category-listd');
        return redirect()->route('product.list');


    }

    public function render()
    {
        $currencies = Currency::all();
        $ums = Um::all();
        $modelos = Modelo::all();
        $brands = Brand::all();
        $tipoafectacions = Tipoafectacion::all();

        return view('livewire.admin.product-create', compact('currencies', 'modelos', 'brands', 'tipoafectacions', 'ums'));
    }
}
