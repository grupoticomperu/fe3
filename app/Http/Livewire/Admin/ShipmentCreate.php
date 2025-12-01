<?php

namespace App\Http\Livewire\Admin;

use App\Models\Employee;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Local;
use Livewire\Component;

use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;


class ShipmentCreate extends Component
{
    public $open = false;
    public $name, $local_recibe_id="", $user_recibe_id="";
    public $locales, $users, $employees=[];


    protected $rules = [
        'local_recibe_id' => 'required',
        'user_recibe_id' => 'required',
        'name' => 'required',

    ];

    public function mount()
    {
        $this->locales = Local::where('id', '!=', Auth::user()->employee->local->id)->get();
       //$this->employees = [];
    }





    public function render()
    {
        //$currentUser = Auth::user()->local;
       // $locales = Local::where('id', '!=', $currentUser->id)->get();

        //$cart = Cartenvio::getContent()->sortBy('name');

        return view('livewire.admin.shipment-create');
    }


    public function updatingOpen()
    {
        if ($this->open == false) {
            $this->reset('name', 'local_recibe_id');
        }
    }



    public function updatedLocalRecibeId($value){
        $this->employees = Employee::where('local_id', $value)->get();

       // $this->reset(['provincia_id', 'distrito_id']);
    }




    public function saveok()
    {
        $this->validate();
        //ahora hay que restringir y hacer que grabe todo o nada  cabecera y detalle

        //guardamos el nuevo inventario cabecera
        $shipment = Shipment::create([
            'name' => $this->name,
            'local_envia_id' => Auth::user()->employee->local->id,
            'local_recibe_id' => $this->local_recibe_id,
            'fechaenvio' => Carbon::now(),
            'state' => 1,
            'total' => 0,
            'nota' => "",
            'user_id' => Auth::user()->id,
            'user_recibe_id' => $this->user_recibe_id,
        ]);


        //redireccionar al envio creado
        return redirect()->route('shipment.edit', $shipment);
    }
}
