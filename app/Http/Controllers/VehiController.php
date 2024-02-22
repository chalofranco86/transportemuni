<?php

namespace App\Http\Controllers;

use App\Models\Vehi;
use Illuminate\Http\Request;

class VehiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehis = Vehi::paginate();

        return view('vehi.index', compact('vehis'))
            ->with('i', (request()->input('page', 1) - 1) * $vehis->perPage());
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
    
        // Verifica si se están enviando nuevos archivos y actualiza las rutas
        if (request()->hasFile('tarjeta_circulacion')) {
            $tarjetaCirculacionPath = request()->file('tarjeta_circulacion')->store('tarjetas_circulacion', 'public');
            $vehi->tarjeta_circulacion = $tarjetaCirculacionPath;
        }
    
        if (request()->hasFile('titulo_propiedad')) {
            $tituloPropiedadPath = request()->file('titulo_propiedad')->store('titulos_propiedad', 'public');
            $vehi->titulo_propiedad = $tituloPropiedadPath;
        }
    
        // Guarda los cambios en la base de datos después de actualizar las rutas
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
        request()->validate(Vehi::$rules);

        $vehi->update($request->all());

        return redirect()->route('vehis.index')
            ->with('success', 'Vehi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehi = Vehi::find($id)->delete();

        return redirect()->route('vehis.index')
            ->with('success', 'Vehi deleted successfully');
    }
}
