<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiMasukController extends Controller
{
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
    public function listTransaksiMasuk()
    {
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved incoming transactions',
            'data' => [
                [
                    'barang_id' => 1,
                    'suplier_id' => 2,
                    'tanggal' => '2025-05-06',
                    'jumlah' => 10,
                    'harga_beli' => 15000
                ],
                [
                    'barang_id' => 2,
                    'suplier_id' => 3,
                    'tanggal' => '2025-05-05',
                    'jumlah' => 5,
                    'harga_beli' => 20000
                ]
            ]
        ]);
    }
}
