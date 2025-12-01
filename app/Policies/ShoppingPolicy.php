<?php

namespace App\Policies;

use App\Models\Shopping;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingPolicy
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


    public function view(User $user, Shopping $shopping)
    {
        return $user->hasPermissionTo('Shopping View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Shopping Create');
    }


    public function update(User $user, Shopping $shopping)
    {
        return $user->hasPermissionTo('Shopping Update');
    }


    public function delete(User $user, Shopping $shopping)
    {
        return $user->hasPermissionTo('Shopping Delete ');
    }


    public function restore(User $user, Shopping $shopping)
    {
        //
    }


    public function forceDelete(User $user, Shopping $shopping)
    {
        //
    }
}
