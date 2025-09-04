<?php

namespace App\Providers;

//use App\Entities\User;
//use App\Repositories\UserRepository;
use App\Repositories\MovieRepository;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MovieRepository::class, function ($app) {
            return new MovieRepository($app->make(EntityManager::class));
        });
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
