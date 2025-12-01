<?php

namespace App\Policies;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryPolicy
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


    public function view(User $user, Inventory $inventory)
    {
        return $user->hasPermissionTo('Inventory View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Inventory Create');
    }


    public function update(User $user, Inventory $inventory)
    {
        return $user->hasPermissionTo('Inventory Update');
    }


    public function delete(User $user, Inventory $inventory)
    {
        return $user->hasPermissionTo('Inventory Delete ');
    }


    public function restore(User $user, Inventory $inventory)
    {
        //
    }


    public function forceDelete(User $user, Inventory $inventory)
    {
        //
    }
}
