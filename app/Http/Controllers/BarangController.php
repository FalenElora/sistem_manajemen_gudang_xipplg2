<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        return response()->json([
            'status' => 200,
            'message' => 'Daftar barang berhasil diambil.',
            'data' => $barangs
        ], 200);
    }

    // Menambahkan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'harga' => 'required|integer|min:0',
            'jumlah' => 'required|integer|min:0',
        ]);

        // Cek apakah kategori tersedia
        $kategori = Kategori::find($request->kategori_id);
        if (!$kategori) {
            return response()->json([
                'status' => 400,
                'message' => 'Kategori tidak ditemukan.',
                'data' => null
            ], 400);
        }

        $barang = Barang::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Barang berhasil ditambahkan.',
            'data' => $barang
        ], 201);
    }

    // Menampilkan barang berdasarkan ID
    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => 404,
                'message' => 'Barang tidak ditemukan.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Barang berhasil ditemukan.',
            'data' => $barang
        ], 200);
    }

    // Mengupdate data barang
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => 404,
                'message' => 'Barang tidak ditemukan.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'kategori_id' => 'sometimes|integer',
            'harga' => 'sometimes|integer|min:0',
            'jumlah' => 'sometimes|integer|min:0',
        ]);

        if ($request->has('kategori_id')) {
            $kategori = Kategori::find($request->kategori_id);
            if (!$kategori) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Kategori tidak ditemukan.',
                    'data' => null
                ], 400);
            }
        }

        $barang->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Barang berhasil diperbarui.',
            'data' => $barang
        ], 200);
    }

    // Menghapus barang berdasarkan ID
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => 404,
                'message' => 'Barang tidak ditemukan.',
                'data' => null
            ], 404);
        }

        $barang->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Barang berhasil dihapus.',
            'data' => null
        ], 200);
    }
}
