<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Client\HomeController;
use App\Http\Controllers\Web\Panel\KategoriController;
use App\Http\Controllers\Web\Panel\DashboardController;
use App\Http\Controllers\Web\Client\ClientArtikelController;
use App\Http\Controllers\Web\Client\ClientKategoriController;

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

// start middleware admin
Route::get('/panel/kategori', [KategoriController::class, 'index'])->name('panel.kategori.index');
Route::get('/panel/dashboard', [DashboardController::class, 'index'])->name('panel.dashboard.index');
// end middleware admin


Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('/kategori', [ClientKategoriController::class, 'index'])->name('client.kategori.index');
Route::get('/kategori/slug-kategori', [ClientKategoriController::class, 'show'])->name('client.kategori.show');
Route::get('/artikel', [ClientArtikelController::class, 'index'])->name('client.artikel.index');
Route::get('/slug-artikel', [ClientArtikelController::class, 'show'])->name('client.artikel.show');//taruh dipaling bawah biar tidak kena route conflict
