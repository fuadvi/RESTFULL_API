<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\ScoreController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware => auth:sanctum'], function () {
// });

Route::middleware(['auth:sanctum'])->group(function () {
    // crud student
    Route::post('/create', [FormController::class, 'create']);
    Route::post('/update/{id}', [FormController::class, 'update']);
    Route::post('/delete/{id}', [FormController::class, 'delete']);

    // crud score with relastion Student
    Route::post('/score', [ScoreController::class, 'create']);
    Route::get('/data-student/{id}', [ScoreController::class, 'getStudent']);
    Route::post('/data-student/{id}', [ScoreController::class, 'update']);


    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
