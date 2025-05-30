<?php

use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\UserController;

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
Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/logout', App\Http\Controllers\Api\logoutController::class)->name('logout');

Route::get('level', [LevelController::class, 'index']);
Route::post('level', [LevelController::class, 'store']);
Route::get('level/{level}', [LevelController::class, 'show']);
Route::put('level/{level}', [LevelController::class, 'update']);
Route::delete('level/{level}', [LevelController::class, 'destroy']);

Route::get('user', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'store']);
Route::get('user/{user}', [UserController::class, 'show']);
Route::put('user/{user}', [UserController::class, 'update']);
Route::delete('user/{user}', [UserController::class, 'destroy']);

Route::get('kategori', [KategoriController::class, 'index']);
Route::post('kategori', [KategoriController::class, 'store']);
Route::get('kategori/{kategori}', [KategoriController::class, 'show']);
Route::put('kategori/{kategori}', [KategoriController::class, 'update']);
Route::delete('kategori/{kategori}', [KategoriController::class, 'destroy']);

Route::get('barang', [BarangController::class, 'index']);
Route::post('barang', [BarangController::class, 'store']);
Route::get('barang/{barang}', [BarangController::class, 'show']);
Route::put('barang/{barang}', [BarangController::class, 'update']);
Route::delete('barang/{barang}', [BarangController::class, 'destroy']);