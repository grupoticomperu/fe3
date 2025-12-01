<?php

namespace App\Http\Livewire\Admin;

use App\Models\Employee;
use Livewire\Component;

use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserList extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    //use WithFileUploads;
    public $user;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    // public $open_edit = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false

    // protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];


    // public function mount(){
    // $this->identificador = rand();
    // $this->user = new User();//se hace para inicializar el objeto e indicar que image es
    //$this->image ="";
    //  $this->users = $users;
    //  }

    public function updatingSearch()
    {
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }


    /*       'brand.name'=> 'required',Rule::unique('brands')->ignore($this->brand->id) */

    /* protected $rules = [
        'user.name' => 'required',
        'user.image'=>'image',
        'user.state'=>'required',
    ]; */


    public function loadUsers()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {

        //$this->authorize('view', new User);
        //$users = User::all()->paginate(2);

        if ($this->readyToLoad) {
            /*  $users = User::where('name', 'like', '%' .$this->search. '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant); */
            $users = User::where('name', 'like', '%' . $this->search . '%')
                ->whereHas('employee.company', function ($query) {
                    // Puedes ajustar la lógica para obtener la empresa deseada,
                    // por ejemplo, puedes usar el ID de la empresa actual del usuario autenticado.
                    $companyId = auth()->user()->employee->company_id;
                    $query->where('id', $companyId);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $users = [];
        }
        return view('livewire.admin.user-list', compact('users'));
        //return view('livewire.admin.user-list');
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }


    public function activar(User $user)
    {
        $this->user = $user;
        $employee = $this->user->employee();
        $employee->update([
            'state' => 1
        ]);
    }

    public function desactivar(User $user)
    {
        $this->user = $user;
        $employee = $this->user->employee();
        $employee->update([
            'state' => 0
        ]);
    }

    public function delete(User $user)
    {
        /* $this->authorize('delete', $user); */
        $user->delete();
    }

    /*     public function edit(User $user){
        $this->authorize('update', $user);

        $this->user = $user;
        $this->open_edit = true;

    } */

    /*     public function cancelar(){
        $this->reset('open_edit', 'image');
       // $this->identificador = rand();
        //$this->open_edit = false;
    }
 */

    /*     public function update(){
        $this->authorize('update', $this->user);




        $this->user->save();

        $this->emit('alert','El usuario se modificó correctamente');

    }
 */
}
