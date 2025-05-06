<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Documentation",
 *      description="Documentation for the Bookstore API",
 *      @OA\Contact(
 *          email="admin@example.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apche.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Server"
 * )
 */

 /**
 * @OA\Schema(
 *     schema="TransaksiMasuk",
 *     type="object",
 *     @OA\Property(property="barang_id", type="integer", example=1),
 *     @OA\Property(property="suplier_id", type="integer", example=2),
 *     @OA\Property(property="tanggal", type="string", format="date", example="2025-05-06"),
 *     @OA\Property(property="jumlah", type="integer", example=10),
 *     @OA\Property(property="harga_beli", type="number", format="float", example=15000)
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
