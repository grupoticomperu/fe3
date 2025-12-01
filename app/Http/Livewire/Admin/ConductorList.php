<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Conductor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;


class ConductorList extends Component
{

    use WithPagination;
    use AuthorizesRequests;

    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader
    public $search;
    public $state;
    public $conductor;

    protected $listeners = ['render', 'delete'];

    public function loadConductors()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        //$this->authorize('view', new Conductor);

        $companyId = auth()->user()->employee->company->id;

        if ($this->readyToLoad) {
            $conductors = Conductor::where('company_id', $companyId)
                ->where(function ($query) {
                    $query->where('nomape', 'like', '%' . $this->search . '%')
                        ->orWhere('numdoc', 'like', '%' . $this->search . '%');
                })
                ->when($this->state, function ($query) {
                    return $query->where('state', 1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $conductors = [];
        }

        return view('livewire.admin.conductor-list', compact('conductors'));
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

    public function activar(Conductor $conductor)
    {

        $this->authorize('update', $conductor);

        $this->conductor = $conductor;
        $this->conductor->update([
            'state' => 1
        ]);
    }

    public function desactivar(Conductor $conductor)
    {

        $this->authorize('update', $conductor);

        $this->conductor = $conductor;
        $this->conductor->update([
            'state' => 0
        ]);
    }



    public function delete(Conductor $conductor)
    {
        $this->authorize('delete', $conductor);
        $conductor->delete();
    }


}
