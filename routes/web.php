<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PropioController;
use App\Http\Controllers\VehiController;
use App\Http\Controllers\ReportTarjetapilotoController;
use App\Http\Controllers\ReportCardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ReporteTarjetapiloto;


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
/* Route::get('cards/pdf/', [CardController::class, 'pdf'])->name('cards.pdf'); */
Route::get('cards/pdf/{id}', [CardController::class, 'generatePDF'])->name('cards.pdf');
Route::delete('/propios/{propio}', 'PropioController@destroy')->name('propios.destroy');
Route::resource('propio', App\Http\Controllers\PropioController::class)->middleware('auth');
Route::resource('documentos', App\Http\Controllers\DocumentoController::class);
Route::resource('rutas', App\Http\Controllers\RutaController::class);
Route::resource('vehis', VehiController::class);
Route::resource('cards', App\Http\Controllers\CardController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/generate-pdf/tarjetapiloto', [ReporteTarjetapiloto::class, 'generatePDF'])->name('generate-pdf-tarjetapiloto');
