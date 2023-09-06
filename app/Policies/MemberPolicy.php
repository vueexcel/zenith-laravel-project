<?php

namespace App\Policies;

use App\User;
use App\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
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
    public function view(User $user, Member $member)
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
    public function update(User $user, Member $member)
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
    public function delete(User $user, Member $member)
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
    public function restore(User $user, Member $member)
    {
        //
        if($user->id)
            return true;
    }

    /**
     * Determine whether the user can permanently delete the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function forceDelete(User $user, Member $member)
    {
        //
        if($user->id)
            return true;
    }
}
