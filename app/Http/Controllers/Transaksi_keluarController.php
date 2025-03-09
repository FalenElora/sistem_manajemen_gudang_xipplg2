<?php

namespace App\Http\Controllers;
use App\Models\Transaksi_keluar;
use App\Models\Barang;
use Illuminate\Http\Request;

class Transaksi_keluarController extends Controller
{
    public function index()
    {
        $transaksi_keluars = Transaksi_keluar::all();

        return response()->json([
            'status' => 200,
            'message' => 'Transaksi keluar retrieved successfully.',
            'data' => $transaksi_keluars
        ], 200);
    }

    // Menambahkan transaksi keluar baru dan mengurangi stok barang
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'harga_jual' => 'required|integer|min:0'
        ]);

        $barang = Barang::find($request->barang_id);

        // Pastikan stok barang cukup
        if ($barang->jumlah < $request->jumlah) {
            return response()->json([
                'status' => 400,
                'message' => 'Stok barang tidak mencukupi.',
                'data' => null
            ], 400);
        }

        // Kurangi stok barang
        $barang->jumlah -= $request->jumlah;
        $barang->save();

        // Simpan transaksi keluar
        $transaksiKeluar = Transaksi_keluar::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Transaksi keluar berhasil dibuat.',
            'data' => $transaksiKeluar
        ], 201);
    }

    // Menampilkan transaksi keluar berdasarkan ID
    public function show($id)
    {
        $transaksiKeluar = Transaksi_keluar::find($id);

        if (!$transaksiKeluar) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaksi keluar tidak ditemukan.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Transaksi keluar retrieved successfully.',
            'data' => $transaksiKeluar
        ], 200);
    }

    // Mengupdate transaksi keluar berdasarkan ID
    public function update(Request $request, $id)
    {
        $transaksiKeluar = Transaksi_keluar::find($id);

        if (!$transaksiKeluar) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaksi keluar tidak ditemukan.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'barang_id' => 'exists:barangs,id',
            'supplier_id' => 'exists:suppliers,id',
            'tanggal' => 'date',
            'jumlah' => 'integer|min:1',
            'harga_jual' => 'integer|min:0'
        ]);

        $transaksiKeluar->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Transaksi keluar berhasil diperbarui.',
            'data' => $transaksiKeluar
        ], 200);
    }

    // Menghapus transaksi keluar berdasarkan ID
    public function destroy($id)
    {
        $transaksiKeluar = Transaksi_keluar::find($id);

        if (!$transaksiKeluar) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaksi keluar tidak ditemukan.',
                'data' => null
            ], 404);
        }

        $transaksiKeluar->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Transaksi keluar berhasil dihapus.',
            'data' => null
        ], 200);
    
}
}
