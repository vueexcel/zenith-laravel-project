<?php

namespace App\Policies;

use App\Models\FireIncident;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FireIncidentPolicy
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

    //Determine whether the user can view the FireIncident.
    public function view(User $user, FireIncident $fire_incident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can create FireIncident.
    public function create(User $user)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can update the FireIncident.
    public function update(User $user, FireIncident $fire_incident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can delete the FireIncident.
    public function delete(User $user, FireIncident $fire_incident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can restore the FireIncident.
    public function restore(User $user, FireIncident $fire_incident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can permanently delete the FireIncident.
    public function forceDelete(User $user, FireIncident $fire_incident)
    {
        if($user->id)
            return true;
    }
}
