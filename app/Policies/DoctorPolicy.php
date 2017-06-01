<?php

namespace App\Policies;

use App\User;
use App\Doctor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create doctors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->name === 'admin';
    }

    /**
     * Determine whether the user can update the doctor.
     *
     * @param  \App\User  $user
     * @param  \App\Doctor  $doctor
     * @return mixed
     */
    public function update(User $user, Doctor $doctor)
    {
	    return $user->name === 'admin';
    }

    /**
     * Determine whether the user can delete the doctor.
     *
     * @param  \App\User  $user
     * @param  \App\Doctor  $doctor
     * @return mixed
     */
    public function delete(User $user, Doctor $doctor)
    {
	    return $user->name === 'admin';
    }
}
