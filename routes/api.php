<?php

use App\Http\Controllers\Api\BlogsController;
use App\Http\Controllers\Api\CategoryOfThePlaceController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PlacesController;
use App\Http\Controllers\Api\RoutesController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SouvenirController;
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
Route::get('/routes', [RoutesController::class, 'index']);
Route::get('/route/{alias}', [RoutesController::class, 'route']);
Route::get('/souvenirs', [SouvenirController::class, 'index']);
Route::get('/souvenir/{alias}', [SouvenirController::class, 'souvenir']);
Route::get('/blogs', [BlogsController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/all-news', [NewsController::class, 'allNews']);
Route::get('/places', [PlacesController::class, 'index']);
Route::get('/shop/{alias}', [ShopController::class, 'shop']);
Route::get('/single-place/{alias}', [PlacesController::class, 'singlePlace']);
