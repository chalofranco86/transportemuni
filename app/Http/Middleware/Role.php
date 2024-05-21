<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check() && Auth::user->role == $role) {
            return $next($request);
        }
        return response()->json("No tienes permiso para acceder a esta página.");
    }
}