<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Ncfacturadiseno;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class NcfacturadisenoList extends Component
{

     use WithPagination;
    use AuthorizesRequests;

    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader
    public $search;
    public $state;
    public $ncfacturadiseno;

    protected $listeners = ['render', 'delete'];

    public function loadNcfacturadisenos()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        if ($this->readyToLoad) {

            $ncfacturasdisenos = Ncfacturadiseno::where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nameblade', 'like', '%' . $this->search . '%');
            })
                ->when($this->state, function ($query) {
                    $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $ncfacturasdisenos = collect(); // o paginator vacío
        }

        return view('livewire.admin.ncfacturadiseno-list', compact('ncfacturasdisenos'));
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

    public function activar(Ncfacturadiseno $ncfacturadiseno)
    {

        $this->authorize('update', $ncfacturadiseno);

        $this->ncfacturadiseno = $ncfacturadiseno;
        $this->ncfacturadiseno->update([
            'state' => 1
        ]);
    }

    public function desactivar(Ncfacturadiseno $ncfacturadiseno)
    {

        $this->authorize('update', $ncfacturadiseno);

        $this->ncfacturadiseno = $ncfacturadiseno;
        $this->ncfacturadiseno->update([
            'state' => 0
        ]);
    }


    public function delete(Ncfacturadiseno $ncfacturadiseno)
    {
        //$this->authorize('delete', $boletadiseno);
        $ncfacturadiseno->delete();
    }


}
