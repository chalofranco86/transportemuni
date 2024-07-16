<?php

namespace App\Http\Controllers;

use App\Models\Propio;
use App\Models\Vehi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Importa Hash
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $user = Auth::user();
    
        // Si el usuario tiene el rol de "superadmin", muestra todos los registros
        if ($user->role == 'superadmin') {
            $propios = Propio::paginate();
        } else {
            // Filtrar los propietarios basándose en el correo del usuario autenticado
            $propios = Propio::where('correo_propietario', $user->email)->paginate();
        }
    
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
        $vehiculosAsociados = []; // Initialize as empty array
        
        // Check if $propio has vehis loaded
        if ($propio->exists) {
            $vehiculosAsociados = $propio->vehis->pluck('id')->toArray();
        }
    
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
        // Validaciones
        $validatedData = $request->validate([
            'nombre_propietario' => 'required',
            'dpi_propietario' => 'required|file|mimes:pdf|max:2048',
            'nit_propietario' => 'required',
            'telefono_propietario' => 'required',
            'correo_propietario' => 'required',
            'direccion_fiscal' => 'required',
            'numero_vehiculo_id' => 'required|array',
            'numero_vehiculo_id.*' => 'exists:vehi,id',
            'nombre_empresa' => 'nullable',
            'nit_empresa' => 'nullable',
        ]);

        // Verifica si se está enviando un archivo para "dpi_propietario"
        if ($request->hasFile('dpi_propietario')) {
            $dpiPath = $request->file('dpi_propietario')->store('dpi_propietario', 'public');
            $validatedData['dpi_propietario'] = $dpiPath;
        }

        // Crear un nuevo Propio con los datos validados
        $propio = Propio::create($validatedData);

        // Crear un nuevo usuario con la información del propietario
        $user = User::create([
            'name' => $validatedData['nombre_propietario'],
            'email' => $validatedData['correo_propietario'],
            'password' => Hash::make($validatedData['correo_propietario']), // Generar una contraseña genérica
            'role' => 'propietario',
            'roles' => '2'
        ]);

        // Asociar los vehículos seleccionados al propietario
        $vehiIds = $request->input('numero_vehiculo_id');
        $propio->vehis()->attach($vehiIds);

        // Actualizar los campos adicionales en la tabla propios
        $propio->numero_vehiculos_asociados = count($vehiIds);
        $propio->vehiculos_asociados = json_encode($vehiIds);
        $propio->save();

        // Redireccionar a la vista de índice con un mensaje de éxito
        return redirect()->route('propio.index')->with('success', 'Propio creado exitosamente.');
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
        // Validaciones
        $validatedData = $request->validate([
            'nombre_propietario' => 'required',
            'dpi_propietario' => 'nullable|file|mimes:pdf|max:2048',
            'nit_propietario' => 'required',
            'telefono_propietario' => 'required',
            'correo_propietario' => 'required',
            'direccion_fiscal' => 'required',
            'numero_vehiculo_id' => 'required|array',
            'numero_vehiculo_id.*' => 'exists:vehi,id',
            'nombre_empresa' => 'nullable',
            'nit_empresa' => 'nullable',
        ]);

        // Verificar y manejar la carga de archivos para dpi_propietario
        if ($request->hasFile('dpi_propietario')) {
            // Eliminar el archivo anterior si existe
            if ($propio->dpi_propietario) {
                Storage::disk('public')->delete($propio->dpi_propietario);
            }

            // Almacenar el nuevo archivo y actualizar la ruta en la base de datos
            $dpiPath = $request->file('dpi_propietario')->store('dpi_propietario', 'public');
            $validatedData['dpi_propietario'] = $dpiPath;
        }

        // Actualizar los otros campos del propietario
        $propio->update($validatedData);

        // Actualizar los vehículos asociados al propietario
        $vehiIds = $request->input('numero_vehiculo_id');
        $propio->vehis()->sync($vehiIds);

        // Actualizar los campos adicionales en la tabla propios
        $propio->numero_vehiculos_asociados = count($vehiIds);
        $propio->vehiculos_asociados = json_encode($vehiIds);
        $propio->save();

        // Redireccionar a la vista de índice con un mensaje de éxito
        return redirect()->route('propio.index')->with('success', 'Propio actualizado exitosamente.');
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
