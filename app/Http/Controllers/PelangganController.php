<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();

        return response()->json([
            'status' => 200,
            'message' => 'Pelanggan retrieved successfully.',
            'data' => $pelanggan
        ], 200);
    }

    // Menambahkan pelanggan baru
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'alamat' => 'required|string|max:255'
        ]);

        $pelanggan = Pelanggan::create($validate);

        return response()->json([
            'status' => 201,
            'message' => 'Pelanggan created successfully.',
            'data' => $pelanggan
        ], 201);
    }

    // Menampilkan pelanggan berdasarkan ID
    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'status' => 404,
                'message' => 'Pelanggan not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Pelanggan retrieved successfully.',
            'data' => $pelanggan
        ], 200);
    }

    // Mengupdate data pelanggan
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'status' => 404,
                'message' => 'Pelanggan not found.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'alamat' => 'required|string|max:255'
        ]);

        $pelanggan->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Pelanggan updated successfully.',
            'data' => $pelanggan
        ], 200);
    }

    // Menghapus pelanggan berdasarkan ID
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'status' => 404,
                'message' => 'Pelanggan not found.',
                'data' => null
            ], 404);
        }

        $pelanggan->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Pelanggan deleted successfully.',
            'data' => null
        ], 200);
    }
}
