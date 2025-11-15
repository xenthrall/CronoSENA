<?php

namespace App\Services;

use Spatie\Browsershot\Browsershot;


class BrowsershotService
{

    /*
    *
    */
    public function viewToPdf(string $html, string $namePdf)
    {

        // Asegurar encoding UTF-8
        $html = mb_convert_encoding($html, 'UTF-8', 'auto');

        // Generar PDF en memoria
        $pdfData = Browsershot::html($html)->pdf();

        // Retornar descarga al navegador
        return response($pdfData, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $namePdf . '"',
        ]);
    }
}
