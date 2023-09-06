<?php

namespace App;

use App\Models\Accident;
use App\Models\ContractorAccident;
use App\Models\HealthConcern;
use App\Models\Member;
use App\Models\ReducedFlexibility;
use App\Models\WorkplaceInvestigation;
use App\User;
use Illuminate\Support\Facades\Auth;

class Reports
{
    private $totalUsers;
    private $totalMembers;
    private $totalHealthConcerns;
    private $totalAccidents;
    private $totalIncidentInvestigations;
    private $totalReducedFlexibility;
    private $totalContractorAccidents;

    /**
     * @return integer
     */
    public function getTotalUsers()
    {
        if (is_null($this->totalUsers)) {
            $this->totalUsers = User::count();
        }

        return $this->totalUsers;
    }

    public function getTotalMembers()
    {
        if (is_null($this->totalMembers)) {
            $this->totalMembers = Member::where('is_deleted', 0)->count();
        }

        return $this->totalMembers;
    }

    public function getTotalHealthConcerns()
    {
        if (is_null($this->totalHealthConcerns)) {
            $this->totalHealthConcerns = HealthConcern::where('is_deleted', 0)->count();
        }

        return $this->totalHealthConcerns;
    }

    public function getTotalAccidents()
    {
        if (is_null($this->totalAccidents)) {
            $this->totalAccidents = Accident::where('is_deleted', 0)->count();
        }

        return $this->totalAccidents;
    }

    public function getIncidentInvestigations()
    {
        if (is_null($this->totalIncidentInvestigations)) {
            $this->totalIncidentInvestigations = WorkplaceInvestigation::where('is_deleted', 0)->count();
        }

        return $this->totalIncidentInvestigations;
    }

    public function getTotalReducedFlexibility()
    {
        if (is_null($this->totalReducedFlexibility)) {
            $this->totalReducedFlexibility = ReducedFlexibility::where('is_deleted', 0)->count();
        }

        return $this->totalReducedFlexibility;
    }

    public function getTotalContractorAccidents()
    {
        if (is_null($this->totalContractorAccidents)) {
            $this->totalContractorAccidents = ContractorAccident::where('is_deleted', 0)->count();
        }

        return $this->totalContractorAccidents;
    }
}
