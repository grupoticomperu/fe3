<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inventory;



class InventoryList2 extends Component
{
    use WithPagination;
    public $search,$state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $readyToLoad = false;//para cntrolar el preloader

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];

    public function mount(){

        //$this->modelo = new Modelo();
        //se hace para inicializar el objeto e indicar que image es
        //$this->image ="";
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function loadInventories(){
        $this->readyToLoad = true;
    }


    public function render()
    {

        if ($this->readyToLoad) {
            $inventories = Inventory::where('name', 'like', '%' .$this->search. '%')
                ->when($this->state, function($query){
                    return $query->where('state',1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        }else{
            $inventories =[];
        }

        return view('livewire.admin.inventory-list2',compact('inventories'));
    }
}
