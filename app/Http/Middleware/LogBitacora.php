<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Bitacora; // Asegúrate de importar el modelo Bitacora
use Illuminate\Support\Facades\Auth;

class LogBitacora
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
    
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Crear un nuevo registro en la bitácora
        Bitacora::create([
            'user_id' => $user->id,
            'descripcion' => 'Acción en la ruta: ' . $request->getPathInfo() . ', Método: ' . $request->method(),
        ]);
    
        return $response;
    }
}