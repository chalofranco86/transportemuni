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
    
        // Filtrar solo los métodos HTTP que corresponden a create, edit y delete
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            // Obtener detalles adicionales
            $ipAddress = $request->ip();
            $userAgent = $request->header('User-Agent');
            $requestParams = json_encode($request->all());
        
            // Crear un nuevo registro en la bitácora
            Bitacora::create([
                'user_id' => $user->id,
                'descripcion' => 'Acción en la ruta: ' . $request->getPathInfo() . 
                                 ', Método: ' . $request->method() . 
                                 ', IP: ' . $ipAddress . 
                                 ', Agente de Usuario: ' . $userAgent . 
                                 ', Parámetros: ' . $requestParams,
            ]);
        }
    
        return $response;
    }
}