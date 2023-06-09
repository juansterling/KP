<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\SemesterController;
use App\Http\Middleware\adminrole;

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

Route::redirect('/', '/home', 301);

    Route::get('/home', [MahasiswaController::class, "index"]);
    Route::get('/matkul', [MatkulController::class, "index"]);
    Route::get('/semester', [SemesterController::class, "index"]);
    // Route::get('/home/delete/{delnrp}', [MahasiswaController::class,"destroy"]);
    Route::get('/home/edit/{mahasiswa}', [MahasiswaController::class, "edit"]);
    Route::get('/matkul/edit/{matkul}', [MatkulController::class, "edit"]);
    Route::get('/semester/edit/{semester}', [SemesterController::class, "edit"]);
    Route::patch('/home/edit/{mahasiswa}', [MahasiswaController::class, "update"]);
    Route::patch('/matkul/edit/{matkul}', [MatkulController::class, "update"]);
    Route::patch('/semester/edit/{semester}', [SemesterController::class, "update"]);
    // Route::post('/home/edit/{mahasiswa}', [MahasiswaController::class,"update"]);
    Route::post('/add', [MahasiswaController::class, "store"]);
    Route::post('/addmatkul', [MatkulController::class, "store"]);
    Route::post('/addsemester', [SemesterController::class, "store"]);
    Route::delete('/home/delete/{delnrp}', [MahasiswaController::class, "destroy"]);
    Route::delete('/matkul/delete/{delidmatkul}', [MatkulController::class, "destroy"]);
    Route::delete('/semester/delete/{delidsemester}', [SemesterController::class, "destroy"]);

