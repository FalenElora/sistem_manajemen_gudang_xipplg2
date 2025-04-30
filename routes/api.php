<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\Transaksi_masukController;
use App\Http\Controllers\Transaksi_keluarController;
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

Route::group([], function () {
    Route::get('category', [KategoriController::class, 'listCategory']);
});
// Route::apiResource('kategoris', KategoriController::class);
// Route::apiResource('barangs', BarangController::class);
// Route::apiResource('pelanggans', PelangganController::class);
// Route::apiResource('suppliers', SupplierController::class);
// Route::apiResource('transaksi_masuk', Transaksi_masukController::class);
// Route::apiResource('transaksi_keluar', Transaksi_keluarController::class);


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([], function () {
    // Category Routes
    Route::get('category', [CategoryController::class, 'listCategory']);

    // Supplier Routes
    Route::get('suppliers', [SupplierController::class, 'index']);
    Route::post('suppliers', [SupplierController::class, 'store']);
    Route::get('suppliers/{id}', [SupplierController::class, 'show']);
    Route::put('suppliers/{id}', [SupplierController::class, 'update']);
    Route::delete('suppliers/{id}', [SupplierController::class, 'destroy']);
});