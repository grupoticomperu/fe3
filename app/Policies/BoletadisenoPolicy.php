<?php

namespace App\Policies;

use App\Models\Boletadiseno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


//php artisan make:policy BoletadisenoPolicy --model=Boletadiseno
class BoletadisenoPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }


    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Boletadiseno $boletadiseno)
    {
        return $user->hasPermissionTo('Boletadiseno View');
    }




    public function create(User $user)
    {
        return $user->hasPermissionTo('Boletadiseno Create');
    }


    public function update(User $user, Boletadiseno $boletadiseno)
    {
        return $user->hasPermissionTo('Boletadiseno Update');
    }


    public function delete(User $user, Boletadiseno $boletadiseno)
    {
         return $user->hasPermissionTo('Boletadiseno Delete ');
    }

    public function restore(User $user, Boletadiseno $boletadiseno)
    {
        //
    }


    public function forceDelete(User $user, Boletadiseno $boletadiseno)
    {
        //
    }
}
