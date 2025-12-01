<?php

namespace App\Http\Livewire\Admin;

use App\Models\Customer;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tipocomprobante;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\Builder;

class SaleList extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    public $shopping;
    public $search;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $readyToLoad = false;//para controlar el preloader inicia en false

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

    public function loadSales(){
        $this->readyToLoad = true;
    }


    public function render()
    {

        if ($this->readyToLoad) {
            //with('supplier', 'currency') para la carga anciosa n+1
            $sales = Sale::with('customer', 'local')->addSelect([
                'nomrazonsocial' => Customer::select('nomrazonsocial')
                ->whereColumn('id', 'sales.customer_id')

            ])->where('serie', 'like', '%' .$this->search. '%')->orWhereHas('customer', function(Builder $query){
                $query->where('nomrazonsocial', 'like', '%' .$this->search. '%');
               })

               /* orWhereHas('supplier', function(Builder $query){
                $query->where('nomrazonsocial', 'like', '%' .$this->search. '%')  es para la busqueda*/

            ->orderBy($this->sort, $this->direction)->paginate($this->cant);
            //pongo esto y no funciona  ->orWhere('nomrazonsocial', 'like', '%' .$this->search. '%')
            //dd($shoppings);
         }else{
            $sales =[];
        }


        return view('livewire.admin.sale-list', compact('sales'));
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
