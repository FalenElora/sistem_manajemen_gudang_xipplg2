<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * @OA\Get(
     *     path="/barang",
     *     tags={"Barang"},
     *     operationId="listBarang",
     *     summary="List of Barang",
     *     description="Retrieve a list of barang",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Successfully retrieved barang",
     *                 "data": {
     *                     {"id": 1, "nama": "Mouse", "kategori_id": 2, "harga": 50000, "jumlah": 10}
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $barang = Barang::all();
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved barang',
            'data' => $barang
        ]);
    }

    /**
     * @OA\Post(
     *     path="/barang",
     *     tags={"Barang"},
     *     operationId="createBarang",
     *     summary="Create a new barang",
     *     description="Add a new barang to inventory",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama","kategori_id","harga","jumlah"},
     *             @OA\Property(property="nama", type="string", example="Mouse"),
     *             @OA\Property(property="kategori_id", type="integer", example=2),
     *             @OA\Property(property="harga", type="number", example=50000),
     *             @OA\Property(property="jumlah", type="integer", example=10)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Barang created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Barang created successfully",
     *                 "data": {"id": 3, "nama": "Mouse", "kategori_id": 2, "harga": 50000, "jumlah": 10}
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $barang = Barang::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Barang created successfully',
            'data' => $barang
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/barang/{id}",
     *     tags={"Barang"},
     *     operationId="updateBarang",
     *     summary="Update a barang",
     *     description="Update an existing barang",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Keyboard"),
     *             @OA\Property(property="kategori_id", type="integer", example=2),
     *             @OA\Property(property="harga", type="number", example=75000),
     *             @OA\Property(property="jumlah", type="integer", example=5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Barang updated successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Barang updated successfully",
     *                 "data": {"id": 1, "nama": "Keyboard", "kategori_id": 2, "harga": 75000, "jumlah": 5}
     *             }
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Barang updated successfully',
            'data' => $barang
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/barang/{id}",
     *     tags={"Barang"},
     *     operationId="deleteBarang",
     *     summary="Delete a barang",
     *     description="Delete an existing barang by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Barang deleted successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Barang deleted successfully"
     *             }
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang deleted successfully'
        ]);
    }
}
