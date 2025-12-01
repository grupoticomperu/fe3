<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modelo;

class ModeloList extends Component
{
    use WithPagination;

    public $search, $modelo, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para cntrolar el preloader
    Public $flag;


    protected $listeners = ['render', 'delete'];
    //protected $listeners = ['render'=>'render'];

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];

    public function mount(){

        //$this->modelo = new Modelo();
        //se hace para inicializar el objeto e indicar que image es
        //$this->image ="";
    }


    public function updatingSearch(){
        $this->resetPage();
    }


    public function loadModelos(){
        $this->readyToLoad = true;
    }



    public function render()
    {

         if ($this->readyToLoad) {
            $modelos = Modelo::where('name', 'like', '%' .$this->search. '%')
                ->when($this->state, function($query){
                    return $query->where('state',1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        }else{
            $modelos =[];
        }

        return view('livewire.admin.modelo-list', compact('modelos'));

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


    public function activar(Modelo $modelo){
        $this->modelo = $modelo;

        $this->modelo->update([
            'state' => 1
        ]);
    }

    public function desactivar(Modelo $modelo){
        $this->modelo = $modelo;

        $this->modelo->update([
            'state' => 0
        ]);
    }

    public function delete(Modelo $modelo){
        $modelo->delete();
    }


    protected $rules = [
        'modelo.name'=> 'required',
        'modelo.state'=>'',

    ];


    public function edit(Modelo $modelo){
        //dd($modelo);
        $this->modelo = $modelo;
        //dd($this->modelo);
        $this->open_edit = true;

    }



    public function update(){
         $this->validate();



        $this->modelo->save();
        $this->reset('open_edit');

        //$this->emitTo('show-posts', 'render');
        $this->emit('alert','El Modelo se modifico correctamente');

    }

}
