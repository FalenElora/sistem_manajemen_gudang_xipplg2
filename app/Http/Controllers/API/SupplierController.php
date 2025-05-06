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
     *     operationId="listSupplier",
     *     summary="List of Suppliers",
     *     description="Retrieve all supplier data",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "status": 200,
     *                 "message": "Supplier retrieved successfully.",
     *                 "data": {
     *                     {"id": 1, "nama_supplier": "PT Maju", "kontak_selanggan": "0823456", "alamat": "Jl. Merdeka"}
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function index()
    {
        $supplier = Supplier::all();

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
     *     description="Add a new supplier",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_supplier", "kontak_selanggan", "alamat"},
     *             @OA\Property(property="nama_supplier", type="string", example="PT Sejahtera"),
     *             @OA\Property(property="kontak_selanggan", type="string", example="08123456789"),
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
     *                 "data": {"id": 3, "nama_supplier": "PT Sejahtera", "kontak_selanggan": "08123456789", "alamat": "Jl. Kebangsaan No.10"}
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak_selanggan' => 'required|string|max:255',
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
     *             @OA\Property(property="nama_supplier", type="string", example="CV Makmur Jaya"),
     *             @OA\Property(property="kontak_selanggan", type="string", example="08987654321"),
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
     *                 "data": {"id": 1, "nama_supplier": "CV Makmur Jaya", "kontak_selanggan": "08987654321", "alamat": "Jl. Industri No.5"}
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
            'nama_supplier' => 'required|string|max:255',
            'kontak_selanggan' => 'required|string|max:255',
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
