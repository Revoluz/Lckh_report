<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('auth.4', function (User $user) {
            if ($user->role->role == 'Administrator'|| $user->role->role == 'Kepala kantor'|| $user->role->role == 'Pengawas'|| $user->role->role == 'Keuangan') {
                return true;
            }
        });
        Gate::define('auth.admin', function (User $user) {
            if ($user->role->role == 'Administrator') {
                return true;
            }
        });
        Gate::define('auth.kepala-kantor', function (User $user) {
            if ($user->role->role == 'Kepala kantor') {
                return true;
            }
        });
        Gate::define('auth.pengawas', function (User $user) {
            if ($user->role->role == 'Pengawas') {
                return true;
            }
        });
        Gate::define('auth.user', function (User $user) {
            if ($user->role->role == 'user') {
                return true;
            }
        });
    }
}
