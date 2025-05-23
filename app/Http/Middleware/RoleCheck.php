<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
   public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Ambil role admin dan user dari .env
        $adminRole = env('ADMIN_ROLE', 'admin');
        $userRole = env('USER_ROLE', 'user');

        // Contoh pengecekan jika ingin batasi role
        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'Forbidden - Role not allowed'], 403);
        }

        return $next($request);
    }
}
