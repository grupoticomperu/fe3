<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Shipment;
use Livewire\WithPagination;

class ReceptionList extends Component
{

    // use AuthorizesRequests;
    use WithPagination;
    public $shopping;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader inicia en false

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    public function loadReceptions()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {

        if ($this->readyToLoad) {


            $receptions = Shipment::with('localRecibe')
                ->where('local_recibe_id', Auth()->user()->employee->local->id)->where('state', '<>', 1)//esta parte es para restringir osea mostrar solo mis recepciones
                ->where(function ($query) {
                    $query->where('id', 'like', '%' . $this->search . '%')
                        ->orWhereHas('localEnvia', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        });
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $receptions = [];
        }


        return view('livewire.admin.reception-list', compact('receptions'));
    }
}
