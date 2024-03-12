<?php

namespace App\Http\Controllers;

use App\Models\Propio;
use App\Models\Vehi;
use Illuminate\Http\Request;
use PDF;

/**
 * Class PropioController
 * @package App\Http\Controllers
 */
class PropioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propios = Propio::paginate();

        return view('propio.index', compact('propios'))
            ->with('i', (request()->input('page', 1) - 1) * $propios->perPage());
    }

    public function generateAllPDF()
{
    try {
        set_time_limit(300); // Set to 5 minutes 

        // Obtener todos los propios
        $propios = Propio::all();

        // Verificar si hay propios
        if ($propios->isEmpty()) {
            return redirect()->route('propio.index')->with('error', 'No hay propios para generar el PDF');
        }

        // Cargar la vista con todos los propios
        $pdf = PDF::loadView('report.reportpropiotable', compact('propios'));
        return $pdf->download('reportepropios.pdf');
    } catch (\Exception $e) {
        // Puedes registrar la excepción para una investigación adicional
        \Log::error($e);

        // Redireccionar a una página de error
        return redirect()->route('propios.index')->with('error', 'Error al generar el PDF: ' . $e->getMessage());
    }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function create(Request $request)
{
    $propio = new Propio();
    $vehi = Vehi::all(); // Obtén todos los vehículos

    // Obtén los vehículos asociados al propietario actual
    $vehiculosAsociados = $propio->vehi->pluck('id')->toArray();

    return view('propio.create', compact('propio', 'vehi', 'vehiculosAsociados'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Asegúrate de que los campos requeridos estén presentes
        $validatedData = $request->validate([
            'nombre_propietario' => 'required',
            'dpi_propietario' => 'required|file|mimes:pdf|max:2048',
            'nit_propietario' => 'required',
            'telefono_propietario' => 'required',
            'correo_propietario' => 'required',
            'direccion_fiscal' => 'required',
            'numero_vehiculo_id' => 'required|array',
            'numero_vehiculo_id.*' => 'exists:vehi,id',
            'vehi_id' => 'array',
            'vehi_id.*' => 'exists:vehi,id',
            'nombre_empresa' => 'nullable',
            'nit_empresa' => 'nullable',
        ]);
    
        // Verifica si se está enviando un archivo para "dpi_propietario"
        if ($request->hasFile('dpi_propietario')) {
            $dpiPath = $request->file('dpi_propietario')->store('dpi_propietario', 'public');
            $validatedData['dpi_propietario'] = $dpiPath;
        }

        // Crea un nuevo Propio con los datos validados
        $propio = Propio::create($validatedData);
    
        // Asocia el vehículo seleccionado al propietario
        $propio->vehi_id = $request->input('numero_vehiculo_id');
        $propio->save();
    
        // Obtiene los vehículos asociados actualmente y agrega el nuevo vehículo seleccionado
        $vehiIds = $request->input('numero_vehiculo_id', []);
    
        // Convierte el array de vehículo IDs a un formato que puedas almacenar en la base de datos
        $serializedVehiIds = json_encode($vehiIds);
    
        // Actualiza los vehículos asociados al propietario
        $propio->update(['vehiculos_asociados' => $serializedVehiIds]);
    
        // Redirecciona a la vista de índice con un mensaje de éxito
        return redirect()->route('propio.index')->with('success', 'Propio created successfully.');
    }  
    
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propio = Propio::find($id);
    
        // Asegúrate de que $propio no sea null y vehiculos_asociados no esté vacío
        $propio->vehiculos_asociados = json_decode($propio->vehiculos_asociados, true);
    
        return view('propio.show', compact('propio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propio = Propio::find($id);
        $vehi = Vehi::all();
    
        // Obtén los vehículos asociados al propietario actual
        $vehiculosAsociados = $propio->vehiculos_asociados ? json_decode($propio->vehiculos_asociados) : [];
    
        return view('propio.edit', compact('propio', 'vehi', 'vehiculosAsociados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Propio $propio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Propio $propio)
    {
        request()->validate(Propio::$rules);

        $propio->update($request->all());

        return redirect()->route('propios.index')
            ->with('success', 'Propio updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $propio = Propio::find($id)->delete();

        return redirect()->route('propios.index')
            ->with('success', 'Propio deleted successfully');
    }
}
