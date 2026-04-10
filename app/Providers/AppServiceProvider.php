<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Requests\LoginRequest;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('categories')) {
            View::share('categories', Category::orderBy('name')->get());
        }

        Paginator::useBootstrapFive();

        $this->app->bind(FortifyLoginRequest::class, LoginRequest::class);
    }
}
