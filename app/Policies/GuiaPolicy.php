<?php

namespace App\Policies;

use App\Models\Guia;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuiaPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Guia $guia)
    {
        return $user->hasPermissionTo('Guia View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Guia Create');
    }


    public function update(User $user, Guia $guia)
    {
        return $user->hasPermissionTo('Guia Update');
    }


    public function delete(User $user, Guia $guia)
    {
        return $user->hasPermissionTo('Guia Delete ');
    }
}
