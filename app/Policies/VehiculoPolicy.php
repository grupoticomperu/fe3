<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Vehiculo;

class VehiculoPolicy
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


    public function view(User $user, Vehiculo $vehiculo)
    {

        return $user->hasPermissionTo('Vehiculo View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Vehiculo Create');
    }


    public function update(User $user, Vehiculo $vehiculo)
    {
        return $user->hasPermissionTo('Vehiculo Update');
    }


    public function delete(User $user, Vehiculo $vehiculo)
    {
        return $user->hasPermissionTo('Vehiculo Delete');
    }
}
