<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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

    public function view(User $user, Category $category)
    {
        return $user->hasPermissionTo('Category View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Category Create');
    }


    public function update(User $user, Category $category)
    {
        return $user->hasPermissionTo('Category Update');
    }


    public function delete(User $user, Category $category)
    {
        return $user->hasPermissionTo('Category Delete');
    }


    public function restore(User $user, Category $category)
    {
        //
    }


    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
