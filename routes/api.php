<?php

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ParentPostController;

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


Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('profile', [AuthController::class, 'me']);
    Route::get('dashboard', [AuthController::class, 'dashboard']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('/parentposts', [ParentPostController::class, 'index']);
Route::post('/parentposts', [ParentPostController::class, 'store']);
Route::get('/parentposts/{uuid}', [ParentPostController::class, 'show']);
Route::get('/parentposts/{uuid}/edit', [ParentPostController::class, 'edit']);
Route::put('/parentposts/{uuid}', [ParentPostController::class, 'update']);
Route::delete('/parentposts/{uuid}', [ParentPostController::class, 'destroy']);
