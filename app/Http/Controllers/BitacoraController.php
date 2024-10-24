<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class BitacoraController extends Controller
{
    public function generatePDF()
    {
        if (Auth::user()->cannot('view', Bitacora::class)) {
            return redirect()->back()->with('error', 'ACCESO NO PERMITIDO A BITACORA');
        }

        $bitacora = Bitacora::all();

        $pdf = PDF::loadView('bitacora.pdfbita', compact('bitacora'));
        return $pdf->download('pdfbitacora.pdf');
    }

    public function showReport()
    {
        if (Auth::user()->cannot('view', Bitacora::class)) {
            return redirect()->back()->with('error', 'ACCESO NO PERMITIDO A BITACORA');
        }
    
        $bitacora = Bitacora::with('user')->get();
        return view('bitacora.report', compact('bitacora'));
    }
}
