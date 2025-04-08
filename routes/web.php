<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
    // return view('welcome');
// });

// Route::get('/level',[LevelController::class, 'index']);
// Route::get('/kategori',[KategoriController::class, 'index']);
// Route::get('/user',[UserController::class, 'index']);
// Route::get('/user/tambah',[UserController::class,'tambah']);
// Route::post('/user/tambah_simpan',[UserController::class,'tambah_simpan']);
// Route::get('/user/ubah/{id}',[UserController::class,'ubah']);
// Route::put('/user/ubah_simpan/{id}',[UserController::class, 'ubah_simpan']);
// Route::get('user/hapus/{id}',[UserController::class, 'hapus']);
// Route::get('/', [WelcomeController::class, 'index']);


Route::middleware(['auth'])->group(function () {
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    //Route::get('/', [UserController::class, 'index']);
    Route::get('/', [UserController::class, 'index'])->middleware('authorize:ADM,MNG');
    Route::get('/user.ajax', [UserController::class, 'store_ajax'])->name('user.ajax');
    Route::post('/list', [UserController::class, 'list']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);
    Route::post('/ajax', [UserController::class, 'store_ajax']);
    //Route::get('/{id}', [UserController::class, 'show']);
    //Route::get('/{id}/', [UserController::class, 'show']);

    //Route::get('/{id}/edit', [UserController::class, 'edit']);
    //Route::put('/{id}', [UserController::class, 'update']);
    Route::get('/{id}/show_ajax', [UserController::class,'show_ajax']);
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
    
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [UserController::class, 'destroy']);
});

Route::group(['prefix' => 'level'], function () {
    //Route::get('/', [LevelController::class, 'index']);
    Route::get('/', [levelController::class, 'index'])->middleware('authorize:ADM');
    Route::post('/list', [LevelController::class, 'list']);
    Route::get('/create', [LevelController::class, 'create']);
    Route::post('/', [LevelController::class, 'store']);
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
    Route::post('/store_ajax', [LevelController::class, 'store_ajax']);

    //Route::get('/level/{id}', [LevelController::class, 'show']);
    //Route::get('/{id}/edit', [LevelController::class, 'edit']);
    //Route::put('/{id}', [LevelController::class, 'update']);
    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'destroy']);
    
});
Route::group(['prefix' => 'kategori'], function () {
    //Route::get('/', [KategoriController::class, 'index']);
    Route::get('/', [KategoriController::class, 'index'])->middleware('authorize:MNG,CUS');
    Route::post('/list', [KategoriController::class, 'list']);
    Route::get('/create', [KategoriController::class, 'create']);
    Route::post('/', [KategoriController::class, 'store']);
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
    Route::post('/store_ajax', [KategoriController::class, 'store_ajax']);
    Route::get('/{id}', [KategoriController::class, 'show']);
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'destroy']);
});

Route::group(['prefix' => 'barang'], function () {
    //Route::get('/', [BarangController::class, 'index']);
    Route::get('/', [BarangController::class, 'index'])->middleware('authorize:CUS');
    Route::post('/list', [BarangController::class, 'list']);
    Route::get('/create', [BarangController::class, 'create']);
    Route::post('/', [BarangController::class, 'store']);
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
    Route::post('/store_ajax', [BarangController::class, 'store_ajax']);
    Route::get('/{id}', [BarangController::class, 'show']);
    Route::get('/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/{id}', [BarangController::class, 'update']);
    Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'destroy']);
});
//Route::prefix('/stocks')->group(function () {
  //  Route::get('', [StockController::class, 'page'])->name('stock.page');
    //Route::get('/list', [StockController::class, 'list'])->name('stocks.list');
    //Route::get('/store', [StockController::class, 'storePage'])->name('stocks.store-page');
    //Route::get('/{id}', [StockController::class, 'show'])->name('stocks.show');
    //Route::get('/{id}/update', [StockController::class, 'updatePage'])->name('stocks.update-page');
    //Route::patch('/{id}/update', [StockController::class, 'update'])->name('stocks.update');
    //Route::delete('/{id}/delete', [StockController::class, 'delete'])->name('stocks.delete');
    //Route::post('/store', [StockController::class, 'store'])->name('stocks.store');
//});
//use App\Http\Controllers\StokController;


Route::get('/stok', [StockController::class, 'index'])->middleware('authorize:CUS');
//Route::get('/stok', [StockController::class, 'index'])->name('stok.index');
Route::post('/stok/list', [StockController::class, 'list'])->name('stok.list'); // Pastikan ini POST
Route::post('/stok/store', [StockController::class, 'store']);
Route::post('/stok/update/{id}', [StockController::class, 'update']);
Route::delete('/stok/destroy/{id}', [StockController::class, 'destroy']);
//Route::get('/stock/store_ajax', [StockController::class, 'storePage'])->name('stocks.store-page');
Route::post('/stock/store_ajax', [StockController::class, 'store'])->name('stok.store');

Route::get('/stok/create_ajax', [StockController::class, 'create'])->name('stok.create');
Route::get('/stok/edit/{id}', [StockController::class, 'edit'])->name('stok.edit');
Route::put('/stok/update/{id}', [StockController::class, 'update'])->name('stok.update');
Route::get('/{id}/delete_ajax', [StockController::class, 'confirm_ajax']);
Route::delete('/{id}/delete_ajax', [StockController::class, 'destroy']);

Route::get('/transaksi', [TransaksiController::class, 'index'])->middleware('authorize:CUS,ADM,MNG');
//Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::resource('/transaksi', TransaksiController::class);
});
require __DIR__ . '/auth.php';