<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BlogsController;
use App\Http\Controllers\Api\CategoryOfThePlaceController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PlacesController;
use App\Http\Controllers\Api\RoutesController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SouvenirController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/sliders",[SliderController::class,"index"]);
Route::get("/categoriesofthe-places",[CategoryOfThePlaceController::class,"index"]);
Route::get("/categoriesofthe-places-all",[CategoryOfThePlaceController::class,"getCategories"]);
Route::get("/events",[EventController::class,"index"]);
Route::get("/all-events",[EventController::class,"events"]);
Route::get("/event/{alias}",[EventController::class,"event"]);
Route::get('/routes', [RoutesController::class, 'routes']);
Route::get('/route/{alias}', [RoutesController::class, 'route']);
Route::get('/souvenirs', [SouvenirController::class, 'souvenirs']);
Route::get('/shops', [SouvenirController::class, 'shops']);
Route::get('/craftmans', [SouvenirController::class, 'craftmans']);
Route::get('/souvenir/{alias}', [SouvenirController::class, 'souvenir']);
Route::get('/blogs', [BlogsController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/new/{alias}', [NewsController::class, 'singleNew']);
Route::get('/all-news', [NewsController::class, 'allNews']);
Route::get('/places', [PlacesController::class, 'index']);
Route::get('/shop/{alias}', [SouvenirController::class, 'shop']);
Route::get('/single-place/{alias}', [PlacesController::class, 'singlePlace']);
Route::get('/guides', [RoutesController::class, 'guides']);
Route::get('/guide/{alias}', [RoutesController::class, 'guide']);
Route::get('/agencies', [RoutesController::class, 'agencies']);
Route::get('/agency/{alias}', [RoutesController::class, 'agency']);


Route::post('/register', [LoginController::class, 'register']);
//CABINET
Route::group([

    'middleware' => ['api', 'auth:api'],
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [LoginController::class, 'login'])->withoutMiddleware(['auth:api']);
    Route::get('/user', [LoginController::class, 'user']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'cabinet'], function (){
    Route::get('/user', [UserController::class, 'index']);
    Route::put('/update-info', [UserController::class, 'update']);
    Route::put('/update-agency', [UserController::class, 'agency']);
    Route::put('/update-guide', [UserController::class, 'guide']);
    Route::put('/update-craftman', [UserController::class, 'craftman']);
    Route::put('/update-craft', [UserController::class, 'craft']);
    Route::post('/update-photo', [UserController::class, 'updatePhoto']);
    Route::post('/update-photo-company', [UserController::class, 'updatePhotoCompany']);
    Route::post('/upload-gallery', [UserController::class, 'uploadGallery']);

    Route::get('/my-blogs', [BlogsController::class, 'myBlogs']);
    Route::post('/send-blog', [BlogsController::class, 'sendBlog']);
    Route::get('/my-events', [EventController::class, 'myEvents']);
    Route::post('/send-event', [EventController::class, 'sendEvent']);

    Route::get('/savings', [UserController::class, 'savings']);

    Route::post('/add-save', [UserController::class, 'addSave']);
});

