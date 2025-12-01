<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Localproductatribute;

class LocalproductatributestocktotalesList extends Component
{

    use WithPagination;

    public $search, $image, $product, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para controlar el preloader
    public $withcategory;//esta opcion vienen de configuracion 1 es con categoria
    public $productatribute_id;
    public $local_id;


    public function mount($productatribute_id){
        $this->productatribute_id = $productatribute_id;
    }

    public function loadProducts(){
        $this->readyToLoad = true;
    }


    public function render()
    {

        if ($this->readyToLoad) {
            $localproductatributes = Localproductatribute::where('productatribute_id', $this->productatribute_id)->paginate(10); //selecciona el stock en todos los locales, del producto escogido
                }else{
            $localproductatributes =[];
        }

        return view('livewire.admin.localproductatributestocktotales-list', compact('localproductatributes'));
    }
}
