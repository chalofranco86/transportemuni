<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Dompdf\Dompdf;
use Dompdf\Options;

class ImageConversionController extends Controller
{
    /**
     * Muestra el formulario para cargar la imagen.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('report.convert');
    }

    /**
     * Procesa la imagen cargada y la convierte en un archivo PDF.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function convertToPdf(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Tamaño máximo de 2MB
        ]);

        // Obtener la imagen del formulario
        $image = $request->file('image');

        // Crear una instancia de Dompdf
        $dompdf = new Dompdf();

        // Opciones para el renderizado del PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Procesar la imagen y convertirla en PDF
        $pdfContent = $this->processImageToPdf($image);

        // Cargar el contenido PDF al Dompdf
        $dompdf->loadHtml($pdfContent);

        // Renderizar el PDF
        $dompdf->render();

        // Descargar el PDF generado
        return $dompdf->stream('converted_image.pdf');
    }

    /**
     * Procesa la imagen y la convierte en un contenido PDF.
     *
     * @param  \Illuminate\Http\UploadedFile $image
     * @return string
     */
    private function processImageToPdf($image)
    {
        // Procesar la imagen con Intervention Image
        $img = Image::make($image->path());

        // Convertir la imagen a PDF
        $pdfContent = $img->encode('pdf');

        return $pdfContent;
    }
}
