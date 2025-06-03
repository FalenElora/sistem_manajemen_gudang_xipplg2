<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
/**
 * @OA\Get(
 *     path="/barang",
 *     tags={"Barang"},
 *     operationId="listOrSearchBarang",
 *     summary="List or search Barang by name",
 *     description="Retrieve all barang or filter barang by partial match on 'nama' using query string",
 *     @OA\Parameter(
 *         name="nama",
 *         in="query",
 *         required=false,
 *         description="Optional. Partial or full name of the barang to search for",
 *         @OA\Schema(
 *             type="string",
 *             example="mouse"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of barang or search result",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Successfully retrieved barang"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="nama", type="string", example="Mouse Logitech"),
 *                     @OA\Property(property="kategori_id", type="integer", example=2),
 *                     @OA\Property(property="harga", type="number", format="float", example=50000),
 *                     @OA\Property(property="jumlah", type="integer", example=10)
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No matching barang found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="No matching barang found")
 *         )
 *     )
 * )
 */
    public function index(Request $request)
    {
        $nama = $request->query('nama');

        if ($nama) {
            $barang = Barang::where('nama', 'LIKE', '%' . $nama . '%')->get();

            if ($barang->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No matching barang found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Search results',
                'data' => $barang
            ]);
        }

        $barang = Barang::all();
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved barang',
            'data' => $barang
        ]);
    }

        /**
     * @OA\Get(
     *     path="/barang/{id}",
     *     tags={"Barang"},
     *     operationId="getBarangById",
     *     summary="Get barang by ID",
     *     description="Retrieve a single barang record by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Barang retrieved successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Barang retrieved successfully",
     *                 "data": {"id": 1, "nama": "Mouse", "kategori_id": 2, "harga": 50000, "jumlah": 10}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Barang not found",
     *         @OA\JsonContent(
     *             example={
     *                 "success": false,
     *                 "message": "Barang not found"
     *             }
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Barang retrieved successfully',
            'data' => $barang
        ]);
    }
    /**
 * @OA\Get(
 *     path="/barang/kategori/{kategori_id}",
 *     tags={"Barang"},
 *     operationId="getBarangByKategori",
 *     summary="Get barang by kategori ID",
 *     description="Retrieve a list of barang filtered by kategori_id",
 *     @OA\Parameter(
 *         name="kategori_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Barang retrieved successfully",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Barang retrieved by kategori",
 *                 "data": {
 *                     {"id": 1, "nama": "Mouse", "kategori_id": 2, "harga": 50000, "jumlah": 10},
 *                     {"id": 3, "nama": "Keyboard", "kategori_id": 2, "harga": 75000, "jumlah": 5}
 *                 }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No barang found in this kategori",
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "No barang found in this kategori"
 *             }
 *         )
 *     )
 * )
 */
public function getByKategori($kategori_id)
{
    $barang = Barang::where('kategori_id', $kategori_id)->get();

    if ($barang->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No barang found in this kategori'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Barang retrieved by kategori',
        'data' => $barang
    ]);
}


/**
 * @OA\Get(
 *     path="/barang/stok/kurang-dari-100",
 *     tags={"Barang"},
 *     operationId="getBarangWithLowStock",
 *     summary="Get barang with stock less than 100",
 *     description="Retrieve all barang where jumlah (stock) is less than 100",
 *     @OA\Response(
 *         response=200,
 *         description="Barang with low stock retrieved successfully",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Barang with stock less than 100",
 *                 "data": {
 *                     {"id": 2, "nama": "Keyboard", "kategori_id": 2, "harga": 75000, "jumlah": 20},
 *                     {"id": 5, "nama": "Cable", "kategori_id": 3, "harga": 10000, "jumlah": 50}
 *                 }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No barang with low stock found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "No barang found with stock less than 100"
 *             }
 *         )
 *     )
 * )
 */
public function lowStock()
{
    $barang = Barang::where('jumlah', '<', 100)->get();

    if ($barang->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No barang found with stock less than 100'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Barang with stock less than 100',
        'data' => $barang
    ]);
}
/**
 * @OA\Get(
 *     path="/barang/sort/harga",
 *     tags={"Barang"},
 *     operationId="sortBarangByHarga",
 *     summary="Sort barang by harga",
 *     description="Sort barang from cheapest to most expensive or vice versa",
 *     @OA\Parameter(
 *         name="order",
 *         in="query",
 *         description="Sort order: asc (termurah) or desc (termahal)",
 *         required=false,
 *         @OA\Schema(type="string", example="asc")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List sorted by price",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Barang sorted by price",
 *                 "data": {
 *                     {"id": 1, "nama": "Mouse", "harga": 10000},
 *                     {"id": 2, "nama": "Keyboard", "harga": 50000}
 *                 }
 *             }
 *         )
 *     )
 * )
 */
public function sortByHarga(Request $request)
{
    $order = $request->query('order', 'asc'); // default: asc

    $barang = Barang::orderBy('harga', $order)->get();

    return response()->json([
        'success' => true,
        'message' => 'Barang sorted by price',
        'data' => $barang
    ]);
}
/**
 * @OA\Get(
 *     path="/barang/sort/nama",
 *     tags={"Barang"},
 *     operationId="sortBarangByNama",
 *     summary="Sort barang by nama",
 *     description="Sort barang from A to Z or Z to A",
 *     @OA\Parameter(
 *         name="order",
 *         in="query",
 *         description="Sort order: asc (A-Z) or desc (Z-A)",
 *         required=false,
 *         @OA\Schema(type="string", example="asc")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List sorted by nama",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Barang sorted by nama",
 *                 "data": {
 *                     {"id": 1, "nama": "Keyboard"},
 *                     {"id": 2, "nama": "Mouse"}
 *                 }
 *             }
 *         )
 *     )
 * )
 */
public function sortByNama(Request $request)
{
    $order = $request->query('order', 'asc'); // default: asc (A-Z)

    $barang = Barang::orderBy('nama', $order)->get();

    return response()->json([
        'success' => true,
        'message' => 'Barang sorted by nama',
        'data' => $barang
    ]);
}
/**
 * @OA\Get(
 *     path="/barang/sort/jumlah",
 *     tags={"Barang"},
 *     operationId="sortBarangByJumlah",
 *     summary="Sort barang by jumlah stok",
 *     description="Sort barang berdasarkan jumlah stok dari sedikit ke banyak atau sebaliknya",
 *     @OA\Parameter(
 *         name="order",
 *         in="query",
 *         description="Sort order: asc (sedikit ke banyak) atau desc (banyak ke sedikit)",
 *         required=false,
 *         @OA\Schema(type="string", example="asc")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Barang sorted by jumlah",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Barang sorted by jumlah",
 *                 "data": {
 *                     {"id": 1, "nama": "Mouse", "jumlah": 5},
 *                     {"id": 2, "nama": "Keyboard", "jumlah": 20}
 *                 }
 *             }
 *         )
 *     )
 * )
 */
public function sortByJumlah(Request $request)
{
    $order = $request->query('order', 'asc'); // default: asc (sedikit ke banyak)

    $barang = Barang::orderBy('jumlah', $order)->get();

    return response()->json([
        'success' => true,
        'message' => 'Barang sorted by jumlah',
        'data' => $barang
    ]);
}




    /**
     * @OA\Post(
     *     path="/barang",
     *     tags={"Barang"},
     *     operationId="createBarang",
     *     summary="Create a new barang",
     *     security={{"bearerAuth":{}}},
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
     *     security={{"bearerAuth":{}}},
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
     *     security={{"bearerAuth":{}}},
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
