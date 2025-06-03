<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\PelangganController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\Transaksi_masukController;
use App\Http\Controllers\API\Transaksi_keluarController;
use App\Http\Controllers\API\AuthController;

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

// Route login tanpa middleware
Route::post('/login', [AuthController::class, 'login']);

// Route transaksi masuk dengan middleware JWT
Route::prefix('transaksi-masuk')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [Transaksi_masukController::class, 'index']);
    Route::get('/search', [Transaksi_masukController::class, 'searchByTanggal']);
    Route::get('/{id}', [Transaksi_masukController::class, 'show']);
    Route::post('/', [Transaksi_masukController::class, 'store']);
    Route::put('/{id}', [Transaksi_masukController::class, 'update']);
    Route::delete('/{id}', [Transaksi_masukController::class, 'destroy']);
});

// Route transaksi keluar dengan middleware JWT
Route::prefix('transaksi-keluar')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [Transaksi_keluarController::class, 'index']);
    Route::get('/search', [Transaksi_keluarController::class, 'searchByTanggal']);
    Route::get('/{id}', [Transaksi_keluarController::class, 'show']);
    Route::post('/', [Transaksi_keluarController::class, 'store']);
    Route::put('/{id}', [Transaksi_keluarController::class, 'update']);
    Route::delete('/{id}', [Transaksi_keluarController::class, 'destroy']);
});

// Route kategori
Route::prefix('category')->group(function () {
    Route::get('/', [KategoriController::class, 'listCategory']);        // Semua kategori (public)
    Route::get('/{id}', [KategoriController::class, 'getCategoryById']); // Detail kategori (public)
    Route::get('/search', [KategoriController::class, 'searchByName']);  // Cari kategori (public)
});

Route::prefix('category')->middleware(['jwt.auth'])->group(function () {
    Route::post('/', [KategoriController::class, 'createCategory']);     // Buat kategori
    Route::put('/{id}', [KategoriController::class, 'updateCategory']);  // Update kategori
    Route::delete('/{id}', [KategoriController::class, 'deleteCategory']); // Hapus kategori
});

// Route barang
Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index']);
    Route::get('/{id}', [BarangController::class, 'show']);
    Route::get('/kategori/{kategori_id}', [BarangController::class, 'getByKategori']);
    Route::get('/search', [BarangController::class, 'searchByName']);
    Route::get('/stok/kurang-dari-100', [BarangController::class, 'lowStock']);
    Route::get('/sort/harga', [BarangController::class, 'sortByHarga']);
    Route::get('/sort/nama', [BarangController::class, 'sortByNama']);
    Route::get('/sort/jumlah', [BarangController::class, 'sortByJumlah']);
});

Route::prefix('barang')->middleware(['jwt.auth'])->group(function () {
    Route::post('/', [BarangController::class, 'store']);
    Route::put('/{id}', [BarangController::class, 'update']);
    Route::delete('/{id}', [BarangController::class, 'destroy']);
});

// Route pelanggan
Route::prefix('pelanggan')->group(function () {
    Route::get('/', [PelangganController::class, 'index']);
    Route::get('/{id}', [PelangganController::class, 'show']);
    Route::get('/search', [PelangganController::class, 'searchByName']);
});

Route::prefix('pelanggan')->middleware(['jwt.auth'])->group(function () {
    Route::post('/', [PelangganController::class, 'store']);
    Route::put('/{id}', [PelangganController::class, 'update']);
    Route::delete('/{id}', [PelangganController::class, 'destroy']);
});

// Route supplier
Route::prefix('supplier')->group(function () {
    Route::get('/', [SupplierController::class, 'index']);
    Route::get('/{id}', [SupplierController::class, 'show']);
    Route::get('/search', [SupplierController::class, 'searchByName']);
});

Route::prefix('supplier')->middleware(['jwt.auth'])->group(function () {
    Route::post('/', [SupplierController::class, 'store']);
    Route::put('/{id}', [SupplierController::class, 'update']);
    Route::delete('/{id}', [SupplierController::class, 'destroy']);
});
