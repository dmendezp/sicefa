<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

class PostulationBenefitController extends Controller
{
    // Modifica tu función index en el controlador
    public function index(Request $request)
    {
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
            ->whereRaw('CURDATE() BETWEEN convocations.start_date AND convocations.end_date')
            ->orderBy('postulations.created_at', 'desc')
            ->get();

        $benefits = Benefit::all();
        $curdate = now();
        $convocations = Convocation::where('start_date', '<=', $curdate)
            ->where('end_date', '>=', $curdate)
            ->get();

        $answers = Answer::with('question')->get();

        $postulationsbentfits = PostulationBenefit::all();

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
        $benefitIdTransport = $request->input('benefit_id_transport');
        $benefitIdFood = $request->input('benefit_id_food');
        $score = $request->input('score');
        $message = $request->input('message');

        // Actualiza o crea en la tabla postulations_benefits para el beneficio de transporte
        if (!empty($benefitIdTransport)) {
            try {
                $postulationBenefitTransport = PostulationBenefit::where('postulation_id', $postulationId)
                    ->where('benefit_id', $benefitIdTransport)
                    ->firstOrFail();

                // Si encontró el registro, actualiza los datos
                $postulationBenefitTransport->state = 'Beneficiario';
                $postulationBenefitTransport->message = $message;
                $postulationBenefitTransport->save();
            } catch (ModelNotFoundException $e) {
                // Si no encontró el registro, crea uno nuevo
                $postulationBenefitTransport = new PostulationBenefit();
                $postulationBenefitTransport->postulation_id = $postulationId;
                $postulationBenefitTransport->benefit_id = $benefitIdTransport;
                $postulationBenefitTransport->state = 'Beneficiario';
                $postulationBenefitTransport->message = $message;
                $postulationBenefitTransport->save();
            }
        }

        // Repite el proceso para el beneficio de alimentación
        if (!empty($benefitIdFood)) {
            try {
                $postulationBenefitFood = PostulationBenefit::where('postulation_id', $postulationId)
                    ->where('benefit_id', $benefitIdFood)
                    ->firstOrFail();

                // Si encontró el registro, actualiza los datos
                $postulationBenefitFood->state = 'Beneficiario';
                $postulationBenefitFood->message = $message;
                $postulationBenefitFood->save();
            } catch (ModelNotFoundException $e) {
                // Si no encontró el registro, crea uno nuevo
                $postulationBenefitFood = new PostulationBenefit();
                $postulationBenefitFood->postulation_id = $postulationId;
                $postulationBenefitFood->benefit_id = $benefitIdFood;
                $postulationBenefitFood->state = 'Beneficiario';
                $postulationBenefitFood->message = $message;
                $postulationBenefitFood->save();
            }
        }

        // Actualiza el score en la tabla postulations
        Postulation::where('id', $postulationId)->update(['total_score' => $score]);

        return response()->json(['success' => 'Se ha asignado el leneficio con éxito']);
    }
}
