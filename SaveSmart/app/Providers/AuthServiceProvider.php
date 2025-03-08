<?php

namespace App\Providers;

use App\Models\FamilyAccount;
use App\Models\SavingsGoal;
use App\Policies\FamilyAccountPolicy;
use App\Policies\SavingsGoalPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        FamilyAccount::class => FamilyAccountPolicy::class,
        SavingsGoal::class => SavingsGoalPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}