<?php

namespace App\Providers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->permission_id == 1;
        });
        Gate::define('camaba', function (User $user) {
            return $user->permission_id == 2;
        });
        Gate::define('monitor', function (User $user) {
            return $user->permission_id == 3 || $user->permission_id == 1;
        });
        Gate::define('keuangan', function (User $user) {
            return $user->permission_id == 4 || $user->permission_id == 1;
        });
        Gate::define('kesehatan', function (User $user) {
            return $user->permission_id == 5 || $user->permission_id == 1 || $user->permission_id == 3;
        });
    }
}
