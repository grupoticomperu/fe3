<?php

namespace App\Policies;

use App\Models\Transportista;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransportistaPolicy
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

    public function view(User $user, Transportista $transportista)
    {

        return $user->hasPermissionTo('Transportista View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Transportista Create');
    }


    public function update(User $user, Transportista $transportista)
    {
        return $user->hasPermissionTo('Transportista Update');
    }


    public function delete(User $user, Transportista $transportista)
    {
        return $user->hasPermissionTo('Transportista Delete');
    }
}
