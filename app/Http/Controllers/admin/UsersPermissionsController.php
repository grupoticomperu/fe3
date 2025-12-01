<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;


class UsersPermissionsController extends Controller
{
    public function update(Request $request, User $user){
		//return $request->permissions;

        $user->permissions()->detach();//de eloquent
        if($request->filled('permissions')){//si escogio al menos un permiso
            $user->givePermissionTo($request->permissions);
        }

		//$user->syncPermissions($request->permissions);//de la libreria
        return back()->withFlash('Los Permisos fueron actualizados');
	}
}
