<?php

namespace App\Policies;

use App\User;
use App\Visitor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the visitor.
     *
     * @param  \App\User  $user
     * @param  \App\Visitor  $visitor
     * @return mixed
     */
    public function view(User $user, Visitor $visitor)
    {
        return $user->id === $visitor->user->id || $user->name === 'admin';
    }

    /**
     * Determine whether the user can delete the visitor.
     *
     * @param  \App\User  $user
     * @param  \App\Visitor  $visitor
     * @return mixed
     */
    public function delete(User $user, Visitor $visitor)
    {
	    return $user->name === 'admin';
    }
}
