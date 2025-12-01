<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Inventory;
use App\Models\Inventorytemporary;
use Livewire\WithPagination;

class InventorytemporaryList extends Component
{
    use WithPagination;
    public $inventory;
    public $stateinventory;
    public $mensaje;
    public $total;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $search;

    protected $listeners = ['ScanCode', 'finalizar'];


    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];





    public function mount(Inventory $inventory){
        $this->inventory = $inventory;
        $inventorytemporaries = Inventorytemporary::where('inventory_id', $this->inventory->inventory_id)->get(); //selecciona todo los productos del inventario actual
        $this->stateinventory = $this->inventory->state;
        if ($this->stateinventory == 1) {
            $this->mensaje = "En proceso";
           }else{
            $this->mensaje = "Finalizado ...";
           }

    }


    public function ScanCode($barcode,  $cant = 1)
    {

        if ($this->stateinventory == 1){
            //busca en la tabla productatribute
            $inventorytemporary = Inventorytemporary::where('codigo', $barcode)->where('inventory_id', $this->inventory->id)->first();

            //dd($productatribute);

            if ($inventorytemporary == null || empty($inventorytemporary)) {
                    //$this->mensaje = 'El producto no está registrado';
                    session()->flash('errormessage', 'el Producto con código   -'. ' '.$barcode .' '.'-   No se encuentra registrado.');
            } else {
                   //buscamos el producto en la tabla generada de muchos a muchos
                   // Initialinventory_productatribute::find($productatribute->id);
                $stockcontado = $inventorytemporary->stockcontado +1;
                $inventorytemporary->stockcontado = $stockcontado;
                $inventorytemporary->save();

                session()->flash('message', 'Código agregado: '. $barcode. '   Producto agregado: ' . $inventorytemporary->name );
            }


                 //  $producto = $productatribute->slug;
                 //  $this->total = Initialinventory_productatribute::sum('stock');
                 //  session()->flash('message', 'Código agregado: '. $barcode. '   Producto agregado: ' . $producto );

        }else{

       }


    }




    public function render()
    {

        //$this->total = Inventorytemporary::where('inventory_id', $this->inventory->inventory_id)->sum('stocksistema');
        //$initialinventory_productatributes = Initialinventory_productatribute::where('initialinventory_id', $this->initialinventory->id)->paginate(5);
        $inventorytemporaries = Inventorytemporary::where('inventory_id', $this->inventory->id)->paginate(5);
       // $this->stateinventory = $this->inventory->state;

        return view('livewire.admin.inventorytemporary-list', compact('inventorytemporaries'));
    }




    public function updateQty($inventorytemporary, $cant)
    {
            // dd($product);
            if ($cant <= 0)
                    return;
            else
                    $this->updateQuantity($inventorytemporary, $cant);
    }


    public function updateQuantity($inventorytemporary, $cant)
    {
            //busco el producto
           // $product = Initialinventory_productatribute::where('productatribute_id', $product)->first();
            $inventorytemporary = Inventorytemporary::find($inventorytemporary);
            //dd($cant);
            $inventorytemporary->stockcontado = $cant;
            $inventorytemporary->save();
            //$product = Product::find($product, ['codigobarras']);
            //dd($product );


    }






}
