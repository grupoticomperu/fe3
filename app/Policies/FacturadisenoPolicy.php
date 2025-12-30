<?php

namespace App\Policies;

use App\Models\Facturadiseno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

//php artisan make:policy FacturadisenoPolicy --model=Facturadiseno
class FacturadisenoPolicy
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

    
    public function view(User $user, Facturadiseno $facturadiseno)
    {
         return $user->hasPermissionTo('Facturadiseno View');
    }

    
    public function create(User $user)
    {
        return $user->hasPermissionTo('Facturadiseno Create');
    }

   
    public function update(User $user, Facturadiseno $facturadiseno)
    {
         return $user->hasPermissionTo('Facturadiseno Update');
    }

   
    public function delete(User $user, Facturadiseno $facturadiseno)
    {
        return $user->hasPermissionTo('Facturadiseno Delete ');
    }

   
    public function restore(User $user, Facturadiseno $facturadiseno)
    {
        //
    }

   
    public function forceDelete(User $user, Facturadiseno $facturadiseno)
    {
        //
    }
}
