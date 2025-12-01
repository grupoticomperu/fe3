<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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


    public function view(User $user, Product $product)
    {
        return $user->hasPermissionTo('Product View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Product Create');
    }


    public function update(User $user, Product $product)
    {
        return $user->hasPermissionTo('Product Update');
    }


    public function delete(User $user, Product $product)
    {
        return $user->hasPermissionTo('Product Delete ');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
