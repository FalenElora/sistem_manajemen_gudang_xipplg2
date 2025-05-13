<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi_keluar;
use Illuminate\Http\Request;

class Transaksi_keluarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/transaksi-keluar",
     *     tags={"Transaksi Keluar"},
     *     operationId="listTransaksiKeluar",
     *     summary="List of Transaksi Keluar",
     *     description="Retrieve a list of transaksi keluar",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Successfully retrieved transaksi keluar",
     *                 "data": {
     *                     {"id": 1, "barang_id": 2, "pelanggan_id": 1, "tanggal": "2024-04-30", "jumlah": 5, "harga_jual": 100000}
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $transaksi = Transaksi_keluar::all();
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved transaksi keluar',
            'data' => $transaksi
        ]);
    }

    /**
     * @OA\Post(
     *     path="/transaksi-keluar",
     *     tags={"Transaksi Keluar"},
     *     operationId="createTransaksiKeluar",
     *     summary="Create a new transaksi keluar",
     *     description="Add a new transaksi keluar record",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"barang_id","pelanggan_id","tanggal","jumlah","harga_jual"},
     *             @OA\Property(property="barang_id", type="integer", example=2),
     *             @OA\Property(property="pelanggan_id", type="integer", example=1),
     *             @OA\Property(property="tanggal", type="string", format="date", example="2024-04-30"),
     *             @OA\Property(property="jumlah", type="integer", example=5),
     *             @OA\Property(property="harga_jual", type="number", example=100000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Transaksi Keluar created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Transaksi Keluar created successfully",
     *                 "data": {"id": 1, "barang_id": 2, "pelanggan_id": 1, "tanggal": "2024-04-30", "jumlah": 5, "harga_jual": 100000}
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $transaksi = Transaksi_keluar::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Transaksi Keluar created successfully',
            'data' => $transaksi
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/transaksi-keluar/{id}",
     *     tags={"Transaksi Keluar"},
     *     operationId="updateTransaksiKeluar",
     *     summary="Update a transaksi keluar",
     *     description="Update an existing transaksi keluar",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="barang_id", type="integer", example=3),
     *             @OA\Property(property="pelanggan_id", type="integer", example=2),
     *             @OA\Property(property="tanggal", type="string", format="date", example="2024-05-01"),
     *             @OA\Property(property="jumlah", type="integer", example=10),
     *             @OA\Property(property="harga_jual", type="number", example=120000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transaksi Keluar updated successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Transaksi Keluar updated successfully",
     *                 "data": {"id": 1, "barang_id": 3, "pelanggan_id": 2, "tanggal": "2024-05-01", "jumlah": 10, "harga_jual": 120000}
     *             }
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi_keluar::findOrFail($id);
        $transaksi->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Transaksi Keluar updated successfully',
            'data' => $transaksi
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/transaksi-keluar/{id}",
     *     tags={"Transaksi Keluar"},
     *     operationId="deleteTransaksiKeluar",
     *     summary="Delete a transaksi keluar",
     *     description="Delete a transaksi keluar record by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transaksi Keluar deleted successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Transaksi Keluar deleted successfully"
     *             }
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $transaksi = Transaksi_keluar::findOrFail($id);
        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi Keluar deleted successfully'
        ]);
    }
}
