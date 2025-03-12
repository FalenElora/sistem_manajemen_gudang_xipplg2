<?php

namespace App\Http\Controllers;
use App\Models\Transaksi_masuk;
use App\Models\Barang;



use Illuminate\Http\Request;

class Transaksi_masukController extends Controller
{
    public function index()
    {
        $transaksiMasuk = Transaksi_masuk::with(['barang', 'supplier'])->get();
        return response()->json($transaksiMasuk);
    }

    /**
     * Menyimpan transaksi masuk baru dan menambahkan stok barang.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|integer|min:1',
        ]);

        // Simpan transaksi masuk
        $transaksi = Transaksi_masuk::create([
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'harga_beli' => $request->harga_beli,
        ]);

        // Tambah stok barang
        $barang = Barang::find($request->barang_id);
        if ($barang) {
            $barang->increment('jumlah', $request->jumlah); // Menambah stok barang
        }

        return response()->json([
            'message' => 'Transaksi masuk berhasil ditambahkan dan stok barang diperbarui.',
            'transaksi' => $transaksi,
            'barang' => $barang
        ]);
    }
}
