<?php

use Illuminate\Http\Request;
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

Route::get("/sliders",[\App\Http\Controllers\Api\SliderController::class,"index"]);
Route::get("/categoriesofthe-places",[\App\Http\Controllers\Api\CategoryOfThePlaceController::class,"index"]);
Route::get("/events",[\App\Http\Controllers\Api\EventController::class,"index"]);
