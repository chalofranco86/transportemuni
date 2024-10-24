<?php

namespace App\Http\Controllers;

use App\Models\Vehi;
use App\Models\Card;
use App\Models\Propio;
use App\Models\TipoVehi;
use App\Notifications\VehiEliminado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use illuminate\Support\Facades\Log;
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
        $tiposVehi = TipoVehi::pluck('tipo_vehiculo', 'id_tipo_vehiculo'); // Array asociativo
        $rutas = \App\Models\Ruta::pluck('numero_ruta', 'id'); // Obtener las rutas disponibles
        return view('vehi.create', compact('vehi', 'tiposVehi', 'rutas'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Eliminar esta línea después de la depuración
        // dd($request->all());
    
        // Validaciones
        request()->validate(Vehi::$rules);
    
        // Crear una instancia de Vehi con los datos del formulario
        $vehi = new Vehi($request->except(['tarjeta_circulacion', 'titulo_propiedad'])); // Excluye archivos
    
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
        $vehi = Vehi::find($id);
        $rutas = \App\Models\Ruta::pluck('numero_ruta', 'id'); // Obtener las rutas disponibles
        $tiposVehi = TipoVehi::pluck('tipo_vehiculo', 'id_tipo_vehiculo'); // Obtener los tipos de vehículos disponibles
        
        return view('vehi.edit', compact('vehi', 'rutas', 'tiposVehi'));
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
        Log::info("Inicio de eliminación del vehículo con ID: {$id}");
        DB::beginTransaction();
        try {
            $vehi = Vehi::findOrFail($id);
            Log::info("Vehículo encontrado: {$vehi}");
    
            $vehi->propios()->detach();
            Log::info("Registros de propios_vehiculos eliminados para el vehículo con ID: {$id}");
    
            if ($vehi->tarjeta_circulacion && Storage::disk('public')->exists($vehi->tarjeta_circulacion)) {
                Storage::disk('public')->delete($vehi->tarjeta_circulacion);
                Log::info("Archivo tarjeta_circulacion eliminado para el vehículo con ID: {$id}");
            }
    
            if ($vehi->titulo_propiedad && Storage::disk('public')->exists($vehi->titulo_propiedad)) {
                Storage::disk('public')->delete($vehi->titulo_propiedad);
                Log::info("Archivo titulo_propiedad eliminado para el vehículo con ID: {$id}");
            }
    
            $vehi->delete();
            Log::info("Vehículo con ID: {$id} eliminado exitosamente.");
    
            DB::commit();
    
            return redirect()->route('vehis.index')
                ->with('success', 'Vehi deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al eliminar el vehículo con ID: {$id} - {$e->getMessage()}");
            return redirect()->back()
                ->with('error', 'No se puede eliminar el vehículo porque se está utilizando en otro módulo de la aplicación.');
        }
    }
    
    public function eliminar($id)
    {
        Log::info("Inicio de eliminación del vehículo con ID: {$id}");
        DB::beginTransaction();
        try {
            $vehi = Vehi::findOrFail($id);
            Log::info("Vehículo encontrado: {$vehi}");
    
            // Eliminar registros relacionados
            $vehi->propios()->detach();
            Log::info("Registros de propios_vehiculos eliminados para el vehículo con ID: {$id}");
    
            // Eliminar archivos relacionados
            if ($vehi->tarjeta_circulacion && Storage::disk('public')->exists($vehi->tarjeta_circulacion)) {
                Storage::disk('public')->delete($vehi->tarjeta_circulacion);
                Log::info("Archivo tarjeta_circulacion eliminado para el vehículo con ID: {$id}");
            }
    
            if ($vehi->titulo_propiedad && Storage::disk('public')->exists($vehi->titulo_propiedad)) {
                Storage::disk('public')->delete($vehi->titulo_propiedad);
                Log::info("Archivo titulo_propiedad eliminado para el vehículo con ID: {$id}");
            }
    
            // Eliminar el vehículo
            $vehi->delete();
            Log::info("Vehículo con ID: {$id} eliminado exitosamente.");
    
            DB::commit();
    
            // Enviar notificación al usuario
            $user = Auth::user();
            $user->notify(new VehiEliminado($vehi));
            Log::info("Notificación enviada al usuario.");
    
            return redirect()->route('vehis.index')
                ->with('success', 'Vehículo eliminado exitosamente y notificación enviada.');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Log::error("Error al eliminar el vehículo con ID: {$id} - {$e->getMessage()}");
            return redirect()->route('vehis.index')
                ->with('error', 'No se puede eliminar el vehículo porque se está utilizando en otro módulo de la aplicación.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error inesperado al eliminar el vehículo con ID: {$id} - {$e->getMessage()}");
            return redirect()->route('vehis.index')
                ->with('error', 'Ocurrió un error inesperado al intentar eliminar el vehículo.');
        }
    }
}
