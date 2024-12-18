<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PropioController;
use App\Http\Controllers\VehiController;
use App\Http\Controllers\ReportTarjetapilotoController;
use App\Http\Controllers\ReportCardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ReporteTarjetapiloto;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\ImageConversionController;
use App\Http\Controllers\BitacoraController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth', 'log.bitacora'])->group(function () {
    Route::get('cards/pdf/{id}', [CardController::class, 'generatePDF'])->name('cards.pdf');
    Route::get('/cards/solicitudes', [CardController::class, 'solicitudes'])->name('cards.solicitudes');
    Route::patch('/cards/{id}/solicitar', [CardController::class, 'solicitar'])->name('cards.solicitar');
    Route::get('report/reportvehitable', [VehiController::class, 'generateAllPDF'])->name('report.reportvehitable');
    Route::get('report/reportrutastable', [RutaController::class, 'generateAllRPDF'])->name('report.reportrutastable');
    Route::get('report/reportpropiotable', [PropioController::class, 'generateAllPDF'])->name('report.reportpropiotable');
    Route::delete('/propios/{propio}', [PropioController::class, 'destroy'])->name('propios.destroy');
    Route::resource('propio', PropioController::class);
    Route::get('/propios', [PropioController::class, 'index'])->name('propios.index');
    Route::patch('/propios/{propio}', [PropioController::class, 'update'])->name('propios.update');
    Route::resource('documentos', App\Http\Controllers\DocumentoController::class);
    Route::resource('rutas', RutaController::class);
    Route::resource('vehis', VehiController::class);
    Route::delete('/vehis/eliminar/{id}', [VehiController::class, 'eliminar'])->name('vehis.eliminar');
    Route::delete('/vehis/{vehis}', [PropioController::class, 'destroy'])->name('vehis.destroy');
    Route::resource('cards', CardController::class);
    Route::patch('/cards/{card}', [CardController::class, 'update'])->name('cards.update');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/generate-pdf/tarjetapiloto', [ReporteTarjetapiloto::class, 'generatePDF'])->name('generate-pdf-tarjetapiloto');
    Route::post('/convertir-imagen', [ImageConversionController::class, 'convertToPdf'])->name('convertir.imagen');
    Route::patch('/cards/{id}/update_status', [CardController::class, 'update_status'])->name('cards.update_status');
    Route::get('/pdfbita', [BitacoraController::class, 'generatePDF'])->name('bitacora.pdf');
    Route::get('/propios/cancel', function () {
        return redirect()->route('propios.index');
    })->name('ruta.cancelar');
});

Route::middleware(['auth', 'checkrole:superadmin'])->group(function () {
    Route::get('/bitacora/report', [BitacoraController::class, 'showReport'])->name('bitacora.report');
});

Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/bitacora', [BitacoraController::class, 'showReport'])->name('bitacora');
});

Route::middleware(['auth', 'checkrole:superadmin,admin,operador'])->group(function () {
    Route::get('/cards/solicitudes', [CardController::class, 'solicitudes'])->name('cards.solicitudes');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});