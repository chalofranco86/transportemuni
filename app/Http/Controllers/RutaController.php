<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Propio;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDF;

/**
 * Class RutaController
 * @package App\Http\Controllers
 */
class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $rutas = collect(); // Initialize an empty collection by default
    
        if ($user->role === 'propietario') {
            // Find the corresponding owner
            $propio = Propio::where('correo_propietario', $user->email)->first();
    
            if ($propio) {
                // Get the routes associated with this owner
                $rutas = Ruta::whereHas('vehis', function($query) use ($propio) {
                    $query->whereHas('propios', function($q) use ($propio) {
                        $q->where('propios.id', $propio->id);
                    });
                })->paginate();
            }
        } elseif ($user->role === 'piloto') {
            // Get the cards associated with this pilot
            $cards = Card::where('correo_piloto', $user->email)->pluck('numero_vehiculo_id');
    
            if ($cards->isNotEmpty()) {
                // Get the routes associated with the pilot's vehicles
                $rutas = Ruta::whereHas('vehis', function($query) use ($cards) {
                    $query->whereIn('id', $cards);
                })->paginate();
            }
        } else {
            // For other roles, get all routes
            $rutas = Ruta::paginate();
        }

        return view('ruta.index', compact('rutas'))
            ->with('i', (request()->input('page', 1) - 1) * $rutas->perPage());
    }
    
    public function generateAllRPDF()
    {
        try {
            set_time_limit(300); // Set to 5 minutes 
    
            // Obtener todos los vehículos
            $rutas = Ruta::all();
    
            // Verificar si hay vehículos
            if ($rutas->isEmpty()) {
                return redirect()->route('ruta.index')->with('error', 'No hay vehículos para generar el PDF');
            }
    
            // Cargar la vista con todos los vehículos
            $pdf = PDF::loadView('report.reportrutastable', compact('rutas'));
            return $pdf->download('reporterutas.pdf');
        } catch (\Exception $e) {
            // Puedes registrar la excepción para una investigación adicional
            \Log::error($e);
    
            // Redireccionar a una página de error
            return redirect()->route('rutas.index')->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ruta = new Ruta();
        return view('ruta.create', compact('ruta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ruta::$rules);

        $ruta = Ruta::create($request->all());

        return redirect()->route('rutas.index')
            ->with('success', 'Ruta created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ruta = Ruta::find($id);

        return view('ruta.show', compact('ruta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruta = Ruta::find($id);

        return view('ruta.edit', compact('ruta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ruta $ruta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruta $ruta)
    {
        request()->validate(Ruta::$rules);

        $ruta->update($request->all());

        return redirect()->route('rutas.index')
            ->with('success', 'Ruta updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ruta = Ruta::find($id)->delete();

        return redirect()->route('rutas.index')
            ->with('success', 'Ruta deleted successfully');
    }
}
