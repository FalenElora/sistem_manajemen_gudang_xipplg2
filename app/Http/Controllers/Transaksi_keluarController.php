<?php

namespace App\Http\Controllers;
use App\Models\Transaksi_keluar;
use App\Models\Barang;
use Illuminate\Http\Request;

class Transaksi_keluarController extends Controller
{
    public function index()
    {
        $transaksiKeluar = Transaksi_keluar::with('barang', 'pelanggan')->get();
        return response()->json($transaksiKeluar);
    }

    /**
     * Menyimpan transaksi keluar baru dan mengurangi stok barang.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'harga_jual' => 'required|integer|min:1',
        ]);

        // Cari barang
        $barang = Barang::find($request->barang_id);
        
        if (!$barang || $barang->jumlah < $request->jumlah) {
            return response()->json([
                'message' => 'Stok barang tidak mencukupi atau barang tidak ditemukan.'
            ], 400);
        }

        // Simpan transaksi keluar
        $transaksi = Transaksi_keluar::create([
            'barang_id' => $request->barang_id,
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual,
        ]);

        // Kurangi stok barang
        $barang->decrement('jumlah', $request->jumlah);

        return response()->json([
            'message' => 'Transaksi keluar berhasil ditambahkan dan stok barang dikurangi.',
            'transaksi' => $transaksi,
            'barang' => $barang
        ]);
    }
}
