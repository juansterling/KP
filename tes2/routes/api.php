<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\MahasiswaApiController;
use App\Http\Controllers\api\SemesterApiController;
use App\Http\Controllers\api\MatkulApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("/mahasiswa",[MahasiswaApiController::class, "getMahasiswa"]);
Route::get("/semester",[SemesterApiController::class, "getSemester"]);
Route::post("/semester",[SemesterApiController::class, "insertSemester"]);
Route::patch("/semester",[SemesterApiController::class, "updateSemester"]);
Route::delete("/semester",[SemesterApiController::class, "deleteSemester"]);
Route::get("/matkul",[MatkulApiController::class, "getMatkul"]);

