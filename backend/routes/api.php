<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('user')->group(function(){

        Route::get('show', [UserController::class, 'show'])->name('user.show');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::post('login', [AuthController::class, 'login'])->name('user.login');
Route::post('register', [AuthController::class, 'register'])->name('user.register');
