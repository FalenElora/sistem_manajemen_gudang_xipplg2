<?php

use Illuminate\Http\Request;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Transaksi_masukController;
use App\Http\Controllers\Transaksi_keluarController;
use Illuminate\Support\Facades\Route;

// Route::apiResource('kategoris', KategoriController::class);
// Route::apiResource('barangs', BarangController::class);
// Route::apiResource('pelanggans', PelangganController::class);
// Route::apiResource('suppliers', SupplierController::class);
// Route::apiResource('transaksi_masuk', Transaksi_masukController::class);
// Route::apiResource('transaksi_keluar', Transaksi_keluarController::class);


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

/**
 * @OA\Get(
 *     path="/api/category",
 *     tags={"Category"},
 *     summary="Ambil daftar kategori",
 *     description="Mengambil semua kategori buku yang tersedia",
 *     operationId="listCategory",
 *     @OA\Response(
 *         response=200,
 *         description="Kategori berhasil diambil",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Successfully retrieved categories",
 *                 "data": {
 *                     {"id": 1, "name": "Fiction"},
 *                     {"id": 2, "name": "Non-Fiction"}
 *                 }
 *             }
 *         )
 *     )
 * )
 */
