<?php

namespace App\Policies;

use App\Models\QuickNearMiss;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuickNearMissPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if($user->id)
            return true;
    }

    /**
     * Determine whether the user can manage events.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function manage(User $user)
    {
        if($user->id)
            return true;
    }

    /**
     * Determine whether the user can list models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewList(User $user)
    {
        if($user->id)
            return true;
    }

    /**
     * Determine whether the user can view the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function view(User $user, QuickNearMiss $quickNearMiss)
    {
        //
        if($user->id)
            return true;

    }

    /**
     * Determine whether the user can create members.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        if($user->id)
            return true;
    }

    /**
     * Determine whether the user can update the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function update(User $user, QuickNearMiss $quickNearMiss)
    {
        //
        if($user->id)
            return true;
    }

    /**
     * Determine whether the user can delete the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function delete(User $user, QuickNearMiss $quickNearMiss)
    {
        //
        if($user->id)
            return true;
    }

    /**
     * Determine whether the user can restore the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function restore(User $user, QuickNearMiss $quickNearMiss)
    {
        //
        if($user->id)
            return true;
    }

    //Determine whether the user can permanently delete the QuickNearMiss.
    public function forceDelete(User $user, QuickNearMiss $quickNearMiss)
    {
        //
        if($user->id)
            return true;
    }
}
