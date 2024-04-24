<?php

namespace App\Providers;

use App\Interface\InterfaceAuth;
use App\Repositories\AuthRepositories;
use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(InterfaceAuth::class, AuthRepositories::class);
        app()->bind(AuthService::class, function ($app) {
            return new AuthService($app->make(InterfaceAuth::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
