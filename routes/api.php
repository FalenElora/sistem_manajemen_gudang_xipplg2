<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\PelangganController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\Transaksi_masukController;
use App\Http\Controllers\API\Transaksi_keluarController;
use Illuminate\Support\Facades\Route;
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
    Route::get('category', [KategoriController::class, 'listCategory']);

    // Supplier Routes
    Route::get('suppliers', [SupplierController::class, 'index']);
    Route::post('suppliers', [SupplierController::class, 'store']);
    Route::get('suppliers/{id}', [SupplierController::class, 'show']);
    Route::put('suppliers/{id}', [SupplierController::class, 'update']);
    Route::delete('suppliers/{id}', [SupplierController::class, 'destroy']);
});


Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['jwt.auth'])->group(function () {

    // Untuk user & admin: hanya akses GET
    Route::middleware(['role:user,admin'])->group(function () {
        Route::get('/transaksi-masuk', [Transaksi_masukController::class, 'index']);
        Route::get('/transaksi-masuk/search', [Transaksi_masukController::class, 'searchByTanggal']);
        Route::get('/transaksi-masuk/{id}', [Transaksi_masukController::class, 'show']);
    });

    // Hanya admin yang bisa POST, PUT, DELETE
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/transaksi-masuk', [Transaksi_masukController::class, 'index']);
        Route::get('/transaksi-masuk/search', [Transaksi_masukController::class, 'searchByTanggal']);
        Route::get('/transaksi-masuk/{id}', [Transaksi_masukController::class, 'show']);
        Route::post('/transaksi-masuk', [Transaksi_masukController::class, 'store']);
        Route::put('/transaksi-masuk/{id}', [Transaksi_masukController::class, 'update']);
        Route::delete('/transaksi-masuk/{id}', [Transaksi_masukController::class, 'destroy']);
    });

});

Route::middleware(['jwt.auth'])->group(function () {

    // Rute yang cuma boleh diakses oleh user dengan role 'user' dan 'admin' tapi hanya GET saja
    Route::middleware(['role:user,admin'])->group(function () {
        Route::get('/transaksi-keluar', [Transaksi_keluarController::class, 'index']);
        Route::get('/transaksi-keluar/search', [Transaksi_keluarController::class, 'searchByTanggal']);
        Route::get('/transaksi-keluar/{id}', [Transaksi_keluarController::class, 'show']);
    });

    // Rute yang cuma boleh diakses oleh admin (bisa POST, PUT, DELETE)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/transaksi-keluar', [Transaksi_keluarController::class, 'index']);
        Route::get('/transaksi-keluar/search', [Transaksi_keluarController::class, 'searchByTanggal']);
        Route::get('/transaksi-keluar/{id}', [Transaksi_keluarController::class, 'show']);
        Route::post('/transaksi-keluar', [Transaksi_keluarController::class, 'store']);
        Route::put('/transaksi-keluar/{id}', [Transaksi_keluarController::class, 'update']);
        Route::delete('/transaksi-keluar/{id}', [Transaksi_keluarController::class, 'destroy']);
    });
    Route::middleware(['role:admin'])->group(function () {
        Route::post('/', [KategoriController::class, 'createCategory']);     // POST /api/category
        Route::put('/{id}', [KategoriController::class, 'updateCategory']);  // PUT /api/category/{id}
        Route::delete('/{id}', [KategoriController::class, 'deleteCategory']); // DELETE /api/category/{id}
    });
     Route::middleware(['role:admin'])->group(function () {
         Route::post('/', [BarangController::class, 'store']); // POST /barang
    // Update data barang
    Route::put('/{id}', [BarangController::class, 'update']); // PUT /barang/{id}
    // Hapus data barang
    Route::delete('/{id}', [BarangController::class, 'destroy']); // DELETE /barang/{id}
    });
     Route::middleware(['role:admin'])->group(function () {
       // Menambahkan pelanggan baru
    Route::post('/', [PelangganController::class, 'store']);
    // Memperbarui data pelanggan
    Route::put('/{id}', [PelangganController::class, 'update']);
    // Menghapus pelanggan
    Route::delete('/{id}', [PelangganController::class, 'destroy']);
    });
     Route::middleware(['role:admin'])->group(function () {
          Route::post('/', [SupplierController::class, 'store']);

    // Memperbarui data supplier
    Route::put('/{id}', [SupplierController::class, 'update']);

    // Menghapus supplier
    Route::delete('/{id}', [SupplierController::class, 'destroy']);      
    });
});


Route::prefix('category')->group(function () {
    Route::get('/', [KategoriController::class, 'listCategory']);        // GET /api/category
    Route::get('/{id}', [KategoriController::class, 'getCategoryById']); // GET /api/category/{id}
    Route::get('/search', [KategoriController::class, 'searchByName']);  // GET /api/category/search?name=xxx
});
Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index']); // GET /barang
    Route::get('/{id}', [BarangController::class, 'show']); // GET /barang/{id}
    Route::get('/kategori/{kategori_id}', [BarangController::class, 'getByKategori']); // GET /barang/kategori/2
    Route::get('/search', [BarangController::class, 'searchByName']); // GET /barang/search?nama=xxx
    Route::get('/stok/kurang-dari-100', [BarangController::class, 'lowStock']); // GET /barang/stok/kurang-dari-100
    Route::get('/sort/harga', [BarangController::class, 'sortByHarga']); // GET /barang/sort/harga?order=asc|desc
    Route::get('/sort/nama', [BarangController::class, 'sortByNama']); // GET /barang/sort/nama?order=asc|desc
    Route::get('/sort/jumlah', [BarangController::class, 'sortByJumlah']); // GET /barang/sort/nama?order=asc|desc
});

Route::prefix('pelanggan')->group(function () {
    // Menampilkan semua pelanggan
    Route::get('/', [PelangganController::class, 'index']);
    // Menampilkan pelanggan berdasarkan ID
    Route::get('/{id}', [PelangganController::class, 'show']);
    // Mencari pelanggan berdasarkan nama
    Route::get('/search', [PelangganController::class, 'searchByName']);
    
});
Route::prefix('supplier')->group(function () {
    // Menampilkan semua supplier
    Route::get('/', [SupplierController::class, 'index']);

    // Menampilkan supplier berdasarkan ID
    Route::get('/{id}', [SupplierController::class, 'show']);

    // Mencari supplier berdasarkan nama
    Route::get('/search', [SupplierController::class, 'searchByName']);

    // Menambahkan supplier baru
  
});

   

