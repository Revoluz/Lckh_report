<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Lckh_reports;
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
        Gate::define('auth.3', function (User $user) {
            if ($user->role->role == 'Administrator'|| $user->role->role == 'Kepala kantor'|| $user->role->role == 'Pengawas') {
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
            if ($user->role->role == 'User') {
                return true;
            }
        });
        Gate::define('lckh.show',function(User $user, $userLckh){
            // dd($user->id);
            if($user->id != $userLckh->user_id){
                return false;
            }else{
                return true;
            }
            // true;
        });
        Gate::define('lckh.showPengawas', function (User $user, $userLckh) {
            // dd($user->id);
            $work_place = $userLckh->user->work_place->work_place;
            if ($user->work_place->work_place != $work_place) {
                return false;
            } else {
                return true;
            }
            // true;
        });
        Gate::define('document.show',function(User $user, $document){
            if( $user->id!= $document->user_id){
                return false;
            }else{
                return true;
            }
        });
    }
}
