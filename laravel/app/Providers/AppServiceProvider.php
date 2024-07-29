<?php

namespace App\Providers;

use App\Classes\Providers as Provider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as AppPro;

class AppServiceProvider extends AppPro
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::register(Provider\RepositoryProvider::class);
        App::register(Provider\ServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
