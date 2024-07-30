<?php

namespace App\Classes\Providers;

use App\Classes\Repositories\Interfaces\ICategoryRepository;
use App\Classes\Repositories\Interfaces\IImageRepository;
use App\Classes\Repositories\Interfaces\IPostRepository;
use App\Classes\Repositories\Repository\CategoryRepository;
use App\Classes\Repositories\Repository\ImageRepository;
use App\Classes\Repositories\Repository\PostRepository;
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
        App::bind(IPostRepository::class, PostRepository::class);
        App::bind(IImageRepository::class, ImageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
