<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
   public function handle(Request $request, Closure $next, ...$roles)
    {
        
    }
}
