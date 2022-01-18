<?php

namespace App\Providers;

use App\Services\Auth\JwtGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      'App\Models\Project' => 'App\Policies\ProjectPolicy',
      'App\Models\Task' => 'App\Policies\TaskPolicy',
      'App\Models\User' => 'App\Policies\UserPolicy',
      'App\Models\ForumPost' => 'App\Policies\ForumPostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('jwt', function($app, $name, array $config){
          return new JTWGuard(Auth::creatingUserProvider($config['provider']));
        });
    }
}
