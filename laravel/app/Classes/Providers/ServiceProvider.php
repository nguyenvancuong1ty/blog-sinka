<?php

namespace App\Classes\Providers;

use App\Classes\Services\Interfaces\ICategoryService;
use App\Classes\Services\Service\CategoryService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as AppProvider;

class ServiceProvider extends AppProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        App::bind(ICategoryService::class, CategoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
