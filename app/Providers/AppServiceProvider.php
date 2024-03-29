<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Blade::if('admin', function (){
            return Auth::user()->role_id == 1 ? true : false;
        });Blade::if('admin_moderator', function (){
            return Auth::user()->role_id == 1 || Auth::user()->role_id == 2 ? true : false;
        });
        Blade::if('moderator', function (){
            return Auth::user()->role_id == 2 ? true : false;
        });
    }
}
