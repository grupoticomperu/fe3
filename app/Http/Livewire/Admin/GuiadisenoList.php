<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Guiadiseno;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class GuiadisenoList extends Component
{

    use WithPagination;
    use AuthorizesRequests;

    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader
    public $search;
    public $state;
    public $guiadiseno;

    protected $listeners = ['render', 'delete'];

    public function loadGuiadisenos()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        if ($this->readyToLoad) {

            $guiasdisenos = Guiadiseno::where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nameblade', 'like', '%' . $this->search . '%');
            })
                ->when($this->state, function ($query) {
                    $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $guiasdisenos = collect(); // o paginator vacío
        }

        return view('livewire.admin.guiadiseno-list', compact('guiasdisenos'));
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

    public function activar(Guiadiseno $guiadiseno)
    {

        $this->authorize('update', $guiadiseno);

        $this->guiadiseno = $guiadiseno;
        $this->guiadiseno->update([
            'state' => 1
        ]);
    }

    public function desactivar(Guiadiseno $guiadiseno)
    {

        $this->authorize('update', $guiadiseno);

        $this->guiadiseno = $guiadiseno;
        $this->guiadiseno->update([
            'state' => 0
        ]);
    }


    public function delete(Guiadiseno $guiadiseno)
    {
        //$this->authorize('delete', $guiadiseno);
        $guiadiseno->delete();
    }
}
