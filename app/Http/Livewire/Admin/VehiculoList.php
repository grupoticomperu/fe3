<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Vehiculo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;


class VehiculoList extends Component
{

    use WithPagination;
    use AuthorizesRequests;

    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader
    public $search;
    public $state;
    public $vehiculo;

    protected $listeners = ['render', 'delete'];

    public function loadVehiculos()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {

        $this->authorize('view', new Vehiculo);

        $companyId = auth()->user()->employee->company->id;

        if ($this->readyToLoad) {
            $vehiculos = Vehiculo::where('company_id', $companyId)
                ->where(function ($query) {
                    $query->where('numeroplaca', 'like', '%' . $this->search . '%')
                        ->orWhere('tuce', 'like', '%' . $this->search . '%');
                })
                ->when($this->state, function ($query) {
                    return $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $vehiculos = [];
        }

        return view('livewire.admin.vehiculo-list',  compact('vehiculos'));
    }



    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function activar(Vehiculo $vehiculo)
    {

        $this->authorize('update', $vehiculo);

        $this->vehiculo = $vehiculo;
        $this->vehiculo->update([
            'state' => 1
        ]);
    }

    public function desactivar(Vehiculo $vehiculo)
    {

        $this->authorize('update', $vehiculo);

        $this->vehiculo = $vehiculo;
        $this->vehiculo->update([
            'state' => 0
        ]);
    }


    public function delete(Vehiculo $vehiculo)
    {
        $this->authorize('delete', $vehiculo);
        $vehiculo->delete();
    }
}
