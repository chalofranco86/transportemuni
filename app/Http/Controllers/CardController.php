<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Vehi;
use App\Models\ReportCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class CardController
 * @package App\Http\Controllers
 */
class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
         $card = Card::paginate();
 
         return view('card.index', compact('card'))
             ->with('i', (request()->input('page', 1) - 1) * $card->perPage());
     }

     public function generatePDF($id)
     {
        set_time_limit(300); // Set to 5 minutes 
        $card = Card::find($id);
     
         if (!$card) {
             // Redirect back or to a specific error page
             return redirect()->route('cards.index')->with('error', 'Tarjeta no encontrada');
         }
     
         try {
             $pdf = PDF::loadView('report.reportcard', compact('card'));
             return $pdf->download('reporte.pdf');
         } catch (\Exception $e) {
             // You can log the exception for further investigation
             \Log::error($e);
     
             // Redirect back or to a specific error page
             return redirect()->route('cards.index')->with('error', 'Error al generar el PDF');
         }
     }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $card = new Card();
        $vehi = Vehi::pluck('nombre_vehi', 'id'); // Obtén la lista de vehículos

        return view('card.create', compact('card', 'vehi')); // Pasa la lista de vehículos a la vista
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar las reglas del modelo Card
        request()->validate(Card::$rules);
    
        // Inicializar una instancia de Card con los datos del formulario
        $card = new Card($request->all());
    
        // Manejar la carga de archivos y almacenar las rutas en la base de datos
        if ($request->hasFile('licencia')) {
            $licenciaPath = $request->file('licencia')->store('licencias', 'public');
            $card->licencia = $licenciaPath;
        }
    
        if ($request->hasFile('foto_piloto')) {
            $fotoPilotoPath = $request->file('foto_piloto')->store('fotos_piloto', 'public');
            $card->foto_piloto = $fotoPilotoPath;
        }
    
        if ($request->hasFile('dpi_piloto')) {
            $dpiPilotoPath = $request->file('dpi_piloto')->store('dpi_pilotos', 'public');
            $card->dpi_piloto = $dpiPilotoPath;
        }

        if ($request->hasFile('antecedentes_penales')) {
            $antecedentes_penalesPath = $request->file('antecedentes_penales')->store('antecedentes_penales', 'public');
            $card->antecedentes_penales = $antecedentes_penalesPath;
        }

        if ($request->hasFile('antecedentes_policiacos')) {
            $antecedentes_policiacosPath = $request->file('antecedentes_policiacos')->store('antecedentes_policiacos', 'public');
            $card->antecedentes_policiacos = $antecedentes_policiacosPath;
        }

        if ($request->hasFile('renas')) {
            $renasPath = $request->file('renas')->store('renas', 'public');
            $card->renas = $renasPath;
        }

        if ($request->hasFile('boleto_ornato')) {
            $boleto_ornatoPath = $request->file('boleto_ornato')->store('boleto_ornato', 'public');
            $card->boleto_ornato = $boleto_ornatoPath;
        }
    
        // Repite el proceso para los demás archivos
    
        // Guardar la tarjeta en la base de datos
        $card->save();
    
        // Redireccionar a la vista de índice con un mensaje de éxito
        return redirect()->route('cards.index')->with('success', 'Card created successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = Card::find($id);

        return view('card.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Encuentra la tarjeta por su ID
        $card = Card::find($id);
    
        // Encuentra el vehículo asociado con la tarjeta
        $vehi = Vehi::pluck('nombre_vehi', 'id'); // Obtén la lista de vehículos
    
        // Verifica si se están enviando nuevos archivos y actualiza las rutas
        if (request()->hasFile('tarjeta_circulacion')) {
            $tarjetaCirculacionPath = request()->file('tarjeta_circulacion')->store('tarjetas_circulacion', 'public');
            $vehi->update(['tarjeta_circulacion' => $tarjetaCirculacionPath]);
        }
    
        // Repite el mismo proceso para otros archivos
    
        // Devuelve la vista de edición con el vehículo y la lista de vehículos
        return view('card.edit', compact('card', 'vehi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Card $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        request()->validate(Card::$rules);

        $card->update($request->all());

        return redirect()->route('cards.index')
            ->with('success', 'Card updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $card = Card::find($id)->delete();

        return redirect()->route('cards.index')
            ->with('success', 'Card deleted successfully');
    }
}
