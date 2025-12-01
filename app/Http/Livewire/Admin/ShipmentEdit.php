<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Local;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Shipment;
use Livewire\WithPagination;
use App\Models\Productatribute;
use App\Notifications\ProductSent;
use App\Models\Localproductatribute;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Local_productatribute_shipment;

class ShipmentEdit extends Component
{
    use WithPagination;
    public $shipment, $stateshipment, $mensaje;
    public $total;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $search;
    public $local_productatribute_shipments;
    public $readyToLoad = false;
    public $local_recibe;
    public $address_local_recibe;

    protected $listeners = ['ScanCode', 'enviar'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];


    public function mount(Shipment $shipment)
    {
        $this->shipment = $shipment;
        //$local = Local::find($this->shipment->id);
        //$this->local_recibe = $local->name;
        //$this->address_local_recibe = $local->address;
        $this->local_productatribute_shipments = Local_productatribute_shipment::where('shipment_id', $this->shipment->id)->get(); //selecciona todo los productos del inventario actual
        $this->stateshipment = $this->shipment->state;
        if ($this->stateshipment == 1) {
            $this->mensaje = "En proceso";
        } else {
            $this->mensaje = "Finalizado ...";
        }
    }


    public function ScanCode($barcode,  $cant = 1)
    {
        $this->search = $barcode;
        //if ($this->stateshipment == 1){
        //busca en la tabla local_product_atribute_shipment
        /* $local_productatribute_shipments = Local_productatribute_shipment::with('localproductatribute.productatribute', 'shipment')->addSelect([
                'codigo' => Productatribute::select('codigo')
                    ->whereColumn('id', 'local_productatribute_shipments.local_productatribute_id')
            ])->where('codigo', $this->search )->first(); */
        //$a = Local_productatribute_shipment::first()

        //dd($aa= Local_productatribute_shipment->localproductatribute->productatribute);

        /* $local_productatribute_shipments = Local_productatribute_shipment::with('localproductatribute.productatribute')
            ->whereHas('localproductatribute.productatribute', function ($query) {
                $query->where('codigo' , $this->search);
            })->first(); */

        //buscamos el producto en Localproductatribute
        $local_productatribute = Localproductatribute::with('productatribute')
            ->where('local_id', Auth()->user()->employee->local->id)
            ->whereHas('productatribute', function ($query) {
                $query->where('codigo', $this->search);
            })->first();

        //dd($local_productatribute);

        if ($local_productatribute == null || empty($local_productatribute)) {
            //$this->mensaje = 'El producto no está registrado';
            session()->flash('errormessage', 'el Producto con código   -' . ' ' . $barcode . ' ' . '-   No se encuentra registrado.');
        } else {
            //buscamos el producto en la tabla generada de muchos a muchos
            //Local_productatribute_shipment::find($local_productatribute->id);
            $local_productatribute_shipment = Local_productatribute_shipment::where('shipment_id', $this->shipment->id)->where('local_productatribute_id', $local_productatribute->id)->first();

            //si es primera vez lo pone stock 1, sino aumenta el stock en 1
            if ($local_productatribute_shipment == NULL) {
                //$stock = 1;
                Local_productatribute_shipment::create([
                    'shipment_id' => $this->shipment->id,
                    'local_productatribute_id' => $local_productatribute->id,
                    'quantity' => 1,
                ]);
            } else {
                $quantity = $local_productatribute_shipment->quantity + 1;
                $local_productatribute_shipment->quantity = $quantity;
                $local_productatribute_shipment->save();
            }

            session()->flash('message', 'Código agregado: ' . $barcode . '   Producto agregado: ');
        }
    }


    public function loadProducts()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $this->local_productatribute_shipments = Local_productatribute_shipment::where('shipment_id', $this->shipment->id)->get(); //selecciona todo los productos del envio actuatual
        $this->total = Local_productatribute_shipment::where('shipment_id', $this->shipment->id)->sum('quantity');
        $this->shipment->total = $this->total;
        $this->stateshipment = $this->shipment->state;
        if ($this->stateshipment == 1) {
            $this->mensaje = "En proceso";
        } else {
            $this->mensaje = "Finalizado ...";
        }
        $this->shipment->save();
        return view('livewire.admin.shipment-edit');
    }

    public function updateQty($lpas, $cant)
    {
        // dd($product);
        if ($cant <= 0)
            return;
        else
            $this->updateQuantity($lpas, $cant);
    }


    public function updateQuantity($lpas, $cant)
    {
        //busco el producto
        // $product = Initialinventory_productatribute::where('productatribute_id', $product)->first();
        $lpas = Local_productatribute_shipment::find($lpas);
        //dd($cant);
        $lpas->quantity = $cant;
        $lpas->save();
        //$product = Product::find($product, ['codigobarras']);
        //dd($product );


    }

    public function enviar()
    {
        // $this->local_productatribute_shipments = Local_productatribute_shipment::where('shipment_id', $this->shipment->id)->get();
        foreach ($this->local_productatribute_shipments as $lpas) {
            //buscamos en local_productatribute
            $lpa = Localproductatribute::where('local_id', Auth()->user()->employee->local->id)
                                         ->where('productatribute_id', $lpas->localproductatribute->productatribute_id)->first();
                //->where('id', $lpas->local_productatribute_id)->first();
            $lpa->stock = $lpa->stock - $lpas->quantity;
            $lpa->save();
        }
        //actualizamos el shipment
        $this->shipment->state = 2;
        //$this->shipment->fechaaceptacion = Carbon::now();
        $this->shipment->save();


        //dd($this->shipment);

        //$local = Local::find($this->shipment->local_recibe_id); //usuario a quien estamos enviando
        //$userrecibe = $local->user->id;
       // $userrecibe = Employee::find($local->user_id);//buscamos el empleado relacionado con el local
        //$userrecibe = User::find($local->user_id);
        $userrecibe = User::find($this->shipment->user_recibe_id);
        $userrecibe->notify(new ProductSent($this->shipment));
        //habia un problema lo solucione comentando   <p>{{ session('flash') }}</p>   de app

        $this->emitTo('notification-shipment', 'cantidad');//para renderizar la cantidad de envios pendientes, pero no renderiza

        //se relaciona con x-banner de layout
        /* $request->session()->flash('flash.banner', 'Tuhhhhhhhhhh mensaje fue enviado');
        $request->session()->flash('flash.bannerStyle', 'success'); */

        /* falla al activar esto
        Session::flash('flash.banner', 'Tu mensaje fue enviado');
        Session::flash('flash.bannerStyle', 'success'); */

    }
}
