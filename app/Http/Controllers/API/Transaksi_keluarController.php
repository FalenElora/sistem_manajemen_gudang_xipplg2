<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;

class Transaksi_keluarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/transaksi-keluar",
     *     tags={"Transaksi Keluar"},
     *     security={{"bearerAuth":{}}},
     *     operationId="listTransaksiKeluar",
     *     summary="List of Transaksi Keluar",

     *     description="Retrieve a list of transaksi keluar",
>>>>>>> 9839338e3413a56a9f5083fc202defe664bab8c4
     *     @OA\Response(
     *         response=200,
     *         description="Daftar transaksi keluar"
     *     )
     * )
     */
    public function index()
    {
        return TransaksiKeluar::all();
    }
<<<<<<< HEAD
=======
    /**
 * @OA\Get(
 *     path="/transaksi-keluar/search",
 *     tags={"Transaksi Keluar"},
 *     operationId="searchTransaksiKeluarByTanggal",
 *     summary="Search transaksi keluar by date",
 *     security={{"bearerAuth":{}}},
 *     description="Search transaksi keluar records by exact date",
 *     @OA\Parameter(
 *         name="tanggal",
 *         in="query",
 *         required=true,
 *         description="Tanggal transaksi dalam format YYYY-MM-DD",
 *         @OA\Schema(type="string", format="date", example="2024-04-30")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Matching transaksi keluar found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Transaksi Keluar found",
 *                 "data": {
 *                     {"id": 1, "barang_id": 2, "pelanggan_id": 1, "tanggal": "2024-04-30", "jumlah": 5, "harga_jual": 100000}
 *                 }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No matching transaksi keluar found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "No transaksi keluar found on this date"
 *             }
 *         )
 *     )
 * )
 */
public function searchByTanggal(Request $request)
{
    $tanggal = $request->query('tanggal');

    $transaksi = Transaksi_keluar::whereDate('tanggal', $tanggal)->get();

    if ($transaksi->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No transaksi keluar found on this date'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Transaksi Keluar found',
        'data' => $transaksi
    ]);
}

/**
 * @OA\Get(
 *     path="/transaksi-keluar/{id}",
 *     tags={"Transaksi Keluar"},
 *     operationId="getTransaksiKeluarById",
 *     summary="Get transaksi keluar by ID",
 *     security={{"bearerAuth":{}}},
 *     description="Retrieve a single transaksi keluar record by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Transaksi Keluar found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Transaksi Keluar found",
 *                 "data": {"id": 1, "barang_id": 2, "pelanggan_id": 1, "tanggal": "2024-04-30", "jumlah": 5, "harga_jual": 100000}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Transaksi Keluar not found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "Transaksi Keluar not found"
 *             }
 *         )
 *     )
 * )
 */
public function show($id)
{
    $transaksi = Transaksi_keluar::find($id);

    if (!$transaksi) {
        return response()->json([
            'success' => false,
            'message' => 'Transaksi Keluar not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Transaksi Keluar found',
        'data' => $transaksi
    ]);
}
    
    
>>>>>>> 9839338e3413a56a9f5083fc202defe664bab8c4

    /**
     * @OA\Post(
     *     path="/transaksi-keluar",
     *     tags={"Transaksi Keluar"},
<<<<<<< HEAD
     *     summary="Buat transaksi keluar baru",
=======
     *     operationId="createTransaksiKeluar",
     *     summary="Create a new transaksi keluar",
     *     security={{"bearerAuth":{}}},
     *     description="Add a new transaksi keluar record",
>>>>>>> 9839338e3413a56a9f5083fc202defe664bab8c4
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama", "jumlah", "tanggal"},
     *             @OA\Property(property="nama", type="string"),
     *             @OA\Property(property="jumlah", type="integer"),
     *             @OA\Property(property="tanggal", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Transaksi keluar berhasil dibuat")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        return TransaksiKeluar::create($validated);
    }

    /**
     * @OA\Get(
     *     path="/transaksi-keluar/{id}",
     *     tags={"Transaksi Keluar"},
     *     summary="Ambil transaksi keluar berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Detail transaksi keluar")
     * )
     */
    public function show($id)
    {
        return TransaksiKeluar::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/transaksi-keluar/{id}",
     *     tags={"Transaksi Keluar"},
<<<<<<< HEAD
     *     summary="Update transaksi keluar",
=======
     *     operationId="updateTransaksiKeluar",
     *     summary="Update a transaksi keluar",
     *     security={{"bearerAuth":{}}},
     *     description="Update an existing transaksi keluar",
>>>>>>> 9839338e3413a56a9f5083fc202defe664bab8c4
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string"),
     *             @OA\Property(property="jumlah", type="integer"),
     *             @OA\Property(property="tanggal", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Transaksi keluar berhasil diupdate")
     * )
     */
    public function update(Request $request, $id)
    {
        $transaksi = TransaksiKeluar::findOrFail($id);
        $transaksi->update($request->all());
        return $transaksi;
    }

    /**
     * @OA\Delete(
     *     path="/transaksi-keluar/{id}",
     *     tags={"Transaksi Keluar"},
<<<<<<< HEAD
     *     summary="Hapus transaksi keluar",
=======
     *     operationId="deleteTransaksiKeluar",
     *     summary="Delete a transaksi keluar",
     *     security={{"bearerAuth":{}}},
     *     description="Delete a transaksi keluar record by ID",
>>>>>>> 9839338e3413a56a9f5083fc202defe664bab8c4
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Transaksi keluar berhasil dihapus")
     * )
     */
    public function destroy($id)
    {
        $transaksi = TransaksiKeluar::findOrFail($id);
        $transaksi->delete();
        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/transaksi-keluar/search",
     *     tags={"Transaksi Keluar"},
     *     summary="Cari transaksi keluar berdasarkan ID atau Nama",
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="ID atau Nama transaksi",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hasil pencarian transaksi keluar"
     *     )
     * )
     */
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $result = TransaksiKeluar::where('id', $keyword)
            ->orWhere('nama', 'like', '%' . $keyword . '%')
            ->get();

        return response()->json($result);
    }
}