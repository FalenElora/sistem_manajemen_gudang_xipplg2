<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_masuk;
use Illuminate\Http\Request;

class Transaksi_masukController extends Controller
{
    
    /**
     * @OA\Get(
     *     path="/transaksi-masuk",
     *     tags={"Transaksi Masuk"},
     *     operationId="listTransaksiMasuk",
     *     summary="List of Transaksi Masuk",
     *     security={{"bearerAuth":{}}},
     *     description="Retrieve a list of transaksi masuk",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Successfully retrieved transaksi masuk",
     *                 "data": {
     *                     {"id": 1, "barang_id": 2, "supplier_id": 1, "tanggal": "2024-04-30", "jumlah": 5, "harga_jual": 100000}
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $transaksi = Transaksi_masuk::all();
        return response()->json([
            'success' => true,
           'message' => 'Successfully retrieved transaksi masuk',
            'data' => $transaksi
        ]);
    }
    /**
 * @OA\Get(
 *     path="/transaksi-masuk/search",
 *     tags={"Transaksi Masuk"},
 *     operationId="searchTransaksiMasukByTanggal",
 *     summary="Search transaksi masuk by date",
 *     security={{"bearerAuth":{}}},
 *     description="Search transaksi masuk records by exact date",
 *     @OA\Parameter(
 *         name="tanggal",
 *         in="query",
 *         required=true,
 *         description="Tanggal transaksi dalam format YYYY-MM-DD",
 *         @OA\Schema(type="string", format="date", example="2024-04-30")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Matching transaksi masuk found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Transaksi Masuk found",
 *                 "data": {
 *                     {"id": 1, "barang_id": 2, "supplier_id": 1, "tanggal": "2024-04-30", "jumlah": 5, "harga_jual": 100000}
 *                 }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No matching transaksi masuk found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "No transaksi masuk found on this date"
 *             }
 *         )
 *     )
 * )
 */
public function searchByTanggal(Request $request)
{
    $tanggal = $request->query('tanggal');

    $transaksi = Transaksi_masuk::whereDate('tanggal', $tanggal)->get();

    if ($transaksi->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No transaksi masuk found on this date'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Transaksi Masuk found',
        'data' => $transaksi
    ]);
}
/**
 * @OA\Get(
 *     path="/transaksi-masuk/{id}",
 *     tags={"Transaksi Masuk"},
 *     operationId="getTransaksiMasukById",
 *     summary="Get transaksi masuk by ID",
 *     security={{"bearerAuth":{}}},
 *     description="Retrieve a single transaksi masuk record by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Transaksi Masuk found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Transaksi Masuk found",
 *                 "data": {"id": 1, "barang_id": 2, "supplier_id": 1, "tanggal": "2024-04-30", "jumlah": 5, "harga_jual": 100000}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Transaksi Masuk not found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "Transaksi Masuk not found"
 *             }
 *         )
 *     )
 * )
 */
public function show($id)
{
    $transaksi = Transaksi_masuk::find($id);

    if (!$transaksi) {
        return response()->json([
            'success' => false,
            'message' => 'Transaksi Masuk not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Transaksi Masuk found',
        'data' => $transaksi
    ]);
}



    /**
     * @OA\Post(
     *     path="/transaksi-masuk",
     *     tags={"Transaksi Masuk"},
     *     operationId="createTransaksiMasuk",
     *     summary="Create a new transaksi masuk",
     *     security={{"bearerAuth":{}}},
     *     description="Add a new transaksi masuk record",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"barang_id","supplier_id","tanggal","jumlah","harga_jual"},
     *             @OA\Property(property="barang_id", type="integer", example=2),
     *             @OA\Property(property="supplier_id", type="integer", example=1),
     *             @OA\Property(property="tanggal", type="string", format="date", example="2024-04-30"),
     *             @OA\Property(property="jumlah", type="integer", example=5),
     *             @OA\Property(property="harga_jual", type="number", example=100000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Transaksi masuk created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Transaksi Masuk created successfully",
     *                 "data": {"id": 1, "barang_id": 2, "supplier_id": 1, "tanggal": "2024-04-30", "jumlah": 5, "harga_jual": 100000}
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $transaksi = Transaksi_masuk::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Transaksi Masuk created successfully',
            'data' => $transaksi
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/transaksi-masuk/{id}",
     *     tags={"Transaksi Masuk"},
     *     operationId="updateTransaksiMasuk",
     *     summary="Update a transaksi masuk",
     *     security={{"bearerAuth":{}}},
     *     description="Update an existing transaksi masuk",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="barang_id", type="integer", example=3),
     *             @OA\Property(property="supplier_id", type="integer", example=2),
     *             @OA\Property(property="tanggal", type="string", format="date", example="2024-05-01"),
     *             @OA\Property(property="jumlah", type="integer", example=10),
     *             @OA\Property(property="harga_jual", type="number", example=120000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transaksi Masuk updated successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Transaksi Masuk updated successfully",
     *                 "data": {"id": 1, "barang_id": 3, "supplier_id": 2, "tanggal": "2024-05-01", "jumlah": 10, "harga_jual": 120000}
     *             }
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi_masuk::findOrFail($id);
        $transaksi->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Transaksi Masuk updated successfully',
            'data' => $transaksi
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/transaksi-masuk/{id}",
     *     tags={"Transaksi Masuk"},
     *     operationId="deleteTransaksiMasuk",
     *     summary="Delete a transaksi Masuk",
     *     security={{"bearerAuth":{}}},
     *     description="Delete a transaksi masuk record by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transaksi Masuk deleted successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Transaksi Masuk deleted successfully"
     *             }
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $transaksi = Transaksi_masuk::findOrFail($id);
        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi Masuk deleted successfully'
        ]);
    }
}
