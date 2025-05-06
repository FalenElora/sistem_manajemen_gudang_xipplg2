<?php

namespace App\Http\Controllers;
use App\Models\Transaksi_masuk;
use App\Models\Barang;



use Illuminate\Http\Request;

class Transaksi_masukController extends Controller
{
    public function index()
    /**
 * @OA\Get(
 *     path="/transaksi-masuk",
 *     tags={"Transaksi Masuk"},
 *     operationId="listTransaksiMasuk",
 *     summary="List of Transaksi Masuk",
 *     description="Retrieve a list of incoming transactions",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Successfully retrieved incoming transactions",
 *                 "data": {
 *                     {
 *                         "barang_id": 1,
 *                         "suplier_id": 2,
 *                         "tanggal": "2025-05-06",
 *                         "jumlah": 10,
 *                         "harga_beli": 15000
 *                     },
 *                     {
 *                         "barang_id": 2,
 *                         "suplier_id": 3,
 *                         "tanggal": "2025-05-05",
 *                         "jumlah": 5,
 *                         "harga_beli": 20000
 *                     }
 *                 }
 *             }
 *         )
 *     )
 * )
 */

    {
        $transaksiMasuks = Transaksi_masuk::with('barang', 'supplier')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Data transaksi masuk berhasil diambil.',
            'data' => $transaksiMasuks
        ], 200);
    }

    
    public function store(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'supplier_id' => 'required|exists:suppliers,id',
        'tanggal' => 'required|date',
        'jumlah' => 'required|integer|min:1',
        'harga_beli' => 'required|integer|min:1',
    ]);

    
    $transaksi = Transaksi_masuk::create($request->all());

    
    $barang = Barang::find($request->barang_id);
    $barang->jumlah += $request->jumlah; 
    $barang->save();

    return response()->json([
        'status' => 201,
        'message' => 'Transaksi masuk berhasil.',
        'data' => $transaksi
    ], 201);
}


    
    public function show($id)
    {
        $transaksiMasuk = Transaksi_masuk::with('barang', 'supplier')->find($id);

        if (!$transaksiMasuk) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaksi masuk tidak ditemukan.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Data transaksi masuk berhasil diambil.',
            'data' => $transaksiMasuk
        ], 200);
    }

    
    public function update(Request $request, $id)
    {
        $transaksiMasuk = Transaksi_masuk::find($id);

        if (!$transaksiMasuk) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaksi masuk tidak ditemukan.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'barang_id' => 'exists:barangs,id',
            'supplier_id' => 'exists:suppliers,id',
            'tanggal' => 'date',
            'jumlah' => 'integer|min:1',
            'harga_beli' => 'integer|min:0'
        ]);

        $transaksiMasuk->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Transaksi masuk berhasil diperbarui.',
            'data' => $transaksiMasuk
        ], 200);
    }

    
    public function destroy($id)
    {
        $transaksiMasuk = Transaksi_masuk::find($id);

        if (!$transaksiMasuk) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaksi masuk tidak ditemukan.',
                'data' => null
            ], 404);
        }

        $transaksiMasuk->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Transaksi masuk berhasil dihapus.',
            'data' => null
        ], 200);
    }
}
