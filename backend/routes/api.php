<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\Admin\PostController as AdminPostController;

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

    Route::prefix('company')->group(function(){
        Route::get('list', [CompanyController::class, 'index'])->name('company.list');
    });

    Route::prefix('post')->group(function(){
        Route::post('create', [PostController::class, 'store'])->name('post.create');
        Route::get('read/{id}', [PostController::class, 'show'])->name('post.show');
        Route::put('update/{id}', [PostController::class, 'update'])->name('post.update');
    });

    Route::prefix('admin')->group(function(){

        Route::prefix('post')->group(function(){
            Route::put('approve/{id}', [AdminPostController::class, 'approve'])->name('admin.post.approve');
        });
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::prefix('user')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('user.login');
    Route::put('register', [RegistrationController::class, 'register'])->name('user.register');
    Route::get('verify-email/{token}', [RegistrationController::class, 'verifyEmail'])->name('user.email.verification');
});

Route::prefix('post')->group(function(){
    Route::get('list/{type?}/{tag?}', [PostController::class, 'index'])->name('post.list');
});
