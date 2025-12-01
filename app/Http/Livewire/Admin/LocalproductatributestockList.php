<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Localproductatribute;
use Illuminate\Support\Facades\Auth;

class LocalproductatributestockList extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search, $image, $product, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para controlar el preloader
    public $withcategory;//esta opcion vienen de configuracion 1 es con categoria
    public $category;
    public $local_id;


    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];

    public function mount(){
        $this->local_id = auth()->user()->employee->local->id;
    }

    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    public function loadProducts(){
        $this->readyToLoad = true;
    }

    public function render()
    {

        if ($this->readyToLoad) {
            $localproductatributes = Localproductatribute::where('local_id', $this->local_id)->paginate(10); //selecciona todo los productos de localproductatribute
        }else{
            $localproductatributes =[];
        }


        return view('livewire.admin.localproductatributestock-list', compact('localproductatributes'));
    }
}
