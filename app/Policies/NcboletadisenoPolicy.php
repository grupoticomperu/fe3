<?php

namespace App\Policies;

use App\Models\Ncboletadiseno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NcboletadisenoPolicy
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

    
    public function view(User $user, Ncboletadiseno $ncboletadiseno)
    {
        return $user->hasPermissionTo('Ncboletadiseno View');
    }

   
    public function create(User $user)
    {
        return $user->hasPermissionTo('Ncboletadiseno Create');
    }

    
    public function update(User $user, Ncboletadiseno $ncboletadiseno)
    {
        return $user->hasPermissionTo('Ncboletadiseno Update');
    }

    
    public function delete(User $user, Ncboletadiseno $ncboletadiseno)
    {
        return $user->hasPermissionTo('Ncboletadiseno Delete');
    }

   
    public function restore(User $user, Ncboletadiseno $ncboletadiseno)
    {
        //
    }

   
    public function forceDelete(User $user, Ncboletadiseno $ncboletadiseno)
    {
        //
    }
}
