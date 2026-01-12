<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Ncboletadiseno;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;


class 
NcboletadisenoList extends Component
{

    use WithPagination;
    use AuthorizesRequests;

    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader
    public $search;
    public $state;
    public $ncboletadiseno;

    protected $listeners = ['render', 'delete'];

    public function loadNcboletadisenos()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        if ($this->readyToLoad) {

            $ncboletasdisenos = Ncboletadiseno::where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nameblade', 'like', '%' . $this->search . '%');
            })
                ->when($this->state, function ($query) {
                    $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $ncboletasdisenos = collect(); // o paginator vacío
        }


        return view('livewire.admin.ncboletadiseno-list', compact('ncboletasdisenos'));
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

    public function activar(Ncboletadiseno $ncboletadiseno)
    {

        $this->authorize('update', $ncboletadiseno);

        $this->ncboletadiseno = $ncboletadiseno;
        $this->ncboletadiseno->update([
            'state' => 1
        ]);
    }

    public function desactivar(Ncboletadiseno $ncboletadiseno)
    {

        $this->authorize('update', $ncboletadiseno);

        $this->ncboletadiseno = $ncboletadiseno;
        $this->ncboletadiseno->update([
            'state' => 0
        ]);
    }


    public function delete(Ncboletadiseno $ncboletadiseno)
    {
        //$this->authorize('delete', $boletadiseno);
        $ncboletadiseno->delete();
    }
}
