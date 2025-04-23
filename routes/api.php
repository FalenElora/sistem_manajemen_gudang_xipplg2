<?php

use Illuminate\Http\Request;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Transaksi_masukController;
use App\Http\Controllers\Transaksi_keluarController;
use Illuminate\Support\Facades\Route;

Route::apiResource('kategoris', KategoriController::class);
Route::apiResource('barangs', BarangController::class);
Route::apiResource('pelanggans', PelangganController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('transaksi_masuk', Transaksi_masukController::class);
Route::apiResource('transaksi_keluar', Transaksi_keluarController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
