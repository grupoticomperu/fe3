<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;

use App\Models\Boletadiseno;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;


class BoletadisenoList extends Component
{

    use WithPagination;
    use AuthorizesRequests;

    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader
    public $search;
    public $state;
    public $boletadiseno;

    protected $listeners = ['render', 'delete'];

    public function loadBoletadisenos()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        if ($this->readyToLoad) {

            $boletasdisenos = Boletadiseno::where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nameblade', 'like', '%' . $this->search . '%');
            })
                ->when($this->state, function ($query) {
                    $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $boletasdisenos = collect(); // o paginator vacío
        }


        return view('livewire.admin.boletadiseno-list', compact('boletasdisenos'));
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

    public function activar(Boletadiseno $boletadiseno)
    {

        $this->authorize('update', $boletadiseno);

        $this->boletadiseno = $boletadiseno;
        $this->boletadiseno->update([
            'state' => 1
        ]);
    }

    public function desactivar(Boletadiseno $boletadiseno)
    {

        $this->authorize('update', $boletadiseno);

        $this->boletadiseno = $boletadiseno;
        $this->boletadiseno->update([
            'state' => 0
        ]);
    }


    public function delete(Boletadiseno $boletadiseno)
    {
        //$this->authorize('delete', $boletadiseno);
        $boletadiseno->delete();
    }
}
