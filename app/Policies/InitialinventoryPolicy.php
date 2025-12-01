<?php

namespace App\Policies;

use App\Models\Initialinventory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InitialinventoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Initialinventory $initialinventory)
    {
        return $user->hasPermissionTo('Initialinventory View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Initialinventory Create');
    }


    public function update(User $user, Initialinventory $initialinventory)
    {
        return $user->hasPermissionTo('Initialinventory Update');
    }


    public function delete(User $user, Initialinventory $initialinventory)
    {
        return $user->hasPermissionTo('Inventory Delete ');
    }


    public function restore(User $user, Initialinventory $initialinventory)
    {
        //
    }


    public function forceDelete(User $user, Initialinventory $initialinventory)
    {
        //
    }
}
