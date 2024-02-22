<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
Use App\Models\Ruta;
use App\Models\Tarjetapiloto;
use Illuminate\Http\Request;

/**
 * Class VehiculoController
 * @package App\Http\Controllers
 */
class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos = Vehiculo::with('tarjetapiloto', 'ruta')->paginate();
    
        return view('vehiculo.index', compact('vehiculos'))
            ->with('i', (request()->input('page', 1) - 1) * $vehiculos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rutas = Ruta::pluck('numero_ruta', 'id');
        $pilotos = Tarjetapiloto::pluck('nombre_piloto', 'id');
        $vehiculo = new Vehiculo(); // Agrega esta línea para crear una instancia de Vehiculo
        return view('vehiculo.create', compact('rutas', 'pilotos', 'vehiculo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            // ... otras validaciones ...
            'tarjeta_circulacion' => 'nullable|mimes:pdf|max:2048', // Ajusta según tus necesidades
            'titulo_propiedad' => 'nullable|mimes:pdf|max:2048', // Ajusta según tus necesidades
        ]);

        // Crear una instancia de Vehiculo con los datos del formulario
        $vehiculo = new Vehiculo($request->all());

        // Manejar la carga de archivos y almacenar las rutas en la base de datos
        if ($request->hasFile('tarjeta_circulacion')) {
            $tarjetaCirculacionPath = $request->file('tarjeta_circulacion')->store('tarjetas_circulacion', 'public');
            $vehiculo->tarjeta_circulacion = $tarjetaCirculacionPath;
        }

        if ($request->hasFile('titulo_propiedad')) {
            $tituloPropiedadPath = $request->file('titulo_propiedad')->store('titulos_propiedad', 'public');
            $vehiculo->titulo_propiedad = $tituloPropiedadPath;
        }

        // Guardar el vehículo en la base de datos
        $vehiculo->save();

        // Redireccionar a la vista de índice con un mensaje de éxito
        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehiculo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);

        return view('vehiculo.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::find($id);

        return view('vehiculo.edit', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Vehiculo $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        request()->validate(Vehiculo::$rules);

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehiculo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id)->delete();

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehiculo deleted successfully');
    }
}
