<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelanggan;

use OpenAPI\Annotations as OA;

class PelangganController extends Controller
{
    /**
     * @OA\Get(
     *     path="/pelanggan",
     *     tags={"Pelanggan"},
     *     summary="List all pelanggan",
     *     operationId="listPelanggan",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Pelanggan retrieved successfully",
     *                 "data": {
     *                     {"id": 1, "nama": "Budi", "kontak": "08123456789", "alamat": "Jl. Merdeka 10"}
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $data = pelanggan::all();
        return response()->json([
            'success' => true,
            'message' => 'Pelanggan retrieved successfully',
            'data' => $data
        ]);
    }
    /**
     * @OA\Get(
     *     path="/pelanggan/{id}",
     *     tags={"Pelanggan"},
     *     summary="Get pelanggan by ID",
     *     operationId="getPelangganById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pelanggan retrieved successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Pelanggan retrieved successfully",
     *                 "data": {"id": 1, "nama": "Budi", "kontak": "08123456789", "alamat": "Jl. Merdeka 10"}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pelanggan not found",
     *         @OA\JsonContent(
     *             example={
     *                 "success": false,
     *                 "message": "Pelanggan not found"
     *             }
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $data = pelanggan::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Pelanggan not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan retrieved successfully',
            'data' => $data
        ]);
    }
        /**
     * @OA\Get(
     *     path="/pelanggan/search",
     *     tags={"Pelanggan"},
     *     summary="Search pelanggan by name",
     *     operationId="searchPelangganByName",
     *     @OA\Parameter(
     *         name="nama",
     *         in="query",
     *         required=true,
     *         description="Nama pelanggan yang ingin dicari",
     *         @OA\Schema(type="string", example="Budi")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pelanggan found",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Search result",
     *                 "data": {
     *                     {"id": 1, "nama": "Budi", "kontak": "08123456789", "alamat": "Jl. Merdeka 10"}
     *                 }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No pelanggan found",
     *         @OA\JsonContent(
     *             example={
     *                 "success": false,
     *                 "message": "No pelanggan found"
     *             }
     *         )
     *     )
     * )
     */
    public function searchByName(Request $request)
    {
        $nama = $request->query('nama');
        $data = pelanggan::where('nama', 'LIKE', "%$nama%")->get();

        if ($data->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No pelanggan found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Search result',
            'data' => $data
        ]);
    }

    /**
     * @OA\Post(
     *     path="/pelanggan",
     *     tags={"Pelanggan"},
     *     summary="Create a new pelanggan",
     *     security={{"bearerAuth":{}}},
     *     operationId="createPelanggan",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama", "kontak", "alamat"},
     *             @OA\Property(property="nama", type="string", example="Siti"),
     *             @OA\Property(property="kontak", type="string", example="081298765432"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Diponegoro 15")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pelanggan created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Pelanggan created successfully",
     *                 "data": {"id": 2, "nama": "Siti", "kontak": "081298765432", "alamat": "Jl. Diponegoro 15"}
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = pelanggan::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Pelanggan created successfully',
            'data' => $data
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/pelanggan/{id}",
     *     tags={"Pelanggan"},
     *     summary="Update existing pelanggan",
     *     security={{"bearerAuth":{}}},
     *     operationId="updatePelanggan",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Andi"),
     *             @OA\Property(property="kontak", type="string", example="081234000000"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Sudirman 23")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pelanggan updated successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Pelanggan updated successfully",
     *                 "data": {"id": 1, "nama": "Andi", "kontak": "081234000000", "alamat": "Jl. Sudirman 23"}
     *             }
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $data = pelanggan::findOrFail($id);
        $data->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan updated successfully',
            'data' => $data
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/pelanggan/{id}",
     *     tags={"Pelanggan"},
     *     summary="Delete a pelanggan",
     *     security={{"bearerAuth":{}}},
     *     operationId="deletePelanggan",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pelanggan deleted successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Pelanggan deleted successfully"
     *             }
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $data = pelanggan::findOrFail($id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan deleted successfully'
        ]);
    }
}
