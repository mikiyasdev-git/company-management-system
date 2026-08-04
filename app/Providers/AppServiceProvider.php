<?php

namespace App\Providers;

use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\AuthService;
use App\Services\Contracts\ProjectServiceInterface;
use App\Services\ProjectService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
{
    $this->app->bind(
        UserRepositoryInterface::class,
        UserRepository::class,

    );

    $this->app->bind(
        ProjectRepositoryInterface::class,
        ProjectRepository::class
    );

     $this->app->bind(
        ProjectServiceInterface::class,
        ProjectService::class
    );

    $this->app->bind(
        AuthServiceInterface::class,
        AuthService::class
    );
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
