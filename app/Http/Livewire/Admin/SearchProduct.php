<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class SearchProduct extends Component
{

    public $search="";

    public function render()
    {
        return view('livewire.admin.search-product');
    }

    public function getResultsProperty(){
        return Product::where('name', 'LIKE', '%'. $this->search .'%')
                     ->where('state',1)
                     ->take(8)->get();
    }


}
