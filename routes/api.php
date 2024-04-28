<?php

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChildPostController;
use App\Http\Controllers\Api\ParentPostController;
use App\Http\Controllers\Api\Guest\GuestController;
use App\Http\Controllers\ChildPostParentPostController;

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

    Route::prefix('admin')->group(function () {
        Route::resource('parentposts', ParentPostController::class);
        Route::resource('childposts', ChildPostController::class);
        Route::resource('categories', CategoryController::class);
    });
});


Route::get('/categories', [GuestController::class, 'indexKategori']);
Route::get('/categories/{uuid}', [GuestController::class, 'showKategori']);
Route::get('/parentposts', [GuestController::class, 'indexParent']);
Route::get('/parentposts/{uuid}', [GuestController::class, 'showParent']);
Route::get('/childposts', [GuestController::class, 'indexChild']);
Route::get('/childposts/{uuid}', [GuestController::class, 'showChild']);

Route::resource('child-post-parent-posts', ChildPostParentPostController::class);
