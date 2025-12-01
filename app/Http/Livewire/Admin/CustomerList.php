<?php

namespace App\Http\Livewire\Admin;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CustomerList extends Component
{

    
    use WithPagination;
    use WithFileUploads;

    public $sort='id';
    public $direction='desc';
    public $cant='10';
    //public $open_edit = false;
    public $readyToLoad = false;//para controlar el preloader
    public $selectedCustomers = []; //para eliminar en grupo
    public $selectAll = false; //para eliminar en grupo
    public $search, $state;
    public $customer;

    protected $listeners = ['render', 'delete'];


//RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    /* public function updatingSearch(){
        $this->resetPage();
    } */


    public function loadCustomers(){
        $this->readyToLoad = true;
    }


    public function render()
    {
        //$this->authorize('view', new Product);
        $companyId = auth()->user()->employee->company->id;
        //dd($companyId);

        if ($this->readyToLoad) {
            $customers = Customer::where('company_id', $companyId)
            ->where(function($query) {
                $query->where('nomrazonsocial', 'like', '%' . $this->search . '%')
                      ->orWhere('numdoc', 'like', '%' . $this->search . '%');
            })
            ->when($this->state, function ($query) {
                return $query->where('state', 1);
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
            //dd($products);
        } else {
            $customers = [];
        }

        return view('livewire.admin.customer-list', compact('customers'));
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


    public function activar(Customer $customer)
    {

        //$this->authorize('update', $this->product);

        $this->customer = $customer;

        $this->customer->update([
            'state' => 1
        ]);
    }


    public function desactivar(Customer $customer)
    {
        //$this->authorize('update', $this->product); //tenemos que mandar el error a una pagina
        $this->customer = $customer;

        $this->customer->update([
            'state' => 0
        ]);
    }





    public function delete(Customer $customer)
    {
        //$this->authorize('delete', $product);
        $customer->delete();
    }




}
