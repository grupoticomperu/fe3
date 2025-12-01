<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Puntodepartida;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class PuntodepartidaList extends Component
{

    use WithPagination;
    use AuthorizesRequests;
    
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $readyToLoad = false;//para controlar el preloader
    public $search; 
    public $state;
    public $puntodepartida;

    protected $listeners = ['render', 'delete'];

    public function loadPuntosdepartidas(){
        $this->readyToLoad = true;
    }

    public function render()
    {
        //$this->authorize('view', new Puntodepartida);

        $companyId = auth()->user()->employee->company->id;

        if ($this->readyToLoad) {
            $puntosdepartidas = Puntodepartida::where('company_id', $companyId)
            ->where(function($query) {
                $query->where('direccion', 'like', '%' . $this->search . '%')
                      ->orWhere('ubigeo', 'like', '%' . $this->search . '%');
            })
            ->when($this->state, function ($query) {
                return $query->where('state', 1);
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        } else {
            $puntosdepartidas = [];
        }

        return view('livewire.admin.puntodepartida-list', compact('puntosdepartidas'));
    }

    public function order($sort){
        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function activar(Puntodepartida $puntodepartida){

       $this->authorize('update', $puntodepartida);

       $this->puntodepartida = $puntodepartida;
       $this->puntodepartida->update([
           'state' => 1
       ]);     
    }

 public function desactivar(Puntodepartida $puntodepartida){

       $this->authorize('update', $puntodepartida);

       $this->puntodepartida = $puntodepartida;
       $this->puntodepartida->update([
           'state' => 0
       ]);     
    }


    public function delete(Puntodepartida $puntodepartida){
        $this->authorize('delete', $puntodepartida);
        $puntodepartida->delete();
    }



}
