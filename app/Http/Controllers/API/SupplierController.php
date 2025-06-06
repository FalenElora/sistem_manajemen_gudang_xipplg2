<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
 * @OA\Get(
 *     path="/supplier",
 *     tags={"Supplier"},
 *     operationId="listOrSearchSupplier",
 *     summary="List or search suppliers by name",
 *     description="Retrieve all suppliers or filter by partial match on 'nama' using query string",
 *     @OA\Parameter(
 *         name="nama",
 *         in="query",
 *         required=false,
 *         description="Optional. Partial or full name of the supplier to search for",
 *         @OA\Schema(
 *             type="string",
 *             example="PT Maju"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of suppliers or search result",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="Supplier retrieved successfully."),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="nama", type="string", example="PT Maju"),
 *                     @OA\Property(property="kontak", type="string", example="0823456"),
 *                     @OA\Property(property="alamat", type="string", example="Jl. Merdeka")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No matching supplier found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=404),
 *             @OA\Property(property="message", type="string", example="No matching supplier found")
 *         )
 *     )
 * )
 */
public function index(Request $request)
{
    $nama = $request->query('nama');

    if ($nama) {
        $supplier = Supplier::where('nama', 'LIKE', '%' . $nama . '%')->get();

        if ($supplier->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No matching supplier found',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Search results',
            'data' => $supplier
        ], 200);
    }

    $supplier = Supplier::all();

    return response()->json([
        'status' => 200,
        'message' => 'Supplier retrieved successfully.',
        'data' => $supplier
    ], 200);
}

        /**
     * @OA\Get(
     *     path="/supplier/{id}",
     *     tags={"Supplier"},
     *     operationId="getSupplierById",
     *     summary="Get supplier by ID",
     *     description="Retrieve a single supplier by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Supplier found",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Supplier retrieved successfully.",
     *                 "data": {"id": 1, "nama": "PT Maju", "kontak": "0823456", "alamat": "Jl. Merdeka"}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Supplier not found",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 404,
     *                 "message": "Supplier not found.",
     *                 "data": null
     *             }
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json([
                'status' => 404,
                'message' => 'Supplier not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Supplier retrieved successfully.',
            'data' => $supplier
        ], 200);
    }
    
        


    /**
     * @OA\Post(
     *     path="/supplier",
     *     tags={"Supplier"},
     *     operationId="createSupplier",
     *     summary="Create a new supplier",
     *     security={{"bearerAuth":{}}},
     *     description="Add a new supplier",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama", "kontak", "alamat"},
     *             @OA\Property(property="nama", type="string", example="PT Sejahtera"),
     *             @OA\Property(property="kontak", type="string", example="08123456789"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Kebangsaan No.10")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Supplier created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 201,
     *                 "message": "Supplier created successfully.",
     *                 "data": {"id": 3, "nama": "PT Sejahtera", "kontak": "08123456789", "alamat": "Jl. Kebangsaan No.10"}
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'alamat' => 'required|string|max:255'
        ]);

        $supplier = Supplier::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Supplier created successfully.',
            'data' => $supplier
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/supplier/{id}",
     *     tags={"Supplier"},
     *     operationId="updateSupplier",
     *     summary="Update a supplier",
     *     security={{"bearerAuth":{}}},
     *     description="Update an existing supplier",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="CV Makmur Jaya"),
     *             @OA\Property(property="kontak", type="string", example="08987654321"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Industri No.5")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Supplier updated successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Supplier updated successfully.",
     *                 "data": {"id": 1, "nama": "CV Makmur Jaya", "kontak": "08987654321", "alamat": "Jl. Industri No.5"}
     *             }
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if(!$supplier) {
            return response()->json([
                'status' => 404,
                'message' => 'Supplier Not Found.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'alamat' => 'required|string|max:255'
        ]);

        $supplier->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Supplier updated successfully.',
            'data' => $supplier
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/supplier/{id}",
     *     tags={"Supplier"},
     *     operationId="deleteSupplier",
     *     summary="Delete a supplier",
     *     security={{"bearerAuth":{}}},
     *     description="Delete a supplier by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Supplier deleted successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Supplier deleted successfully.",
     *                 "data": null
     *             }
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json([
                'status' => 404,
                'message' => 'Supplier not found.',
                'data' => null
            ], 404);
        }

        $supplier->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Supplier deleted successfully.',
            'data' => null
        ], 200);
    }
}
