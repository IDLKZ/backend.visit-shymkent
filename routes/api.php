<?php

use App\Http\Controllers\Api\BlogsController;
use App\Http\Controllers\Api\CategoryOfThePlaceController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PlacesController;
use App\Http\Controllers\Api\RoutesController;
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
Route::get('/routes', [RoutesController::class, 'index']);
Route::get('/souvenirs', [SouvenirController::class, 'index']);
Route::get('/blogs', [BlogsController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/places', [PlacesController::class, 'index']);
