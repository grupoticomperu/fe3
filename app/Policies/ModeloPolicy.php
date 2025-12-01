<?php

namespace App\Policies;

use App\Models\Modelo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModeloPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if($user->hasRole('Admin'))
        {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Modelo $modelo)
    {
        return $user->hasPermissionTo('Modelo View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Modelo Create');
    }


    public function update(User $user, Modelo $modelo)
    {
        return $user->hasPermissionTo('Modelo Update');
    }


    public function delete(User $user, Modelo $modelo)
    {
        return $user->hasPermissionTo('Modelo Delete ');
    }


    public function restore(User $user, Modelo $modelo)
    {
        //
    }


    public function forceDelete(User $user, Modelo $modelo)
    {
        //
    }
}
