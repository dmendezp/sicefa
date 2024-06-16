<?php

namespace Modules\PQRS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class PQRSController extends Controller
{
    public function index(){
        $titlePage = 'Inicio';
        $titleView = 'Inicio';

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView
        ];

        return view('pqrs::index', $data);
    }

    public function manual()
    {
        // Ruta al archivo PDF
        $rutaPdf = public_path('modules\pqrs\MANUAL DE USUARIO - PQRS.pdf');

        // Nombre que tendrá el archivo descargado
        $nombreArchivo = 'MANUAL DE USUARIO - PQRS.pdf';

        // Headers para indicar que es un archivo PDF
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        // Descarga el archivo
        return Response::download($rutaPdf, $nombreArchivo, $headers);
    }
}
