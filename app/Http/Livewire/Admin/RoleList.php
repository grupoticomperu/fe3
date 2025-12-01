<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;



class RoleList extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    //use WithFileUploads;
    public $role;
    public $search;
    public $sort='id';
    public $direction='desc';
    public $cant='10';

    public $readyToLoad = false;//para controlar el preloader inicia en false

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];

    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    public function loadRoles(){
        $this->readyToLoad = true;
    }


    public function render()
    {
        $companyId = auth()->user()->employee->company->id;

        if ($this->readyToLoad) {
            $roles = Role::where('name', 'like', '%' .$this->search. '%')   //roles de la company logueada  where('company_id', $companyId)
               ->orderBy($this->sort, $this->direction)
               ->paginate($this->cant);
       }else{
              $roles =[];
       }
       return view('livewire.admin.role-list', compact('roles'));

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


    public function activar(Role $role){
        $this->role = $role;

        $this->role->update([
            'state' => 1
        ]);
    }

     public function desactivar(Role $role){
        $this->role = $role;

        $this->role->update([
            'state' => 0
        ]);
    }

    public function delete(Role $role){
        /* $this->authorize('delete', $user); */
        $role->delete();
    }

}
