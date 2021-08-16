<?php

use App\Http\Controllers\Admin\CategoriesPlace;
use App\Http\Controllers\Admin\CategoryPlace;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\SliderController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use \App\Http\Controllers\Admin\CategoryEventsController;
use \App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\RoutePointController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\CategorySouvenirController;
use App\Http\Controllers\Admin\SouvenirController;
use App\Http\Controllers\Admin\OrganizatorController;
use App\Http\Controllers\Admin\CategoryNewsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\WorkdayController;
use App\Http\Controllers\Admin\CategoriesEventsController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\CategoriesOfRouteController;
use App\Http\Controllers\Admin\TypesOfRouteController;
use App\Http\Controllers\Admin\RouteAndTypeController;
use App\Http\Controllers\Admin\RouteAndOrganizatorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::get('/', function (){
            return redirect('/login');
        });


        //Action when register, login, forgot and recovery user
        Route::group(["middleware"=>"guest"],function (){
            Route::get("/login",[AuthController::class,"login"])->name("login");
            Route::get("/register",[AuthController::class,"register"])->name("register");
            Route::post("/auth",[AuthController::class,"auth"])->name("auth");
            Route::post("/registerUser",[AuthController::class,"registerUser"])->name("registerUser");
            Route::get("/verify-email/{alias}",[AuthController::class,"verifyEmail"])->name("verify-email");
            Route::get("/forgot",[AuthController::class,"forgot"])->name("forgot");
            Route::post("/recover-password",[AuthController::class,"recoverPassword"])->name("recover-password");
            Route::get("/recover-email/{alias}",[AuthController::class,"recoverEmail"])->name("recover-email");
            Route::post("/recover",[AuthController::class,"recover"])->name("recover");
        });
        Route::get("/logout",[AuthController::class,"logout"])->name("logout");

        Route::group(["middleware"=>"admin_moderator", 'prefix' => 'admin'],function (){
            Route::get("/main-cabinet",[AdminController::class,"index"])->name("admin-home");
            Route::resource("/admin-user",AdminUserController::class);
            Route::resource('/sliders', SliderController::class);
            Route::resource("/category-events",CategoryEventsController::class);
            Route::resource("/events",EventsController::class);
            Route::resource("/routes",RouteController::class);
            Route::resource("/points",RoutePointController::class);
            Route::resource("/shops",ShopController::class);
            Route::resource("/category-souvenir",CategorySouvenirController::class);
            Route::resource("/souvenirs",SouvenirController::class);
            Route::resource("/organizators",OrganizatorController::class);
            Route::resource("/category-news",CategoryNewsController::class);
            Route::resource("/news",NewsController::class);
            Route::resource("/tags",TagController::class);
            Route::resource("/blogs",BlogController::class);
            Route::resource("/gallery",GalleryController::class);
            Route::resource("/workday",WorkdayController::class);
            Route::resource("/categories-events",CategoriesEventsController::class);
            Route::resource('/places', PlaceController::class);
            Route::resource('/category-place', CategoryPlace::class);
            Route::resource('/categories-place', CategoriesPlace::class);
            Route::resource("/ratings",RatingController::class);
            Route::resource("/route_categories",CategoriesOfRouteController::class);
            Route::resource("/route_types",TypesOfRouteController::class);
            Route::resource("/route_and_type",RouteAndTypeController::class);
            Route::resource("/route_and_organizator",RouteAndOrganizatorController::class);
            Route::group(['middleware' => 'admin'], function (){

            });

        });

});

Route::post('ckeditor/upload', [AdminController::class,"upload"])->name('ckeditor.upload');

