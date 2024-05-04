<?php

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChildPostController;
use App\Http\Controllers\Api\ParentPostController;
use App\Http\Controllers\Api\Guest\GuestController;
use App\Http\Controllers\Api\ChildPostParentPostController;

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

Route::prefix('/admin')->group(function () {
    Route::get('/parentposts', [ParentPostController::class, 'index']);
    Route::post('/parentposts', [ParentPostController::class, 'store']);
    Route::get('/parentposts/{uuid}', [ParentPostController::class, 'show']);
    Route::get('/parentposts/{uuid}/edit', [ParentPostController::class, 'edit']);
    Route::put('/parentposts/{uuid}', [ParentPostController::class, 'update']);
    Route::delete('/parentposts/{uuid}', [ParentPostController::class, 'destroy']);

    Route::get('/childposts', [ChildPostController::class, 'index']);
    Route::post('/childposts', [ChildPostController::class, 'store']);
    Route::get('/childposts/{uuid}', [ChildPostController::class, 'show']);
    Route::put('/childposts/{uuid}', [ChildPostController::class, 'update']);
    Route::delete('/childposts/{uuid}', [ChildPostController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{uuid}', [CategoryController::class, 'show']);
    Route::put('/categories/{uuid}', [CategoryController::class, 'update']);
    Route::delete('/categories/{uuid}', [CategoryController::class, 'destroy']);
});

Route::get('/categories', [GuestController::class, 'indexKategori']);
Route::get('/categories/{uuid}', [GuestController::class, 'showKategori']);
Route::get('/parentposts', [GuestController::class, 'indexParent']);
Route::get('/parentposts/{uuid}', [GuestController::class, 'showParent']);
Route::get('/childposts', [GuestController::class, 'indexChild']);
Route::get('/childposts/{uuid}', [GuestController::class, 'showChild']);

Route::get('/child-post-parent-posts', [ChildPostParentPostController::class, 'index']);
Route::post('/child-post-parent-posts', [ChildPostParentPostController::class, 'store']);
Route::delete('/child-post-parent-posts/{id}', [ChildPostParentPostController::class, 'destroy']);
