<?php

namespace App\Http\Livewire\Admin;

use App\Models\Shopping;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\Builder;



class ShoppingList extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    public $shopping;
    public $search;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $readyToLoad = false;//para controlar el preloader inicia en false

   // protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];

    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    public function loadShoppings(){
        $this->readyToLoad = true;
    }

    public function render()
    {
         /*  if ($this->readyToLoad) {
            $shoppings = Shopping::with('supplier')->where('numero', 'like', '%' .$this->search. '%')
               ->orderBy($this->sort, $this->direction)
               ->paginate($this->cant);
        }else{
              $shoppings =[];

        } */


/*           if ($this->readyToLoad) {
            $shoppings = Shopping::query()
                    ->with('supplier')
                    ->when($this->search, function($query){
                        return $query->where('numero', 'like', '%' .$this->search. '%')
                               ->orWhereHas('supplier', function($q){
                                $q->where('nomrazonsocial', 'like', '%' .$this->search. '%');
                               });
                    })->orderBy($this->sort, $this->direction)
                    ->paginate($this->cant);

        }else{
            $shoppings =[];
        } */


        if ($this->readyToLoad) {
            //with('supplier', 'currency') para la carga anciosa n+1
            $shoppings = Shopping::with('supplier', 'currency')->addSelect([
                'nomrazonsocial' => Supplier::select('nomrazonsocial')
                ->whereColumn('id', 'shoppings.supplier_id')

            ])->where('serienumero', 'like', '%' .$this->search. '%')->orWhereHas('supplier', function(Builder $query){
                $query->where('nomrazonsocial', 'like', '%' .$this->search. '%');
               })

               /* orWhereHas('supplier', function(Builder $query){
                $query->where('nomrazonsocial', 'like', '%' .$this->search. '%')  es para la busqueda*/

            ->orderBy($this->sort, $this->direction)->paginate($this->cant);
            //pongo esto y no funciona  ->orWhere('nomrazonsocial', 'like', '%' .$this->search. '%')
            //dd($shoppings);
         }else{
            $shoppings =[];
        }

        //dd($shoppings);



        return view('livewire.admin.shopping-list', compact('shoppings'));
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




}
