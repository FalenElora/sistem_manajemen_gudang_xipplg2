<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use OpenAPI\Attributes as OA;

/**
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Gunakan token Bearer dari login",
 *     name="Authorization",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearerAuth"
 * )
 */

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

abstract class Controller {
    
}