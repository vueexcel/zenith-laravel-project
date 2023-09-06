<?php

namespace App\Policies;

use App\Models\ReducedFlexibility;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReducedFlexibilityPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if($user->id)
            return true;
    }

    public function manage(User $user)
    {
        if($user->id)
            return true;
    }

    public function viewList(User $user)
    {
        if($user->id)
            return true;
    }

    public function view(User $user, ReducedFlexibility $reduced_flexibility)
    {
        if($user->id)
            return true;

    }

    public function create(User $user)
    {
        if($user->id)
            return true;
    }

    public function update(User $user, ReducedFlexibility $reduced_flexibility)
    {
        if($user->id)
            return true;
    }

    public function delete(User $user, ReducedFlexibility $reduced_flexibility)
    {
        if($user->id)
            return true;
    }

    public function restore(User $user, ReducedFlexibility $reduced_flexibility)
    {
        if($user->id)
            return true;
    }

    public function forceDelete(User $user, ReducedFlexibility $reduced_flexibility)
    {
        if($user->id)
            return true;
    }
}
