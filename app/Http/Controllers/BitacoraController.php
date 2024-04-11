<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use Barryvdh\DomPDF\Facade\Pdf;

class BitacoraController extends Controller
{
    public function generatePDF()
    {
        $bitacora = Bitacora::all();

        $pdf = PDF::loadView('bitacora.pdfbita', compact('bitacora'));
        return $pdf->download('pdfbitacora.pdf');

    }

    public function showReport()
    {
        $bitacora = Bitacora::all();
        return view('bitacora.report', compact('bitacora'));
    }
}