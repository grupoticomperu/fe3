<?php

namespace App\Policies;

use App\Models\Puntodepartida;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PuntodepartidaPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    public function __construct()
    {
        //
    }

    public function view(User $user, Puntodepartida $puntodepartida)
    {

        return $user->hasPermissionTo('Puntodepartida View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Puntodepartida Create');
    }


    public function update(User $user, Puntodepartida $puntodepartida)
    {
        return $user->hasPermissionTo('Puntodepartida Update');
    }


    public function delete(User $user, Puntodepartida $puntodepartida)
    {
        return $user->hasPermissionTo('Puntodepartida Delete');
    }
}
