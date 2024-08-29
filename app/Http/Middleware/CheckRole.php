<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Verifica si el usuario está autenticado y si su rol está en la lista de roles permitidos
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            return redirect()->route('home')->with('error', 'ACCESO NO PERMITIDO');
        }
    
        return $next($request);
    }
}