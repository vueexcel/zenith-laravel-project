<?php

namespace App\Policies;

use App\Models\Accident;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccidentPolicy
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

    //Determine whether the user can view the Accident.
    public function view(User $user, Accident $accident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can create Accident.
    public function create(User $user)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can update the Accident.
    public function update(User $user, Accident $accident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can delete the Accident.
    public function delete(User $user, Accident $accident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can restore the Accident.
    public function restore(User $user, Accident $accident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can permanently delete the Accident.
    public function forceDelete(User $user, Accident $accident)
    {
        if($user->id)
            return true;
    }
}
