<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(){
        $this->registerPolicies();
        Passport::routes();
        Passport::personalAccessClientSecret(
           config('LR7f3UhgRU3x2dzbOM2PIAHhB48yjO1ou08hi1JS')
        );
        Passport::personalAccessClientId(
            config('1')
        );

    }
    
   
}
