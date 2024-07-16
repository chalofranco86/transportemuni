<?php

namespace App\Http\Controllers;

use App\Models\Vehi;
use App\Models\Card;
use App\Models\Propio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class VehiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $vehis = collect(); // Inicializa una colección vacía por defecto
    
        if ($user->role === 'propietario') {
            // Encuentra el propietario correspondiente
            $propio = Propio::where('correo_propietario', $user->email)->first();
    
            if ($propio) {
                // Obtén los vehículos asociados a este propietario
                $vehis = Vehi::whereHas('propios', function($query) use ($propio) {
                    $query->where('propios.id', $propio->id);
                })->paginate();
            }
        } elseif ($user->role === 'piloto') {
            // Obtén las tarjetas asociadas a este piloto
            $cards = Card::where('correo_piloto', $user->email)->pluck('numero_vehiculo_id');
    
            if ($cards->isNotEmpty()) {
                // Obtén los vehículos asociados a las tarjetas del piloto
                $vehis = Vehi::whereIn('id', $cards)->paginate();
            }
        } else {
            // Para otros roles, obtén todos los vehículos
            $vehis = Vehi::paginate();
        }
    
        return view('vehi.index', compact('vehis'))
            ->with('i', (request()->input('page', 1) - 1) * $vehis->perPage());
    }
    
    public function generateAllPDF()
    {
        try {
            set_time_limit(300); // Set to 5 minutes 
        
            // Obtener todos los vehículos
            $vehis = Vehi::all();
        
            // Verificar si hay vehículos
            if ($vehis->isEmpty()) {
                return redirect()->route('vehi.index')->with('error', 'No hay vehículos para generar el PDF');
            }
        
            // Cargar la vista con todos los vehículos
            $pdf = PDF::loadView('report.reportvehitable', compact('vehis'));
            return $pdf->download('reportevehiculos.pdf');
        } catch (\Exception $e) {
            // Puedes registrar la excepción para una investigación adicional
            \Log::error($e);
        
            // Redireccionar a una página de error
            return redirect()->route('vehis.index')->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehi = new Vehi();
        return view('vehi.create', compact('vehi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validaciones
        request()->validate(Vehi::$rules);

        // Crear una instancia de Vehi con los datos del formulario
        $vehi = new Vehi($request->all());

        // Manejar la carga de archivos y almacenar las rutas en la base de datos
        if ($request->hasFile('tarjeta_circulacion')) {
            $tarjetaCirculacionPath = $request->file('tarjeta_circulacion')->store('tarjetas_circulacion', 'public');
            $vehi->tarjeta_circulacion = $tarjetaCirculacionPath;
        }

        if ($request->hasFile('titulo_propiedad')) {
            $tituloPropiedadPath = $request->file('titulo_propiedad')->store('titulos_propiedad', 'public');
            $vehi->titulo_propiedad = $tituloPropiedadPath;
        }

        // Guardar el vehículo en la base de datos
        $vehi->save();

        // Redireccionar a la vista de índice con un mensaje de éxito
        return redirect()->route('vehis.index')
            ->with('success', 'Vehi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehi = Vehi::find($id);

        return view('vehi.show', compact('vehi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Encuentra el vehículo por su ID
        $vehi = Vehi::find($id);
    
        // Retorna la vista de edición con los datos del vehículo
        return view('vehi.edit', compact('vehi'));
    }
    

    /**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request $request
 * @param  Vehi $vehi
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, Vehi $vehi)
{
    // Validar los datos del formulario
    $request->validate(Vehi::$rules);

    // Actualizar los datos del vehículo con los datos del formulario
    $vehi->update($request->all());

    // Manejar la carga de archivos si se están enviando nuevos archivos
    if ($request->hasFile('tarjeta_circulacion')) {
        $tarjetaCirculacionPath = $request->file('tarjeta_circulacion')->store('tarjetas_circulacion', 'public');
        $vehi->tarjeta_circulacion = $tarjetaCirculacionPath;
    }

    if ($request->hasFile('titulo_propiedad')) {
        $tituloPropiedadPath = $request->file('titulo_propiedad')->store('titulos_propiedad', 'public');
        $vehi->titulo_propiedad = $tituloPropiedadPath;
    }

    // Guardar los cambios en la base de datos
    $vehi->save();

    // Redireccionar a la vista de índice con un mensaje de éxito
    return redirect()->route('vehis.index')->with('success', 'Vehículo actualizado correctamente');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $vehi = Vehi::find($id)->delete();
            return redirect()->route('vehis.index')
                ->with('success', 'Vehi deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'No se puede eliminar el vehículo porque se está utilizando en otro módulo de la aplicación.');
        }
    }
    
}
