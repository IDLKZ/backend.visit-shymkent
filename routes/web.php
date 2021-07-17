<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
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

        Route::group(["middleware"=>"admin_moderator"],function (){
            Route::get("/main-cabinet",[AdminController::class,"index"])->name("admin-home");
            Route::resource("/admin-user",AdminUserController::class);
        });










});
