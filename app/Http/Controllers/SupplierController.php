<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();

        return response()->json([
            'status' => 200,
            'message' => 'Suppliers retrieved successfully.',
            'data' => $suppliers
        ], 200);
    }

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

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json([
                'status' => 404,
                'message' => 'Supplier not found.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'kontak' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string|max:255'
        ]);

        $supplier->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Supplier updated successfully.',
            'data' => $supplier
        ], 200);
    }

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
