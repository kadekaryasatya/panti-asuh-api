<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Program\JenisProgramController;
use App\Http\Controllers\Program\ProgramPantiController;
use App\Http\Controllers\Api\AnakAsuhController;
use App\Http\Controllers\Artikel\ArtikelController;
use App\Http\Controllers\Pengurus_Panti\PengurusPantiController;
use App\Http\Controllers\Program\FotoProgramController;

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


//Auth
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);
      Route::get('users', [AuthController::class, 'getAllUsers']);
      Route::delete('users/{id}', [AuthController::class, 'deleteUser']);
    });
});

//program panti
Route::apiResource('jenis-program', JenisProgramController::class);
Route::apiResource('program-panti', ProgramPantiController::class);
Route::apiResource('foto-program', FotoProgramController::class);


Route::group(['middleware' => 'auth:sanctum'], function() {
  //Pengurus Panti

  //Anak Asuh
});
Route::apiResource('pengurus-panti', PengurusPantiController::class);
Route::apiResource('/anak-asuh', App\Http\Controllers\Anak\AnakAsuhController::class);
// Route::apiResource('/data-penyakit', App\Http\Controllers\Anak\PenyakitController::class);
Route::apiResource('/kesehatan-anak', App\Http\Controllers\Anak\KesehatanAnakController::class);
Route::apiResource('/pendidikan-anak', App\Http\Controllers\Anak\PendidikanAnakController::class);
Route::apiResource('/prestasi-anak', App\Http\Controllers\Anak\PrestasiAnakController::class);
Route::apiResource('/donasi', App\Http\Controllers\Donasi\DonasiController::class);

// Routes without middleware
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show']);

// Routes within the middleware group
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('artikel', ArtikelController::class)->except(['index', 'show']);
});
