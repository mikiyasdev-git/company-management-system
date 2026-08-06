<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;

use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\ProjectRepository;

use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Repositories\TaskRepository;

use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Repositories\ReportRepository;

use App\Services\Contracts\AuthServiceInterface;
use App\Services\AuthService;

use App\Services\Contracts\ProjectServiceInterface;
use App\Services\ProjectService;

use App\Services\Contracts\TaskServiceInterface;
use App\Services\TaskService;

use App\Services\Contracts\ReportServiceInterface;
use App\Services\ReportService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
{
    // Repository Bindings
    $this->app->bind(
        UserRepositoryInterface::class,
        UserRepository::class
    );

    $this->app->bind(
        ProjectRepositoryInterface::class,
        ProjectRepository::class
    );

    $this->app->bind(
        TaskRepositoryInterface::class,
        TaskRepository::class
    );

    $this->app->bind(
    ReportRepositoryInterface::class,
    ReportRepository::class
);

$this->app->bind(
    ReportServiceInterface::class,
    ReportService::class
);

    // Service Bindings
    $this->app->bind(
        AuthServiceInterface::class,
        AuthService::class
    );

    $this->app->bind(
        ProjectServiceInterface::class,
        ProjectService::class
    );

    $this->app->bind(
        TaskServiceInterface::class,
        TaskService::class
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
