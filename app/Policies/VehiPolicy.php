<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehi;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any vehis.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role === 'propietario';
    }

    /**
     * Determine whether the user can view the vehi.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vehi  $vehi
     * @return mixed
     */
    public function view(User $user, Vehi $vehi)
    {
        return $user->role === 'propietario' && $vehi->propio->correo_propietario === $user->email;
    }
}