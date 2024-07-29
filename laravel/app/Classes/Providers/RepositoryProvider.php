<?php

namespace App\Classes\Providers;

use App\Classes\Repositories\Interfaces\ICategoryRepository;
use App\Classes\Repositories\Repository\CategoryRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        App::bind(ICategoryRepository::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
