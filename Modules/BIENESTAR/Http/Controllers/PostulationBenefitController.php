<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Postulation;
use Modules\BIENESTAR\Entities\Convocation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\BIENESTAR\Entities\Question;
use Modules\BIENESTAR\Entities\Benefit;
use Modules\BIENESTAR\Entities\PostulationBenefit;
use Modules\BIENESTAR\Entities\Answer;
use Illuminate\Http\JsonResponse;
use Modules\SICA\Entities\Quarter;


class PostulationBenefitController extends Controller
{
    // Modifica tu función index en el controlador
    public function index(Request $request)
    {
        // Obtener el trimestre actual
        $currentQuarter = Quarter::whereDate('start_date', '<=', now())
                                ->whereDate('end_date', '>=', now())
                                ->first();
    
        // Inicializar una colección vacía de convocatorias
        $convocations = collect();
    
        if ($currentQuarter) {
            // Si se encuentra un trimestre actual, obtener las convocatorias dentro del trimestre actual
            $convocations = Convocation::where('quarter_id', $currentQuarter->id)
                                        ->get();
        }
    
        // Obtener las postulaciones asociadas con estas convocatorias
        $postulation = Postulation::select(
            'people.first_name',
            'people.first_last_name',
            'people.second_last_name',
            'postulations.transportation_benefit',
            'postulations.feed_benefit',
            'postulations.id',
            'postulations.total_score'
        )
            ->join('convocations', 'postulations.convocation_id', '=', 'convocations.id')
            ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->whereIn('convocations.id', $convocations->pluck('id'))
            ->orderBy('postulations.created_at', 'desc')
            ->get();
    
        // Obtener los beneficios y las respuestas
        $benefits = Benefit::all();
        $answers = Answer::with('question')->get();
        $postulationsbentfits = PostulationBenefit::all();
    
        // Retornar la vista con todos los datos
        return view('bienestar::postulation-management', compact('postulation', 'benefits', 'convocations', 'answers', 'postulationsbentfits'));
    }
    

    public function get_benefit($postulationId)
    {
        $beneficios = DB::table('postulations_benefits')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->select('benefits.name', 'benefits.porcentege')
            ->where('postulations_benefits.postulation_id', $postulationId)
            ->get();

        return response()->json($beneficios);
    }

    public function show($id)
    {
        $postulation = Postulation::with('convocation', 'apprentice', 'typeOfBenefit', 'answers', 'postulationBenefits', 'socioEconomicSupportFiles')->findOrFail($id);
        return view('bienestar::postulation-management.show', compact('postulation'));
    }

