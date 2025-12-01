<?php
namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\Configuration;
use Livewire\WithFileUploads;
use App\Models\Productfamilie;
use App\Models\Productatribute;
use Illuminate\validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductList extends Component
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

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];


    public function mount(){
       // $this->identificador = rand();
       // $this->brand = new Brand();//se hace para inicializar el objeto e indicar que image es
       // $this->image ="";
       // $this->withcategory = Configuration::pluck('withcategory');//es un array y el valor se guarda en this->withcategory[0]
        //if(!$this->withcategory[0]){//esto es sin categoria
        //    $this->category = Category::where('id', 1)->first();
        //}




    }

    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }


/*       'brand.name'=> 'required',Rule::unique('brands')->ignore($this->brand->id) */

     protected $rules = [
        'product.name' => 'required',
        'product.image'=>'image',
        'product.state'=>'required',
    ];


    public function loadProducts(){
        $this->readyToLoad = true;
    }

    public function render()
    {


           //$products=Productatribute::with('productfamilie');
           //dd($products);

/*            if ($this->readyToLoad) {
            //          $products = DB::table('productatributes')
            //        ->join('productfamilies', 'productfamilies.id', '=', 'productatributes.productfamilie_id')
            //           ->join('atribute_productatribute', 'productatributes.id', '=', 'atribute_productatribute.productatribute_id')
            //           ->select('productatributes.*','productfamilies.name')->get();

            //dd($products);


             $products = Productatribute::where('codigo', 'like', '%' .$this->search. '%')
                ->when($this->state, function($query){
                    return $query->where('state',1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

         }else{
            $products =[];

        } */

/*          if ($this->readyToLoad) {
            $products = Productatribute::with('productfamilie')

                    ->where('codigo', 'like', '%' .$this->search. '%')
                     ->orwhere('name', 'like', '%' .$this->search. '%')
                    ->paginate(10);
        }else{
            $products =[];
        } */

        if ($this->readyToLoad) {
            $products = Productatribute::query()
                    ->with('productfamilie')
                    ->when($this->search, function($query){
                        return $query->where('codigo', 'like', '%' .$this->search. '%')
                               ->orWhereHas('productfamilie', function($q){
                                $q->where('name', 'like', '%' .$this->search. '%');
                               });
                    })
                    ->paginate(10);
        }else{
            $products =[];
        }



      /*   $this->products = Productfamilie::addselect([
            'codigo' => Productatribute::select('codigo')->whereColumn('productfamilie_id','productfamilies.id')
        ])->get(); */
       // return $products;


       /** otra forma de hacer consultas pero falla **/
       /* if ($this->readyToLoad) {
            $sql = 'SELECT `productatributes`.`codigo`, `productatributes`.`price`, `productatributes`.`state`, `productfamilies`.`name` FROM `productatributes` LEFT JOIN `productfamilies` ON `productatributes`.`productfamilie_id` = `productfamilies`.`id`;';
            $products = DB::select($sql);
        }else{
            $products =[];
        } */
       //dd($products);
        return view('livewire.admin.product-list', compact('products'));


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


    public function activar(Productfamilie $product){
        $this->product = $product;

        $this->product->update([
            'state' => 1
        ]);
    }

    public function desactivar(Productfamilie $product){
        $this->product = $product;

        $this->product->update([
            'state' => 0
        ]);
    }

    public function delete(Productfamilie $product){
        $product->delete();
    }



/*     public function cancelar(){
        $this->reset('open_edit', 'image');
        $this->identificador = rand();
        //$this->open_edit = false;
    } */






}



