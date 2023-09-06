<?php

namespace App\Policies;

use App\Models\WorkplaceInvestigation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkplaceInvestigationPolicy
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


    public function view(User $user, WorkplaceInvestigation $workplaceInvestigation)
    {
        if($user->id)
            return true;

    }

    public function create(User $user)
    {
        if($user->id)
            return true;
    }

    public function update(User $user, WorkplaceInvestigation $workplaceInvestigation)
    {
        if($user->id)
            return true;
    }

    public function delete(User $user, WorkplaceInvestigation $workplaceInvestigation)
    {
        if($user->id)
            return true;
    }

    public function restore(User $user, WorkplaceInvestigation $workplaceInvestigation)
    {
        if($user->id)
            return true;
    }

    public function forceDelete(User $user, WorkplaceInvestigation $workplaceInvestigation)
    {
        if($user->id)
            return true;
    }
}
