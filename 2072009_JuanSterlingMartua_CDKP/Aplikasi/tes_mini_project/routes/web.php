<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\StudioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/theater', 301);
Route::GET('/theater', [TheaterController::class, "index_theater"]);
Route::POST('/theater', [TheaterController::class, "store_theater"]);
Route::PATCH('/theater', [TheaterController::class, "update_theater"]);
Route::DELETE('/theater', [TheaterController::class, "delete_theater"]);

Route::GET('/film', [FilmController::class, "index_film"]);
Route::POST('/film', [FilmController::class, "store_film"]);
Route::PATCH('/film', [FilmController::class, "update_film"]);
Route::DELETE('/film', [FilmController::class, "delete_film"]);

Route::GET('/studio', [StudioController::class, "index_studio"]);
Route::POST('/studio', [StudioController::class, "store_studio"]);
Route::PATCH('/studio', [StudioController::class, "update_studio"]);
Route::DELETE('/studio', [StudioController::class, "delete_studio"]);
