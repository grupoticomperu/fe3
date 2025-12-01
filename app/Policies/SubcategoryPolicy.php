<?php

namespace App\Policies;

use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubcategoryPolicy
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


    public function view(User $user, Subcategory $subcategory)
    {
        return $user->hasPermissionTo('Subategory View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Subcategory Create');
    }


    public function update(User $user, Subcategory $subcategory)
    {
        return $user->hasPermissionTo('Subcategory Update');
    }


    public function delete(User $user, Subcategory $subcategory)
    {
        return $user->hasPermissionTo('Subcategory Delete');
    }


    public function restore(User $user, Subcategory $subcategory)
    {
        //
    }


    public function forceDelete(User $user, Subcategory $subcategory)
    {
        //
    }
}
