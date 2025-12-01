<?php

namespace App\Http\Livewire\Admin;

use App\Models\Transportista;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;


class TransportistaList extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $readyToLoad = false;//para controlar el preloader
    public $search; 
    public $state;
    public $transportista;

    protected $listeners = ['render', 'delete'];

    public function loadTransportistas(){
        $this->readyToLoad = true;
    }

    public function render()
    {
        $this->authorize('view', new Transportista);

        $companyId = auth()->user()->employee->company->id;

        if ($this->readyToLoad) {
            $transportistas = Transportista::where('company_id', $companyId)
            ->where(function($query) {
                $query->where('nomrazonsocial', 'like', '%' . $this->search . '%')
                      ->orWhere('numdoc', 'like', '%' . $this->search . '%');
            })
            ->when($this->state, function ($query) {
                return $query->where('state', 1);
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        } else {
            $transportistas = [];
        }

        return view('livewire.admin.transportista-list', compact('transportistas'));
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

    public function activar(Transportista $transportista){

       $this->authorize('update', $transportista);

       $this->transportista = $transportista;
       $this->transportista->update([
           'state' => 1
       ]);     
    }

    public function desactivar(Transportista $transportista){

        $this->authorize('update', $transportista);

       $this->transportista = $transportista;
       $this->transportista->update([
           'state' => 0
       ]);     
    }


    public function delete(Transportista $transportista){
        $this->authorize('delete', $transportista);
        $transportista->delete();
    }

}
