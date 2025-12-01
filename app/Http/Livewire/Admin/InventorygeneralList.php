<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Localproductatribute;

class InventorygeneralList extends Component
{
    public $localproductatributes;

    public function mount(){

        //$this->localproductatributes = Localproductatribute::get();
       //dd($this->localproductatributes);

     }

    public function render()
    {
        $this->localproductatributes = Localproductatribute::all();
        return view('livewire.admin.inventorygeneral-list');
    }
}