    public function updateStateBenefit(Request $request)
    {
        // Obtén los datos del formulario
        $postulationId = $request->input('postulation_id');
        $postulationBenefitUpdateTrans = $request->input('benefit_id_transport');
        $postulationBenefitUpdateAlim = $request->input('benefit_id_food');
        $postulationsbentfitsId = $request->input('postulationsbentfits_id');
        $benefitIdTransport = $request->input('postulationbenefitstransportID');
        $benefitIdFood = $request->input('postulationbenefitsalimentacionID');
        $score = $request->input('score');
        $messageT = $request->input('messageT');
        $messageA = $request->input('messageA');
        $message = $request->input('message');

        // Actualiza o crea en la tabla postulations_benefits para el beneficio de transporte
        if (!empty($benefitIdTransport)|| is_null($benefitIdTransport)) {
            $postulationBenefitTransport = PostulationBenefit::find($benefitIdTransport);

            if ($postulationBenefitTransport) {
                // Si encontró el registro, verifica el estado actual
                if ($postulationBenefitTransport->state === 'Beneficiario') {
                    // Si el estado actual es 'Beneficiario', actualiza los datos con el nuevo estado y mensaje
                    $postulationBenefitTransport->benefit_id = $postulationBenefitUpdateTrans;
                    $postulationBenefitTransport->state = 'Beneficiario';
                    $postulationBenefitTransport->message = $messageT;
                    $postulationBenefitTransport->save();
                }if (!empty($postulationBenefitUpdateTrans)){
                    $postulationBenefitTransport->benefit_id = $postulationBenefitUpdateTrans;
                    $postulationBenefitTransport->state = 'Beneficiario';
                    $postulationBenefitTransport->message = $messageT;
                    $postulationBenefitTransport->save();
                } 
                else {
                    $postulationBenefitTransport->message = $messageT;
                    $postulationBenefitTransport->save();                    
                }                
            }elseif (is_null($postulationBenefitUpdateTrans)) {
                // Si no se seleccionó un beneficio de transporte, crea un nuevo registro con state 'No Beneficiario'
                $postulation = Postulation::find($postulationId);
            
                // Añade una condición para transportation_benefit
                if ($postulation && $postulation->transportation_benefit == 1) {
                    // Encuentra el beneficio de Transporte con el menor porcentaje
                    $benefitTransporte = Benefit::where('name', 'Transporte')->orderBy('porcentege', 'desc')->first();
            
                    // Verifica si encontró el beneficio antes de crear el registro
                    if ($benefitTransporte) {
                        // Crea un nuevo registro con el beneficio encontrado y state 'No Beneficiario'
                        $postulationBenefitTransport = new PostulationBenefit();
                        $postulationBenefitTransport->benefit_id = $benefitTransporte->id;
                        $postulationBenefitTransport->postulation_id = $postulationId;
                        $postulationBenefitTransport->state = 'No Beneficiario';
                        $postulationBenefitTransport->message = $message;
                        $postulationBenefitTransport->save();
                    }
                }
            } else {
                // Si no encontró el registro, crea uno nuevo
                $postulationBenefitTransport = new PostulationBenefit();
                $postulationBenefitTransport->postulation_id = $postulationId;
                $postulationBenefitTransport->benefit_id = $postulationBenefitUpdateTrans;
                $postulationBenefitTransport->state = 'Beneficiario';
                $postulationBenefitTransport->message = $message;
                $postulationBenefitTransport->save();
            }
        }

        // Repite el proceso para el beneficio de alimentación
        if (!empty($benefitIdFood)|| is_null($benefitIdFood)) {
            $postulationBenefitFood = PostulationBenefit::find($benefitIdFood);

            if ($postulationBenefitFood) {
                // Si encontró el registro, verifica el estado actual
                if ($postulationBenefitFood->state === 'Beneficiario') {
                    // Si el estado actual es 'Beneficiario', actualiza los datos con el nuevo estado y mensaje
                    $postulationBenefitFood->benefit_id = $postulationBenefitUpdateAlim;
                    $postulationBenefitFood->state = 'Beneficiario';
                    $postulationBenefitFood->message = $messageA;
                    $postulationBenefitFood->save();
                }if (!empty($postulationBenefitUpdateAlim)){
                    $postulationBenefitFood->benefit_id = $postulationBenefitUpdateAlim;
                    $postulationBenefitFood->state = 'Beneficiario';
                    $postulationBenefitFood->message = $messageA;
                    $postulationBenefitFood->save();
                } 
                else {
                    $postulationBenefitFood->message = $messageA;
                    $postulationBenefitFood->save();                    
                }                
            }elseif (is_null($postulationBenefitUpdateAlim)) {
                // Si no se seleccionó un beneficio de alimentación, crea un nuevo registro con state 'No Beneficiario'
                $postulation = Postulation::find($postulationId);
            
                // Añade una condición para feed_benefit
                if ($postulation && $postulation->feed_benefit == 1) {
                    // Encuentra el beneficio de Alimentacion con el menor porcentaje
                    $benefitAlimentacion = Benefit::where('name', 'Alimentacion')->orderBy('porcentege', 'desc')->first();
            
                    // Verifica si encontró el beneficio antes de crear el registro
                    if ($benefitAlimentacion) {
                        // Crea un nuevo registro con el beneficio encontrado y state 'No Beneficiario'
                        $postulationBenefitFood = new PostulationBenefit();
                        $postulationBenefitFood->benefit_id = $benefitAlimentacion->id;
                        $postulationBenefitFood->postulation_id = $postulationId;
                        $postulationBenefitFood->state = 'No Beneficiario';
                        $postulationBenefitFood->message = $message;
                        $postulationBenefitFood->save();
                    }
                }
            } else {
                // Si no encontró el registro, crea uno nuevo
                $postulationBenefitFood = new PostulationBenefit();
                $postulationBenefitFood->postulation_id = $postulationId;
                $postulationBenefitFood->benefit_id = $postulationBenefitUpdateAlim;
                $postulationBenefitFood->state = 'Beneficiario';
                $postulationBenefitFood->message = $message;
                $postulationBenefitFood->save();
            }
        }

        // Actualiza el score en la tabla postulations
        Postulation::where('id', $postulationId)->update(['total_score' => $score]);

        return response()->json(['success' => 'Se ha asignado el beneficio con éxito']);
    }

    public function remove_benefit(Request $request, $id)
    {
        $postulation_benefit = PostulationBenefit::find($id);
        $postulation_benefit->state = 'No Beneficiario';
        $postulation_benefit->save();

        return redirect()->route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.view.postulation-management');
    }
}