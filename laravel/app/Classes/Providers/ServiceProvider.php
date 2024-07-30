<?php

namespace App\Classes\Providers;

use App\Classes\Services\Interfaces\ICategoryService;
use App\Classes\Services\Interfaces\IImageService;
use App\Classes\Services\Interfaces\IPostService;
use App\Classes\Services\Service\CategoryService;
use App\Classes\Services\Service\ImageService;
use App\Classes\Services\Service\PostService;
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
        App::bind(IPostService::class, PostService::class);
        App::bind(IImageService::class, ImageService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
