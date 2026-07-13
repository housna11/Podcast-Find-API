<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;


// use Illuminate\Support\Facades\Gate;
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
        Gate::define('gerer_users',function($user){
            return $user->role==='administrateur';
        });


        Gate::define('gerer_podcasts', function($user, $podcast = null) {
        if ($user->role === 'administrateur') return true;

        if ($user->role === 'animateur' && $podcast) {
            return $podcast->user_id === $user->id;
        }

        return false;
    });


    }
}
