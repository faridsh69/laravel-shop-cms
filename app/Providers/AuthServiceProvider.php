<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    const PERMISSIONS = [
        1 => 'agent', 
        2 => 'coworker',
        3 => 'marketer',
        4 => 'general_manager',
        5 => 'content_manager',
        6 => 'product_manager',
        7 => 'factor_manager',
        8 => 'advertise_manager',
        9 => 'forum_manager',
        10 => 'user_manager',
        11 => 'payment_manager',
        12 => 'category_manager',
        13 => 'comment_manager',
        14 => 'developer',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    private function _check_permission($user,$permission_key)
    {
        $roles = $user->roles()->get();
        foreach($roles as $role)
        {
            if( is_array(json_decode($role->permissions)) )
            {
                if(array_search($permission_key, json_decode($role->permissions)) !== false)
                {
                    return true;
                }
            }else{
                return false;
            }
        } 
        return false;
    }

    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Gate::define('general_manager', function ($user) {
            return $this->_check_permission($user, 4);
        });
        Gate::define('content_manager', function ($user) {
            return $this->_check_permission($user, 5);
        });
        Gate::define('product_manager', function ($user) {
            return $this->_check_permission($user, 6);
        });
        Gate::define('factor_manager', function ($user) {
            return $this->_check_permission($user, 7);
        });
        Gate::define('advertise_manager', function ($user) {
            return $this->_check_permission($user, 8);
        });
        Gate::define('forum_manager', function ($user) {
            return $this->_check_permission($user, 9);
        });
        Gate::define('user_manager', function ($user) {
            return $this->_check_permission($user, 10);
        });
        Gate::define('payment_manager', function ($user) {
            return $this->_check_permission($user, 11);
        });
        Gate::define('category_manager', function ($user) {
            return $this->_check_permission($user, 12);
        });
        Gate::define('comment_manager', function ($user) {
            return $this->_check_permission($user, 13);
        });
        Gate::define('marketer', function ($user) {
            return $this->_check_permission($user, 3);
        });
        Gate::define('developer', function ($user) {
            return $this->_check_permission($user, 14);
        });


        // \App::environment('production') || 
        // ->middleware('can:developer')
        // @can('developer')      @endcan
        // if (\Gate::allows('developer')) {
        // }
    }
}
