<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
            $supplier = Supplier::all();

            return response()->json([
                'status' => 200,
                'message' => 'Supplier retrieved successfully.',
                'data' => $supplier
            ], 200);
    }
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
            'message' => 'Supplier retrieved seccessfully.',
            'data' => $supplier
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if(!$supplier) {
            return response()->json([
                'status' => 404, 
                'message' => 'Supplier Not Found.',
                'data' => null
            ], 400);
        }

        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak_supplier' => 'required|string|max:255',
            'alamat' => 'required|string|max:255'

        ]);

        $supplier->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Supplier update successfully.',
            'data' => $supplier
        ], 200);
    }
    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json([
                'status' => 404, 
                'message' => 'Category not found.',
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
