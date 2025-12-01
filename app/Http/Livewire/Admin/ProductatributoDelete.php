<?php

namespace App\Http\Livewire\Admin;

use App\Models\Productatribute;
use Livewire\Component;

class ProductatributoDelete extends Component
{


    public $productatribute;

    public function render()
    {
        return view('livewire.admin.productatributo-delete');

    }

    public function delete(Productatribute $productatribute){
        //return $productatribute;
        $productatribute->delete();
    }

}
