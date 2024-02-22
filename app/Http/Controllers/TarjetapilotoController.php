<?php

namespace App\Http\Controllers;

use App\Models\Tarjetapiloto;
use Illuminate\Http\Request;

/**
 * Class TarjetapilotoController
 * @package App\Http\Controllers
 */
class TarjetapilotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarjetapiloto = Tarjetapiloto::paginate();

        return view('tarjetapiloto.index', compact('tarjetapiloto'))
            ->with('i', (request()->input('page', 1) - 1) * $tarjetapiloto->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tarjetapiloto = new Tarjetapiloto();
        return view('tarjetapiloto.create', compact('tarjetapiloto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validaciones
            $request->validate([
                'nombre_piloto' => 'required',
                'dpi_piloto' => 'required',
                'tipo_licencia_piloto' => 'required',
                'fotografia_piloto' => 'required|mimes:pdf|max:2048',
                'fecha_emision_piloto' => 'required',
                'fecha_vencimiento_piloto' => 'required',
                'direccion_piloto' => 'required',
                'telefono_piloto' => 'required',
                'correo_piloto' => 'required',
                'antecedentes_piloto' => 'required|mimes:pdf|max:2048',
                'imagen_licencia_piloto' => 'required|mimes:pdf|max:2048',
                'renas_piloto' => 'required|mimes:pdf|max:2048',
                'boleto_ornato_piloto' => 'required|mimes:pdf|max:2048',
            ]);
            
            // Procesar archivos PDF
            $fotografiaFileName = $this->processPDF($request, 'fotografia_piloto');
            $antecedentesFileName = $this->processPDF($request, 'antecedentes_piloto');
            $imagenLicenciaFileName = $this->processPDF($request, 'imagen_licencia_piloto');
            $renasFileName = $this->processPDF($request, 'renas_piloto');
            $boletoOrnatoFileName = $this->processPDF($request, 'boleto_ornato_piloto');

            // Crear instancia de Tarjetapiloto con los datos del formulario
            $tarjetapiloto = new Tarjetapiloto([
                'nombre_piloto' => $request->input('nombre_piloto'),
                'dpi_piloto' => $request->input('dpi_piloto'),
                'tipo_licencia_piloto' => $request->input('tipo_licencia_piloto'),
                'fotografia_piloto' => $fotografiaFileName,
                'fecha_emision_piloto' => $request->input('fecha_emision_piloto'),
                'fecha_vencimiento_piloto' => $request->input('fecha_vencimiento_piloto'),
                'direccion_piloto' => $request->input('direccion_piloto'),
                'telefono_piloto' => $request->input('telefono_piloto'),
                'correo_piloto' => $request->input('correo_piloto'),
                'antecedentes_piloto' => $antecedentesFileName,
                'imagen_licencia_piloto' => $imagenLicenciaFileName,
                'renas_piloto' => $renasFileName,
                'boleto_ornato_piloto' => $boletoOrnatoFileName,
            ]);

            // Guardar la tarjeta de piloto en la base de datos
            $tarjetapiloto->save();

            // Redireccionar a la vista de índice con un mensaje de éxito
            return redirect()->route('tarjetapilotos.index')
                ->with('success', 'Tarjetapiloto created successfully.');
        } catch (\Exception $e) {
            // Almacenar detalles de la excepción en la sesión para su visualización
            return redirect()->route('tarjetapilotos.create')
                ->with('error', 'Error: ' . $e->getMessage())
                ->with('exception_details', $e->getTraceAsString());
        }
    }


    /**
 * Procesa la imagen y devuelve el nombre del archivo almacenado.
 *
 * @param Request $request
 * @param string $inputName
 * @return string
 */

 private function processPDF(Request $request, $inputName)
 {
     try {
         $file = $request->file($inputName);
         $fileName = time() . '_' . $inputName . '.' . $file->getClientOriginalExtension();
         $file->storeAs('pdfs', $fileName, 'public');
         return $fileName;
     } catch (\Exception $e) {
         throw new \Exception('Error processing PDF: ' . $e->getMessage());
     }
 }


private function processImage(Request $request, $inputName)
{
    try {
        $file = $request->file($inputName);
        $fileName = time() . '_' . $inputName . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images', $fileName, 'public');
        return $fileName;
    } catch (\Exception $e) {
        throw new \Exception('Error processing image: ' . $e->getMessage());
    }
}
    
    public function show($id)
    {

        $tarjetapiloto = Tarjetapiloto::find($id);

        return view('tarjetapiloto.show', compact('tarjetapiloto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarjetapiloto = Tarjetapiloto::find($id);

        return view('tarjetapiloto.edit', compact('tarjetapiloto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tarjetapiloto $tarjetapiloto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarjetapiloto $tarjetapiloto)
    {
        $request->validate([
            'nombre_piloto' => 'required',
            'dpi_piloto' => 'required',
            'tipo_licencia_piloto' => 'required',
            'fecha_emision_piloto' => 'required',
            'fecha_vencimiento_piloto' => 'required',
            // Agrega las nuevas validaciones para los campos adicionales
        ]);

        $tarjetapiloto->update($request->all());

        return redirect()->route('tarjetapiloto.index')
            ->with('success', 'Tarjetapiloto updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarjetapiloto = Tarjetapiloto::find($id)->delete();

        return redirect()->route('tarjetapilotos.index')
            ->with('success', 'Tarjetapiloto deleted successfully');
    }
}