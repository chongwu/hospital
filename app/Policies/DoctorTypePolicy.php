<?php

namespace App\Policies;

use App\User;
use App\DoctorType;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create doctorTypes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->name === 'admin';
    }

    /**
     * Determine whether the user can update the doctorType.
     *
     * @param  \App\User  $user
     * @param  \App\DoctorType  $doctorType
     * @return mixed
     */
    public function update(User $user, DoctorType $doctorType)
    {
        return $user->name === 'admin';
    }

    /**
     * Determine whether the user can delete the doctorType.
     *
     * @param  \App\User  $user
     * @param  \App\DoctorType  $doctorType
     * @return mixed
     */
    public function delete(User $user, DoctorType $doctorType)
    {
        return $user->name === 'admin';
    }
}
