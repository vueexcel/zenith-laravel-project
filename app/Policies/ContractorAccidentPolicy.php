<?php

namespace App\Policies;

use App\Models\ContractorAccident;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractorAccidentPolicy
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

    //Determine whether the user can view the Contractor Accident.
    public function view(User $user, ContractorAccident $contractorAccident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can create Contractor Accident.
    public function create(User $user)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can update the Contractor Accident.
    public function update(User $user, ContractorAccident $contractorAccident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can delete the Contractor Accident.
    public function delete(User $user, ContractorAccident $contractorAccident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can restore the Contractor Accident.
    public function restore(User $user, ContractorAccident $contractorAccident)
    {
        if($user->id)
            return true;
    }

    //Determine whether the user can permanently delete the Contractor Accident.
    public function forceDelete(User $user, ContractorAccident $contractorAccident)
    {
        if($user->id)
            return true;
    }
}
