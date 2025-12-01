<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
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


    public function view(User $user, Sale $sale)
    {
        return $user->hasPermissionTo('Sale View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Sale Create');
    }


    public function update(User $user, Sale $sale)
    {
        return $user->hasPermissionTo('Sale Update');
    }


    public function delete(User $user, Sale $sale)
    {
        return $user->hasPermissionTo('Sale Delete ');
    }


    public function restore(User $user, Sale $sale)
    {
        //
    }


    public function forceDelete(User $user, Sale $sale)
    {
        //
    }
}
