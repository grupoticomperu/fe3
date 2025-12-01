<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionList extends Component
{
    use WithPagination;

    public $search, $permission;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para cntrolar el preloader
    Public $flag;


    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];


    protected $rules = [
        'permission.name'=> 'required',
        'permission.display_name'=> 'required',
    ];

    public function updatingSearch(){
        $this->resetPage();
    }


    public function loadPermissions(){
        $this->readyToLoad = true;
    }


    public function render()
    {
        if ($this->readyToLoad) {
            $permissions = Permission::where('name', 'like', '%' .$this->search. '%')
                ->orWhere('display_name', 'like', '%' .$this->search. '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        }else{
            $permissions =[];
        }

        return view('livewire.admin.permission-list', compact('permissions'));
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


    public function edit(Permission $permission){
        //dd($modelo);
        $this->permission = $permission;
        //dd($this->modelo);
        $this->open_edit = true;

    }

    public function update(){
       $this->validate();
       $this->permission->save();
       $this->reset('open_edit');

       //$this->emitTo('show-posts', 'render');
       $this->emit('alert','El Permiso se modifico correctamente');

   }



}
