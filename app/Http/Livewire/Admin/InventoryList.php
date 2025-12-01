<?php

namespace App\Http\Livewire\Admin;

use App\Models\Initialinventory;
use App\Models\Initialinventory_productatribute;
use App\Models\Localproductatribute;
use Livewire\Component;
use Livewire\WithPagination;

use Livewire\WithFileUploads;
use App\Models\Productatribute;
use Doctrine\DBAL\Driver\Mysqli\Initializer;
use Illuminate\Support\Facades\Auth;
use Illuminate\validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;


class InventoryList extends Component
{

    public $mensaje;
    use WithPagination;
    use WithFileUploads;
    public $search, $image, $brand, $state;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $open_edit = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $total;
    public $stateinventory;
    public $initialinventory;
    public $mensajedeestado;
    public $local_id;

    protected $listeners = ['render', 'delete', 'ScanCode', 'finalizar'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];


    public function mount()
    {
        // $this->identificador = rand();
        // $this->brand = new Brand();//se hace para inicializar el objeto e indicar que image es
        // $this->image ="";
        $this->initialinventory = Initialinventory::where('local_id', Auth()->user()->employee->local->id)->first();
        $this->stateinventory = $this->initialinventory->state;
        //if($this->stateinventory == 1)
        if ($this->stateinventory == 1) {
            $this->mensaje = "En proceso";
        } else {
            $this->mensaje = "Finalizado ...";
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }


    /*       'brand.name'=> 'required',Rule::unique('brands')->ignore($this->brand->id) */

    /*      protected $rules = [
        'brand.name' => 'required',
        'brand.image'=>'image',
        'brand.state'=>'required',
    ]; */



    public function loadProducts()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {

        /*  if ($this->readyToLoad) {
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
        } */

        //$products =[];

        //$initialinventory_productatributes = Initialinventory_productatribute::all();
        $this->total = Initialinventory_productatribute::where('initialinventory_id', $this->initialinventory->id)->sum('stock');
        $initialinventory_productatributes = Initialinventory_productatribute::where('initialinventory_id', $this->initialinventory->id)->paginate(5);
        $this->stateinventory = $this->initialinventory->state;
        //$initialinventory_productatributes = DB::table('initialinventory_productatribute')->paginate(5);

        return view('livewire.admin.inventory-list', compact('initialinventory_productatributes'));
    }


    // buscar y agregar producto por escaner y/o manual
    public function ScanCode($barcode,  $cant = 1)
    {

        if ($this->stateinventory == 1) {
            //busca en la tabla productatribute
            $productatribute = Productatribute::where('codigo', $barcode)->first();

            //dd($productatribute);

            if ($productatribute == null || empty($productatribute)) {
                //$this->mensaje = 'El producto no está registrado';
                session()->flash('errormessage', 'el Producto con código   -' . ' ' . $barcode . ' ' . '-   No se encuentra registrado.');
            } else {
                //buscamos el producto en la tabla generada de muchos a muchos
                // Initialinventory_productatribute::find($productatribute->id);

                $initialinventory_productatribute = Initialinventory_productatribute::where('productatribute_id', $productatribute->id) //busco el producto
                    ->where('initialinventory_id', $this->initialinventory->id)->first(); //se busca en el inventario 1,2,3,..  osea en el local 1,2,3
                //si es primera vez lo pone stock 1, sino aumenta el stock en 1
                if ($initialinventory_productatribute == NULL) {
                    //$stock = 1;
                    Initialinventory_productatribute::create([
                        'initialinventory_id' => Auth()->user()->employee->local->id,
                        'productatribute_id' => $productatribute->id,
                        'stock' => 1,
                    ]);
                } else {
                    $stock = $initialinventory_productatribute->stock + 1;
                    $initialinventory_productatribute->stock = $stock;
                    $initialinventory_productatribute->save();
                }

                //dd(Auth()->user()->local->id);
                //falta poner dinamico el initial inventory ahora esta 1
                //la productatributes tiene una relacion de muchos a muchos con initialinventories
                //guradmos el stock es el pivot,initialinventory_id, productatribute_id
                //en el modelo Productatribute esta el withpivot('stock')
                //estoy parado en productatribute tengo a la mano productatribute_id
                //le pasamos initialinventory_id = Auth()->user()->local->id  y luego en un array el stock
                //se debe crear el registro initial inventory al crear el local



                /*  $productatribute->initialinventories()->sync([
                    Auth()->user()->local->id => [
                            'stock' => $stock,
                        ],
                ]);
 */
                /* Initialinventory::find(Auth()->user()->local->id)->productatributes()->sync([
                    $productatribute->id=>[
                        'stock' => $stock,
                    ],
                ]); */

                $producto = $productatribute->slug;
                $this->total = Initialinventory_productatribute::sum('stock');
                session()->flash('message', 'Código agregado: ' . $barcode . '   Producto agregado: ' . $producto);
            }
        } else {
        }
    }


    public function finalizar()
    {
        //buscatemos por local
        //Auth()->user()->local->id
        //$initialinventory = Initialinventory::where('local_id', 1)->first();
        //dd($initialinventory);
        //guardamos el stock en la tabla local_productatribute
        $initialinventory_productatributes = Initialinventory_productatribute::where('initialinventory_id', $this->initialinventory->id)->get(); //selecciona todo los productos del inventario actual
        //dd($initialinventory_productatributes);
        //obtenemos el local
        $this->local_id = Auth()->user()->employee->local->id;
        //$localproductatribute = Localproductatribute::where('local_id',$local_id);
        //foreach (Initialinventory_productatribute::cursor() as $ipa) {//con cursor funciona
        Initialinventory_productatribute::chunk(100, function (Collection $initialinventory_productatributes) {
            //trataremos de poner esto para acelerar la busqueda el chunk en 100
            $initialinventory_productatributes = Initialinventory_productatribute::where('initialinventory_id', $this->initialinventory->id)->get(); //selecciona todo los productos del inventario actual
            foreach ($initialinventory_productatributes as $ipa) {
                Localproductatribute::where('productatribute_id', $ipa->productatribute_id)
                    ->where('local_id', $this->local_id)->update(['stock' => $ipa->stock]);

                // $lpa = Localproductatribute::whereKey([$this->local_id, $ipa->productatribute_id])->first();

                //funcionaba todo lo comentado cuando estaba autoincremental
                //dd($ipa->stock);
                //dd($lpa);
                //dd($lpa);
                //if ($lpa) {
                //$lpa->stock = $ipa->stock;
                // $lpa->save();
                //}
            }
        });


        if ($this->initialinventory) {
            $this->initialinventory->state = 2;
            $this->initialinventory->save();
            $this->stateinventory = 2;
            $this->mensaje = "Finalizado ...";
        }
        //session()->flash('message', 'Fin' );

    }



    public function updateQty($product, $cant)
    {
        // dd($product);
        if ($cant <= 0)
            return;
        else
            $this->updateQuantity($product, $cant);
    }


    public function updateQuantity($product, $cant)
    {
        //busco el producto
        // $product = Initialinventory_productatribute::where('productatribute_id', $product)->first();
        $product = Initialinventory_productatribute::find($product);
        //dd($cant);
        $product->stock = $cant;
        $product->save();
        //$product = Product::find($product, ['codigobarras']);
        //dd($product );


    }


    public function savestock()
    {
        //guardamos stock en la tabla locale_productatribute



    }
}
