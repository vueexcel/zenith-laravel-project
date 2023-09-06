<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Member::class => \App\Policies\MemberPolicy::class,
        \App\Models\HealthConcern::class => \App\Policies\HealthConcernPolicy::class,
        \App\Models\Accident::class => \App\Policies\AccidentPolicy::class,
        \App\Models\FireIncident::class => \App\Policies\FireIncidentPolicy::class,
        \App\Models\QuickNearMiss::class => \App\Policies\QuickNearMissPolicy::class,
        \App\Models\WorkplaceInvestigation::class => \App\Policies\WorkplaceInvestigationPolicy::class,
        \App\Models\ReducedFlexibility::class => \App\Policies\ReducedFlexibilityPolicy::class,
        \App\Models\ContractorAccident::class => \App\Policies\ContractorAccidentPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
