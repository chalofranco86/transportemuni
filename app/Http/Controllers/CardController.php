<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Vehi;
use App\Models\Propio;
use App\Models\ReportCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar la clase Auth
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

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

     public function __construct()
     {
         $this->middleware('auth');
     }

     public function index()
     {
         $user = Auth::user();
     
         // Loguear el id del usuario autenticado y su rol
         Log::info('Usuario autenticado ID: ' . $user->id . ' con rol: ' . $user->role);
     
         if ($user->role == 'superadmin') {
             $cards = Card::paginate();
         } elseif ($user->role == 'propietario') {
             // Encuentra el propietario correspondiente
             $propio = Propio::where('correo_propietario', $user->email)->first();
     
             if ($propio) {
                 // Obtén las tarjetas asociadas a este propietario
                 $cards = Card::where('propietario_id', $propio->id)->paginate();
             } else {
                 // Si no se encuentra el propietario, devuelve una colección vacía
                 $cards = collect();
             }
         } elseif ($user->role == 'piloto') {
             // Filtrar las tarjetas basándose en el correo del usuario autenticado
             $cards = Card::where('correo_piloto', $user->email)->paginate();
         } else {
             // Para otros roles, obtén todas las tarjetas
             $cards = Card::paginate();
         }
     
         // Loguear las tarjetas obtenidas
         Log::info('Tarjetas obtenidas: ' . $cards);
     
         return view('card.index', compact('cards'))->with('i', (request()->input('page', 1) - 1) * 20);
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
        $propio = Propio::pluck('nombre_propietario', 'id'); // Obtén la lista de propietarios
    
        return view('card.create', compact('card', 'vehi', 'propio')); // Pasa la lista de vehículos y propietarios a la vista
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
    
        // Verificar si el numero_vehiculo_id ya está en uso
        $vehiculoEnUso = Card::where('numero_vehiculo_id', $request->input('numero_vehiculo_id'))->exists();
        if ($vehiculoEnUso) {
            return redirect()->back()->withErrors(['numero_vehiculo_id' => 'Este número de vehículo ya está en uso.'])->withInput();
        }
    
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
    
        // Guardar la tarjeta en la base de datos
        $card->save();
    
        // Crear un nuevo usuario con la información del piloto
        $user = User::create([
            'name' => $request->input('nombre_piloto'), // Asegúrate de que este campo esté en tu formulario
            'email' => $request->input('correo_piloto'),
            'password' => Hash::make($request->input('correo_piloto')), // Generar una contraseña genérica
            'role' => 'piloto',
            'roles' => '3'
        ]);
    
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
        $card = Card::find($id);
        if (!$card) {
            return redirect()->route('cards.index')->with('error', 'Tarjeta no encontrada');
        }
    
        $vehi = Vehi::pluck('nombre_vehi', 'id');
        $propio = Propio::pluck('nombre_propietario', 'id');
    
        $card->licencia = Storage::url($card->licencia);
        $card->foto_piloto = Storage::url($card->foto_piloto);
        $card->dpi_piloto = Storage::url($card->dpi_piloto);
        $card->antecedentes_penales = Storage::url($card->antecedentes_penales);
        $card->antecedentes_policiacos = Storage::url($card->antecedentes_policiacos);
        $card->renas = Storage::url($card->renas);
        $card->boleto_ornato = Storage::url($card->boleto_ornato);
    
        return view('card.edit', compact('card', 'vehi', 'propio'));
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
        // Validar las reglas del modelo Card
        request()->validate(Card::$rules);

        // Actualizar los datos del card con los datos del formulario
        $card->update($request->all());
    
        // Manejar la carga de archivos si se están enviando nuevos archivos
        if ($request->hasFile('licencia')) {
            $licenciaPath = $request->file('licencia')->store('licencias', 'public');
            $card->licencia = $licenciaPath;
        }

        if ($request->hasFile('foto_piloto')) {
            $fotoPilotoPath = $request->file('foto_piloto')->store('foto_pilotos', 'public');
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
    
        // Actualizar los otros campos de la tarjeta
        $card->save();
    
        // Redireccionar a la vista de índice con un mensaje de éxito
        return redirect()->route('cards.index')
            ->with('success', 'Card updated successfully');
    }
    public function update_status(Request $request, $id)
    {
        $card = Card::find($id);
        $card->estado_card = $request->estado_card;
        $card->save();

        return redirect()->route('cards.index')->with('success', 'Estado de la tarjeta actualizado con éxito');
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
