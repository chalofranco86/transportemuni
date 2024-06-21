<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bitacora;
use Illuminate\Auth\Access\HandlesAuthorization;

class BitacoraPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the bitacora.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->role === 'superadmin';
    }
}