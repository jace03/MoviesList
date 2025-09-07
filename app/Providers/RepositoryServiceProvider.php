<?php

namespace App\Providers;

use App\Contracts\ActorRepositoryInterface;
use App\Contracts\HolidayRepositoryInterface;
use App\Contracts\MovieRepositoryInterface;
use App\Repositories\ActorRepository;
use App\Repositories\HolidayRepository;
use App\Repositories\MovieRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MovieRepositoryInterface::class, MovieRepository::class);
        $this->app->bind(HolidayRepositoryInterface::class, HolidayRepository::class);
        $this->app->bind(ActorRepositoryInterface::class, ActorRepository::class);
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
