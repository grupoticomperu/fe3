<?php

namespace App\Policies;

use App\Models\Conductor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConductorPolicy
{
    use HandlesAuthorization;


    public function before($user)
    {
        if($user->hasRole('Admin'))
        {
            return true;
        }
    }

    public function __construct()
    {
        //
    }

    public function view(User $user, Conductor $conductor)
    {

        return $user->hasPermissionTo('Conductor View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Conductor Create');
    }


    public function update(User $user, Conductor $conductor)
    {
        return $user->hasPermissionTo('Conductor Update');
    }


    public function delete(User $user, Conductor $conductor)
    {
        return $user->hasPermissionTo('Conductor Delete');
    }
}
