<?php

namespace App\Policies;

use App\Models\Local;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocalPolicy
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


    public function view(User $user, Local $local)
    {
        return $user->hasPermissionTo('Local View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Local Create');
    }


    public function update(User $user, Local $local)
    {
        return $user->hasPermissionTo('Local Update');
    }


    public function delete(User $user, Local $local)
    {
        return $user->hasPermissionTo('Local Delete');
    }


    public function restore(User $user, Local $local)
    {
        //
    }


    public function forceDelete(User $user, Local $local)
    {
        //
    }
}
