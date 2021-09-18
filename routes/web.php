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
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PhoneController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\RoutePlaceController;
use App\Http\Controllers\Admin\PlaceEventController;
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
//            Sliders
            Route::resource('/sliders', SliderController::class);
//              Events
            Route::resource("/category-events",CategoryEventsController::class);
            Route::resource("/events",EventsController::class);
            Route::resource("/categories-events",CategoriesEventsController::class);
            Route::resource("/place-event",PlaceEventController::class);

//            Routes and Points
            Route::resource("/routes",RouteController::class);
            Route::resource("/points",RoutePointController::class);
            Route::resource("/route_categories",CategoriesOfRouteController::class);
            Route::resource("/route_types",TypesOfRouteController::class);
            Route::resource("/route_and_type",RouteAndTypeController::class);
            Route::resource("/route_and_organizator",RouteAndOrganizatorController::class);
            Route::resource("/route_place", RoutePlaceController::class)->except("show","edit","create");

//            Shops and souvenirs
            Route::resource("/shops",ShopController::class);
            Route::resource("/category-souvenir",CategorySouvenirController::class);
            Route::resource("/souvenirs",SouvenirController::class);
//            Organizators
            Route::resource("/organizators",OrganizatorController::class);
//            Category news and news
            Route::resource("/category-news",CategoryNewsController::class);
            Route::resource("/news",NewsController::class);
//            Tags and blogs
            Route::resource("/tags",TagController::class);
            Route::resource("/blogs",BlogController::class);


            Route::resource("/gallery",GalleryController::class);
            Route::resource("/workday",WorkdayController::class);
//           Place
            Route::resource('/places', PlaceController::class);
            Route::resource('/category-place', CategoryPlace::class);
            Route::resource('/categories-place', CategoriesPlace::class);
//            Contacts
            Route::resource("/phones",PhoneController::class)->except("show","create","edit");
            Route::resource("/emails",EmailController::class)->except("show","create","edit");
            Route::resource("/socials",SocialController::class)->except("show","create","edit");
//            Rating
            Route::resource("/ratings",RatingController::class);

            Route::resource("/reviews",ReviewController::class);
            Route::resource("/settings",SettingController::class,)->except('index','create', 'store', 'edit','show','destroy');
            Route::resource("/partners",PartnerController::class);

            //Backups
            Route::get("/backup",[AdminController::class,"backup"])->name("backup");
            Route::get("/backup-download/{filename}",[AdminController::class,"downloadBackup"])->name("backup-download");
            Route::get("/backup-delete/{filename}",[AdminController::class,"deleteBackup"])->name("backup-delete");
            Route::get("/backup-create",[AdminController::class,"createBackup"])->name("backup-create");

            //Search Controllers
            Route::get("/search-user",[SearchController::class,"user"])->name("search-user");
            Route::get("/search-slider",[SearchController::class,"slider"])->name("search-slider");
            Route::get("/search-category-place",[SearchController::class,"categoryPlace"])->name("search-category-place");
            Route::get("/search-place",[SearchController::class,"place"])->name("search-place");
            Route::get("/search-category-events",[SearchController::class,"categoryEvent"])->name("search-category-events");
            Route::get("/search-event",[SearchController::class,"event"])->name("search-event");
            Route::get("/search-route-categories",[SearchController::class,"routeCategories"])->name("search-route-categories");
            Route::get("/search-route-types",[SearchController::class,"routeTypes"])->name("search-route-types");
            Route::get("/search-route",[SearchController::class,"route"])->name("search-route");
            Route::get("/search-point",[SearchController::class,"point"])->name("search-point");
            Route::get("/search-shop",[SearchController::class,"shop"])->name("search-shop");
            Route::get("/search-category-souvenir",[SearchController::class,"categorySouvenir"])->name("search-category-souvenir");
            Route::get("/search-souvenir",[SearchController::class,"souvenir"])->name("search-souvenir");
            Route::get("/search-organizator",[SearchController::class,"organizator"])->name("search-organizator");
            Route::get("/search-category-news",[SearchController::class,"categoryNews"])->name("search-category-news");
            Route::get("/search-news",[SearchController::class,"news"])->name("search-news");
            Route::get("/search-tag",[SearchController::class,"tag"])->name("search-tag");
            Route::get("/search-blog",[SearchController::class,"blog"])->name("search-blog");

            Route::group(['middleware' => 'admin'], function (){

            });

        });

});

Route::post('ckeditor/upload', [AdminController::class,"upload"])->name('ckeditor.upload');

Route::get("/test",[AdminController::class,"test"]);
