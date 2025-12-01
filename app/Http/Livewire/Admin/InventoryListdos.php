<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Productatribute;
use App\Models\Initialinventory_productatribute;
use App\Models\Localproductatribute;
use Illuminate\Support\Facades\Auth;

class InventoryListdos extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $search, $image, $brand, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para controlar el preloader inicia en false

    public $localproductatributes;
    //protected $listeners = ['render', 'delete'];

/*     protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ]; */


    public function mount(){

       $this->localproductatributes = Localproductatribute::all();
      //dd($this->localproductatributes->toArray());


    }



    public function render()
    {

        return view('livewire.admin.inventory-listdos');

        /*  return view('livewire.admin.inventory-listdos', [
            'localproductatributes' => $this->localproductatributes,
        ]); */

        /* return view('livewire.admin.inventory-listdos', [
            'localproductatributes' => $this->localproductatributes->toArray(),
        ]); */
    }



}
