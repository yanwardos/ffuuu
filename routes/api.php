<?php
// TEST

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserDataController;
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


// AUTH
Route::post('login', [AuthController::class, 'login']);
Route::post('registerUser', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/verifyAuth', [AuthController::class, 'verifyAuth']);

// USERDATA
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('userData', [UserDataController::class, 'getUserData']);
    Route::patch('userData', [UserDataController::class, 'updateUserData']);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->only(['name', 'email', 'avatar']);
});

 