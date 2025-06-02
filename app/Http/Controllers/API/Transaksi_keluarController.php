<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;

class Transaksi_keluarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/transaksi-keluar",
     *     tags={"Transaksi Keluar"},
     *     summary="List semua transaksi keluar",
     *     @OA\Response(
     *         response=200,
     *         description="Daftar transaksi keluar"
     *     )
     * )
     */
    public function index()
    {
        return TransaksiKeluar::all();
    }

    /**
     * @OA\Post(
     *     path="/transaksi-keluar",
     *     tags={"Transaksi Keluar"},
     *     summary="Buat transaksi keluar baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama", "jumlah", "tanggal"},
     *             @OA\Property(property="nama", type="string"),
     *             @OA\Property(property="jumlah", type="integer"),
     *             @OA\Property(property="tanggal", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Transaksi keluar berhasil dibuat")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        return TransaksiKeluar::create($validated);
    }

    /**
     * @OA\Get(
     *     path="/transaksi-keluar/{id}",
     *     tags={"Transaksi Keluar"},
     *     summary="Ambil transaksi keluar berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Detail transaksi keluar")
     * )
     */
    public function show($id)
    {
        return TransaksiKeluar::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/transaksi-keluar/{id}",
     *     tags={"Transaksi Keluar"},
     *     summary="Update transaksi keluar",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string"),
     *             @OA\Property(property="jumlah", type="integer"),
     *             @OA\Property(property="tanggal", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Transaksi keluar berhasil diupdate")
     * )
     */
    public function update(Request $request, $id)
    {
        $transaksi = TransaksiKeluar::findOrFail($id);
        $transaksi->update($request->all());
        return $transaksi;
    }

    /**
     * @OA\Delete(
     *     path="/transaksi-keluar/{id}",
     *     tags={"Transaksi Keluar"},
     *     summary="Hapus transaksi keluar",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Transaksi keluar berhasil dihapus")
     * )
     */
    public function destroy($id)
    {
        $transaksi = TransaksiKeluar::findOrFail($id);
        $transaksi->delete();
        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/transaksi-keluar/search",
     *     tags={"Transaksi Keluar"},
     *     summary="Cari transaksi keluar berdasarkan ID atau Nama",
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="ID atau Nama transaksi",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hasil pencarian transaksi keluar"
     *     )
     * )
     */
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $result = TransaksiKeluar::where('id', $keyword)
            ->orWhere('nama', 'like', '%' . $keyword . '%')
            ->get();

        return response()->json($result);
    }
}