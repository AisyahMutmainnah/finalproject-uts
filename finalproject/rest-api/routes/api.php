<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PatientController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//jalankan middleware sanctum kemudian kelompokkan endpoint nya menggunakan method group

Route::middleware(['auth:sanctum'])->group(function () {
    #method GET
    Route::get('/patients', [PatientController::class, 'index']);

    #method POST
    Route::post('/patients', [PatientController::class, 'store']);

    #method Get Detail Resource
    Route::get('/patients/{id}', [PatientController::class, 'show']);

    #method PUT 
    Route::put('/patients/{id}', [PatientController::class, 'update']);

    #method DELETE
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

    #method DELETE 
    Route::delete('/patiens/{id}', [PatientController::class, 'destroy']);

    #method GET Resources by name
    Route::get('/patients/search/{name}', [PatientController::class, 'search']);

    #method GET Positive resources
    Route::get('/patients/status/positive', [PatientController::class, 'positive']);

    #method GET Recovered resources
    Route::get('/patients/status/recovered', [PatientController::class, 'recovered']);

    #method GET Dead resources
    Route::get('/patients/status/dead', [PatientController::class, 'dead']);
});



# Endpoint Register dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
