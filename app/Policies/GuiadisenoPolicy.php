<?php

namespace App\Policies;

use App\Models\Guiadiseno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

//php artisan make:policy GuiadisenoPolicy --model=Guiadiseno
class GuiadisenoPolicy
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


    public function view(User $user, Guiadiseno $guiadiseno)
    {
        return $user->hasPermissionTo('Guiadiseno View');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Guiadiseno Create');
    }


    public function update(User $user, Guiadiseno $guiadiseno)
    {
        return $user->hasPermissionTo('Guiadiseno Update');
    }


    public function delete(User $user, Guiadiseno $guiadiseno)
    {
        return $user->hasPermissionTo('Guiadiseno Delete');
    }


    public function restore(User $user, Guiadiseno $guiadiseno)
    {
        //
    }


    public function forceDelete(User $user, Guiadiseno $guiadiseno)
    {
        //
    }
}
