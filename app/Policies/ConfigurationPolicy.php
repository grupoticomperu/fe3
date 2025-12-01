<?php

namespace App\Policies;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if($user->hasRole('Admin'))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Configuration $configuration)
    {
        return $user->hasPermissionTo('Configuration View');
    }


    public function create(User $user)
    {

    }


    public function update(User $user, Configuration $configuration)
    {
        return $user->hasPermissionTo('Configuration Update');
    }


    public function delete(User $user, Configuration $configuration)
    {
        //
    }


    public function restore(User $user, Configuration $configuration)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Configuration $configuration)
    {
        //
    }
}
