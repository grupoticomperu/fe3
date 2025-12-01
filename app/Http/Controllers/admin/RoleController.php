<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all(),
        ]);
    }


    public function create()
    {
        // $this->authorize('create', $role = new Role);
        $role = new Role;
        return view('admin.roles.create', [
            'permissions' => Permission::pluck('name', 'id'),
            'role' => $role
        ]);
    }

    public function store(Request $request)
    {
        //$this->authorize('create', new Role);
        $role = new Role;
        //return $request;
        /*  $data = $request->validate([
            'name'=>'required|unique:roles',
            'display_name'=>'required',
        ]); */

        $request->validate([
            'name' => 'required|unique:roles,name,NULL,id,company_id,' . auth()->user()->employee->company->id,
            'display_name' => 'required',
        ]);



        //$existe = Role::where('name', $request->name)->where('company_id', auth()->user()->employee->company->id)->get();
        //dd($existe);

        /* if($existe){
            return redirect()->route('admin.role.index')->withFlash('El Rol ya existe');

        } */

        //recuerda que si el campo no esta definido en el array de validacion no se pasara en el $data
        //al poner create($data)  se guardara name, display_name, guard_name
        //$role = Role::create($data);
        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            //'company_id' => auth()->user()->employee->company->id, //encontramos la company actual osea la compania del usuario logueado
            //'guard_name' => auth()->user()->employee->company->id,
        ]);

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.role.index')->withFlash('El Rol fue creado correctamente');
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        //$this->authorize('update',$role);
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')
        ]);
    }


    public function update(Request $request, Role $role)
    {
        //$this->authorize('update',$role);
        //si validamos en el request seria asi en el metodo authorize
        //return \Gate::authorize('update',$this->route('role'));
        //return $request;
        $data = $request->validate([
            //'name'=>'required|unique:roles,name,' . $role->id,
            'display_name' => 'required',
            //'guard_name'=>'required'
        ]);

        $role->update($data);

        $role->permissions()->detach();
        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.role.edit', $role)->withFlash('El Rol fue actualizado correctamente');
    }


    public function destroy(Role $role)
    {
        //
    }
}
