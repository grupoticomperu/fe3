<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
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

    public function view(User $user, Brand $brand)
    {

        return $user->hasPermissionTo('Brand View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Brand Create');
    }


    public function update(User $user, Brand $brand)
    {
        return $user->hasPermissionTo('Brand Update');
    }


    public function delete(User $user, Brand $brand)
    {
        return $user->hasPermissionTo('Brand Delete ');
    }


    public function restore(User $user, Brand $brand)
    {
        //
    }


    public function forceDelete(User $user, Brand $brand)
    {
        //
    }

}
