<?php

namespace App\Http\Livewire\Admin;

use App\Models\Guia;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GuiaList extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    //public $shopping;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $company;
    public $igv, $factoricbper;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];


    public function mount()
    {
        $this->company = auth()->user()->employee->company; //compania logueada
        //$this->igv = Impuesto::where('siglas', 'IGV')->value('valor'); //es el 18%
        //$this->factoricbper = Impuesto::where('siglas', 'ICBPER')->value('valor'); //es 0.2
    }


    public function updatingSearch()
    {
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    public function loadGuias()
    {
        $this->readyToLoad = true;
    }



    public function render()
    {
        if ($this->readyToLoad) {

            $company_id = auth()->user()->employee->company->id;
            $local_id = auth()->user()->employee->local->id;

           $query = Guia::with('comprobante')
                ->join('customers', 'customers.id', '=', 'guias.customer_id')
                ->select(
                    'guias.*',
                    'customers.nomrazonsocial as razonsocial'
                )
                ->where('guias.company_id', $company_id)
                //->where('guias.local_id', $local_id)
                ->where('guias.serienumero', 'like', '%' . $this->search . '%');

            // 🔽 Ordenamiento dinámico
            if ($this->sort === 'serienumero') {
                $query->orderByRaw('SUBSTRING_INDEX(guias.serienumero, "-", 1) ' . $this->direction)
                    ->orderByRaw('CAST(SUBSTRING_INDEX(guias.serienumero, "-", -1) AS UNSIGNED) ' . $this->direction);
            } elseif ($this->sort === 'razonsocial') {
                $query->orderBy('customers.nomrazonsocial', $this->direction);
            } else {
                $query->orderBy('guias.' . $this->sort, $this->direction);
            }

            $guias = $query->paginate($this->cant);
        } else {
            $guias = [];
        }

        return view('livewire.admin.guia-list', compact('guias'));
    }


}
