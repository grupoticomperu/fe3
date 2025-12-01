<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Customer;

class SearchCustomer extends Component
{
    public $search;
    
    public function render()
    {
        return view('livewire.admin.search-customer');
    }

        //propiedad computada
    public function getResultsProperty(){
        return Customer::where('nomrazonsocial', 'LIKE', '%'. $this->search .'%')->take(8)->get();
    }
}
