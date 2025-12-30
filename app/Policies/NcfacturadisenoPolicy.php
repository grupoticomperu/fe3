<?php

namespace App\Policies;

use App\Models\Ncfacturadiseno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NcfacturadisenoPolicy
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

    
    public function view(User $user, Ncfacturadiseno $ncfacturadiseno)
    {
        return $user->hasPermissionTo('Ncfacturadiseno View');
    }

   
    public function create(User $user)
    {
        return $user->hasPermissionTo('Ncfacturadiseno Create');
    }

    
    public function update(User $user, Ncfacturadiseno $ncfacturadiseno)
    {
        return $user->hasPermissionTo('Ncfacturadiseno Update');
    }

    
    public function delete(User $user, Ncfacturadiseno $ncfacturadiseno)
    {
       return $user->hasPermissionTo('Ncfacturadiseno Delete');
    }

  
    public function restore(User $user, Ncfacturadiseno $ncfacturadiseno)
    {
        //
    }

   
    public function forceDelete(User $user, Ncfacturadiseno $ncfacturadiseno)
    {
        //
    }
}
