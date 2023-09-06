<?php

namespace App\Policies;

use App\Models\HealthConcern;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HealthConcernPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can manage events.
    public function manage(User $user)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can list models.
    public function viewList(User $user)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can view the HealthConcern.
    public function view(User $user, HealthConcern $healthConcern)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can create HealthConcern.
    public function create(User $user)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can update the HealthConcern.
    public function update(User $user, HealthConcern $healthConcern)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can delete the HealthConcern.
    public function delete(User $user, HealthConcern $healthConcern)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can restore the HealthConcern.
    public function restore(User $user, HealthConcern $healthConcern)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can permanently delete the HealthConcern.
    public function forceDelete(User $user, HealthConcern $healthConcern)
    {
        if($user->id)
            return true;
    }
}
