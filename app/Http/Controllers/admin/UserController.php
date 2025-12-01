<?php

namespace App\Http\Controllers\admin;

use Image;
use App\Models\User;
use App\Models\Local;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function index()
    {
        // $users = User::allowed()->get();
        return view('admin.users.index');
    }


    public function create()
    {
        $companyId = auth()->user()->employee->company->id;
        $user = new User(); //instanvciamos el modelo user pero vacia
        //$this->authorize('create', $user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        $positions = Position::where('company_id', $companyId)->get(); //positions de la emresa
        $locales = Local::where('company_id', $companyId)->get(); //locales de la empresa
        return view('admin.users.create', compact('user', 'roles', 'permissions', 'positions', 'locales'));
    }


    public function store(Request $request)
    {

        $company = auth()->user()->employee->company;

        $this->validate($request, [
            'name' => 'required |min:2',
            'email' => 'required|unique:users|email|max:100',
            'password' => 'required|confirmed|min:6',
            'photo' => 'image|max:2048'
        ]);

        /*  $imagen = $request->file('photo');
        $nombreImagen = Str::uuid().".".$imagen->extension(); */
        //$nombreImagen = Str::uuid()."."."jpg";
        /*  $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(150, 150);
        $imagenPath = public_path('img/users') . '/' . $nombreImagen;
        $imagenServidor -> save($imagenPath); */

        if ($request->hasFile('photo')) {
            //$nombreimagen = Storage::disk('s3')->put('parallaxs', $request->file('photo'), 'public');
            $urlimage = Storage::disk('s3')->put('fe/' . $company->razonsocial . '/users', $request->file('photo'), 'public');
        } else {
            $urlimage = 'fe/default/users/userdefault.jpg';
        }



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => auth()->user()->employee->company->id,
        ]);
        Employee::create([
            'address' => $request->address,
            'movil' => $request->movil,
            'photo' => $urlimage,
            'dni' => $request->dni,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'state' => $request->state,
            'user_id' => $user->id,
            'position_id' => $request->position_id,
            'local_id' => $request->local_id,
            'company_id' => auth()->user()->employee->company->id,

        ]);

        $user->assignRole($request->roles);
        $user->givePermissionTo($request->permissions);
        return redirect()->route('admin.user.index')->withFlash('El Usuario fue creado');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        $companyId = auth()->user()->employee->company->id;
        //$this->authorize('update', $user);
        //$roles = Role::pluck('name', 'id');//mandara un array asociativo con clave
        $roles = Role::with('permissions')->get();
        //valor y no un array de objetos
        $permissions = Permission::pluck('name', 'id');
        $positions = Position::all();
        $locales = Local::where('company_id', $companyId)->get(); //locales de la empresa
        return view('admin.users.edit', compact('user', 'roles', 'permissions', 'positions', 'locales'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {

        $request->validated();


        if ($request->file('photo')) {
            $imagen = $request->file('photo');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $nombreImagenbd = 'img/users/' . $nombreImagen;
            //$nombreImagen = Str::uuid()."."."jpg";
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(150, 150);
            $imagenPath = public_path('img/users') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        } else {
            $nombreImagenbd = $user->employee->photo;
        }

        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = $user->password;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        $employee = $user->employee();
        $employee->update([
            'address' => $request->address,
            'movil' => $request->movil,
            'photo' => $nombreImagenbd,
            'dni' => $request->dni,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'state' => $request->state,
            'user_id' => $user->id,
            'local_id' => $request->local_id,
            'position_id' => $request->position_id,
        ]);

        return redirect()->route('admin.user.edit', $user)->with('flash', 'Usuario Actualizado');
    }


    public function destroy(User $user)
    {
        //
    }
}
