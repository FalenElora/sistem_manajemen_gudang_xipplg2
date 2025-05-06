<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use OpenAPI\Attributes as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API Portal Berita",
 *     description="Portal Berita API Documentation"
 * )
 * @OA\Server(
 *     url="http://127.0.0.1:8000/api",
 *     description="Local server"
 * )
 * @OA\Server(
 *     url="http://staging.example.com",
 *     description="Staging server"
 * )
 * @OA\Server(
 *     url="http://example.com",
 *     description="Production server"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     name="Authorization",
 *     in="header",
 *     scheme="bearer"
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
=======
abstract class Controller {
    
}
>>>>>>> 5569262917e13d3820a4d2d7e2c5bc945e5efcfc
