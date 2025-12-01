<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ProductListd extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search, $image, $product, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para controlar el preloader
    public $withcategory;//esta opcion vienen de configuracion 1 es con categoria
    public $category;
    public $selectedproducts = []; //para eliminar en grupo
    public $selectAll = false; //para eliminar en grupo

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];


    public function mount(){

    }

    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }


    /* 'brand.name'=> 'required',Rule::unique('brands')->ignore($this->brand->id) */

/*      protected $rules = [
        'product.name' => 'required',
        'product.image'=>'image',
        'product.state'=>'required',
    ]; */


    public function loadProducts(){
        $this->readyToLoad = true;
    }

    public function render()
    {
        //$this->authorize('view', new Product);
        $companyId = auth()->user()->employee->company->id;

        if ($this->readyToLoad) {
            $products = Product::where('company_id', $companyId)
                ->where('name', 'like', '%' . $this->search . '%')
                ->when($this->state, function ($query) { /* Esta línea utiliza el método when de Laravel para condicionalmente aplicar una cláusula where en la consulta Eloquent. Si $this->state es verdadero (es decir, tiene un valor que se evalúa como verdadero en PHP), entonces se agrega la cláusula where que filtra los registros donde el campo state es igual a 1. */
                    return $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
            //dd($products);
        } else {
            $products = [];
        }


        return view('livewire.admin.product-listd', compact('products'));


    }

    public function order($sort){
        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }

    }





    public function generateReport()
    {

        //return new BrandExport();
    }


    // Método para eliminar marcas seleccionadas
    public function deleteSelected()
    {

    }

    public function delete(Product $product)
    {
        //$this->authorize('delete', $product);
        $product->delete();
    }


    public function activar(Product $product)
    {

        //$this->authorize('update', $this->product);

        $this->product = $product;

        $this->product->update([
            'state' => 1
        ]);
    }

    public function desactivar(Product $product)
    {
        //$this->authorize('update', $this->product); //tenemos que mandar el error a una pagina
        $this->product = $product;

        $this->product->update([
            'state' => 0
        ]);
    }



}
