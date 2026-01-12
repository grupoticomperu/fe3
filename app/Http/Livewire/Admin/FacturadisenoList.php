<?php

namespace App\Http\Livewire\Admin;

use App\Models\Factura;
use Livewire\Component;
use App\Models\Facturadiseno;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class FacturadisenoList extends Component
{

    use WithPagination;
    use AuthorizesRequests;

    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader
    public $search;
    public $state;
    public $facturadiseno;

    protected $listeners = ['render', 'delete'];

    public function loadFacturadisenos()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {

        if ($this->readyToLoad) {

            $facturasdisenos = Facturadiseno::where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nameblade', 'like', '%' . $this->search . '%');
            })
                ->when($this->state, function ($query) {
                    $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $facturasdisenos = collect(); // o paginator vacío
        }

        return view('livewire.admin.facturadiseno-list', compact('facturasdisenos'));
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

    public function activar(Facturadiseno $facturadiseno)
    {

        $this->authorize('update', $facturadiseno);

        $this->facturadiseno = $facturadiseno;
        $this->facturadiseno->update([
            'state' => 1
        ]);
    }

    public function desactivar(Facturadiseno $facturadiseno)
    {

        $this->authorize('update', $facturadiseno);

        $this->facturadiseno = $facturadiseno;
        $this->facturadiseno->update([
            'state' => 0
        ]);
    }

    public function delete(Facturadiseno $facturadiseno)
    {
        //$this->authorize('delete', $boletadiseno);
        $facturadiseno->delete();
    }
}
