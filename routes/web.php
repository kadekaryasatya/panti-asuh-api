<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard.index');

Auth::routes();


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard.index');

Route::group(['prefix' => 'anak-asuh'], function(){
    Route::get('/data-anak', [App\Http\Controllers\HomeController::class, 'dataAnak'])->name('data-anak.index');
    Route::get('/prestasi-anak', [App\Http\Controllers\HomeController::class, 'prestasiAnak'])->name('prestasi-anak.index');
    Route::get('/kesehatan-anak', [App\Http\Controllers\HomeController::class, 'kesehatanAnak'])->name('kesehatan-anak.index');
    Route::get('/pendidikan-anak', [App\Http\Controllers\HomeController::class, 'pendidikanAnak'])->name('pendidikan-anak.index');
});

Route::group(['prefix' => 'artikel'], function(){
    Route::get('/data-artikel', [App\Http\Controllers\HomeController::class, 'artikel'])->name('data-artikel.index');
});

Route::group(['prefix' => 'pengurus-panti'], function(){
    Route::get('/data-pengurus', [App\Http\Controllers\HomeController::class, 'pengurusPanti'])->name('data-pengurus.index');
});

Route::group(['prefix' => 'program-panti'], function(){
    Route::get('/data-program', [App\Http\Controllers\HomeController::class, 'programPanti'])->name('data-program.index');
    Route::get('/jenis-program', [App\Http\Controllers\HomeController::class, 'jenisProgram'])->name('jenis-program.index');
});
