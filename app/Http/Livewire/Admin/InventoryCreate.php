<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Local;
use Livewire\Component;
use App\Models\Inventory;
use App\Models\Inventorytemporary;
use App\Models\Localproductatribute;
use Illuminate\Support\Facades\DB;

class InventoryCreate extends Component
{
    public $open = false;
    public $name, $state, $datestart, $local_id = "";


    /* protected $rules = [
        'name'=> 'required',
        'datestart' => 'required',
        'local_id' => 'required',
    ]; */


    public function rules()
    {
        return [
            'local_id' => function ($attribute, $value, $fail) {
                // Lógica para verificar si hay un inventario pendiente o no concluido
                $inventariopendiente = Inventory::where('local_id', $this->local_id)->where('state', 1)->exists();
                if ($inventariopendiente) {
                    $fail('No puedes crear un nuevo inventario en este local, mientras haya un inventario pendiente o no concluido.');
                }
            },
            'name' => 'required',
            //'datestart' => 'required',
            // Otras reglas de validación...

        ];
    }


    public function updated($propertyNameeer)
    {
        $this->validateOnly($propertyNameeer);
    }

    //updating antes que se modifica updated despues que se modifica
    public function updatingOpen()
    {
        if ($this->open == false) {
            $this->reset('name', 'local_id');
            //$this->resetValidation();
            //$this->local_id ="";

        }
    }

    public function save()
    {
        $this->validate();
        //ahora hay que restringir y hacer que grabe todo o nada  cabecera y detalle
        DB::beginTransaction();
        try {
            //guardamos el nuevo inventario cabecera
            $inventory = Inventory::create([
                'local_id' => $this->local_id,
                'name' => $this->name,
                'datestart' => Carbon::now(),
                'state' => 1,
                'user_id' => 1,
            ]);
            //llenamos el inventorytemporary detalle
            $local_productatributes = Localproductatribute::where('local_id', $this->local_id)->get(); //selecciona todo los productos del inventario actual
            foreach ($local_productatributes as $lpa) {
                Inventorytemporary::create([
                    'codigo' => $lpa->productatribute->codigo,
                    'name' => $lpa->productatribute->slug,
                    'stocksistema' => $lpa->stock,
                    'stockcontado' => 0,
                    'diferencia' => $lpa->stock,
                    'inventory_id' => $inventory->id,
                    'local_id' => $this->local_id,
                    'local_productatribute_id' => $lpa->id,
                ]);
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }



        //redireccionar para listar el inventario creado
        return redirect()->route('inventorytemporary.list', $inventory);
    }


    public function render()
    {

        $locales = Local::all();

        return view('livewire.admin.inventory-create', compact('locales'));
    }
}
