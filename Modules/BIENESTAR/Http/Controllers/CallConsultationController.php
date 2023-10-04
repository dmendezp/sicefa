<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class TuControlador extends Controller
{
    public function procesarFormulario(Request $request)
    {
        // Validar que el campo 'numero_documento' esté presente en la solicitud
        $request->validate([
            'numero_documento' => 'required|numeric',
        ]);

        // Obtén el número de documento enviado desde el formulario
        $numeroDocumento = $request->input('numero_documento');

        // Realiza una consulta para obtener la información del aprendiz beneficiario de ambos apoyos
        $aprendiz = DB::table('aprendices')
            ->leftJoin('postulaciones as alimentacion', function ($join) {
                $join->on('aprendices.id', '=', 'alimentacion.aprendiz_id')
                    ->where('alimentacion.apoyo', 'alimentacion');
            })
            ->leftJoin('postulaciones as transporte', function ($join) {
                $join->on('aprendices.id', '=', 'transporte.aprendiz_id')
                    ->where('transporte.apoyo', 'transporte');
            })
            ->where('aprendices.numero_documento', $numeroDocumento)
            ->select(
                'aprendices.nombre as nombre_aprendiz',
                'aprendices.numero_documento',
                'alimentacion.porcentaje_descuento as porcentaje_descuento_alimentacion',
                'transporte.numero_ruta as numero_ruta_transporte',
                'transporte.nombre_ruta as nombre_ruta_transporte'
            )
            ->first();

        // Verifica si se encontró un aprendiz beneficiario de ambos apoyos
        if ($aprendiz) {
            // El número de documento existe y el aprendiz es beneficiario de ambos apoyos
            return view('bienestar::tablaBeneficiarios')->with('aprendiz', $aprendiz);
        } else {
            // No se encontró un aprendiz beneficiario de ambos apoyos
            // Realiza una consulta adicional para determinar el apoyo del cual es beneficiario
            $aprendiz = DB::table('aprendices')
                ->leftJoin('postulaciones as alimentacion', function ($join) {
                    $join->on('aprendices.id', '=', 'alimentacion.aprendiz_id')
                        ->where('alimentacion.apoyo', 'alimentacion');
                })
                ->leftJoin('postulaciones as transporte', function ($join) {
                    $join->on('aprendices.id', '=', 'transporte.aprendiz_id')
                        ->where('transporte.apoyo', 'transporte');
                })
                ->where('aprendices.numero_documento', $numeroDocumento)
                ->select(
                    'aprendices.nombre as nombre_aprendiz',
                    'aprendices.numero_documento',
                    'alimentacion.porcentaje_descuento as porcentaje_descuento_alimentacion',
                    'transporte.numero_ruta as numero_ruta_transporte',
                    'transporte.nombre_ruta as nombre_ruta_transporte'
                )
                ->first();

            if ($aprendiz) {
                // El número de documento existe y el aprendiz es beneficiario de uno de los apoyos
                return view('bienestar::tablaBeneficiarioUnico')->with('aprendiz', $aprendiz);
            } else {
                // No se encontró un aprendiz beneficiario de ningún apoyo
                return view('bienestar::error')->with('mensaje', 'No se encontró un aprendiz beneficiario de ningún apoyo.');
            }
        }
    }
}


class CallConsultationController extends Controller

{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('bienestar::callconsultation');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('bienestar::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('bienestar::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('bienestar::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
