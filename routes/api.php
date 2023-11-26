<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pengurus_Panti\PengurusPantiController;


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

Route::group(['prefix' => 'auth'], function () {
    
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);
    });
});

Route::apiResource('pengurus-panti', PengurusPantiController::class);
Route::put('/pengurus-panti/{id}', function (Request $request, $id) {
    $pengurusPanti = PengurusPanti::findOrFail($id);

    $request->validate([
        'nama' => 'required|string',
        'alamat' => 'required|string',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'no_telepon' => 'required|string',
        'isActive' => 'required|in:aktif,non-aktif',
    ]);

    $pengurusPanti->update($request->all());

    return response()->json($pengurusPanti, 200);
});