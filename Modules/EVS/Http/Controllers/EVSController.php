<?php

namespace Modules\EVS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Person;
use Modules\EVS\Entities\Authorized;
use Modules\EVS\Entities\Election;
use Modules\EVS\Entities\Elected;
use Modules\EVS\Entities\Vote;

use Validator, Str;

class EVSController extends Controller
{
    


public function index()
{
    $now = Carbon::now(); // Fecha actual con timezone de la app

    $dataelecciones = Election::with([
        'candidates.person.apprentices.course.program',
        'candidates.votes'
    ])
    ->where('end_date', '<', $now->toDateTimeString()) // formato Y-m-d H:i:s
    ->withCount([
        'votes as votes_count' => function ($query) {
            $query->whereNull('candidate_id'); // votos en blanco
        }
    ])
    ->orderBy('id', 'desc')
    ->get()
    ->map(function ($election) {
        $winner = $election->candidates->sortByDesc(function ($c) {
            return $c->votes->count();
        })->first();

        $election->winner = $winner;
        return $election;
    });

    // return [$now->toDateTimeString(), $dataelecciones];
    return view('evs::voto.index', ['dataelecciones' => $dataelecciones]);
}




    public function getVotar(){
        return view('evs::voto.votar');
    }
public function postValidar(Request $request)
{
    $rules = [
        'document' => 'required|numeric',
        'securityCode' => 'required'
    ];

    $messages = [
        'document.required' => 'El campo Documento es requerido.',
        'document.numeric' => 'El campo Documento debe ser un numero.',
        'securityCode.required' => 'El campo Codigo de seguridad es requerido.'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return back()->withErrors($validator)
            ->with('message', 'Se ha producido un error')
            ->with('typealert', 'danger');
    }

    $people = Person::where('document_number', $request->input('document'))
        ->whereHas('authorizeds.election', function ($query) {
            $query->where('status', 'Activo');
        })
        ->with(['authorizeds' => function ($q) {
            $q->latest('id'); // 🔹 traer autorizaciones ordenadas de la más nueva a la más vieja
        }])
        ->get();

    if (count($people) == 0) {
        return redirect(route('cefa.evs.voto.votar'))
            ->with('message', 'El numero de documento no se encuentra o no esta habilitado para votar')
            ->with('typealert', 'warning');
    }

    // 🔹 Siempre tomar la última autorización
    $lastAuth = $people[0]->authorizeds->first();

    $fini = Carbon::parse($lastAuth->election->start_date);
    $ffin = Carbon::parse($lastAuth->election->end_date);
    $factual = Carbon::now('America/Bogota');

    if ($factual->lt($fini)) {
        return redirect(route('cefa.evs.voto.votar'))
            ->with('message', 'Las fechas y horas de votación son del ' . $fini->format('d/m/Y h:ia') . ' al ' . $ffin->format('d/m/Y h:ia'))
            ->with('typealert', 'warning');
    }

    if ($lastAuth->status == 'Inactivo') {
        return redirect(route('cefa.evs.voto.votar'))
            ->with('message', 'Ya registro su voto en el sistema')
            ->with('typealert', 'danger');
    }

    if ($request->input('securityCode') != $lastAuth->code) {
        return redirect(route('cefa.evs.voto.votar'))
            ->with('message', 'El codigo de seguridad no coincide, intente de nuevo')
            ->with('typealert', 'warning');
    }

    $dataelecciones = Election::where('status', 'Activo')
        ->with('candidates.person.apprentices.course.program')
        ->orderBy('id', 'Desc')
        ->get();

    return view('evs::voto.tarjeton', [
        'people' => $people,
        'dataelecciones' => $dataelecciones
    ]);
}


public function postRegistrar(Request $request)
{
    $a = Authorized::findOrFail($request->input('authorized_id'));

    if ($a->status == 'Activo') {
        $v = new Vote;

        // Si el valor es 0 (voto en blanco), guarda NULL
        $v->candidate_id = $request->candidate_id > 0 ? $request->candidate_id : null;
        $v->election_id  = $request->election_id;

        if ($v->save()) {
            $a->status = "Inactivo";
            if ($a->save()) {
                return redirect(route('cefa.evs.voto.votar'))
                    ->with('message', 'Su voto se ha registrado con éxito')
                    ->with('typealert', 'success');
            }
        }
    } else {
        return redirect(route('cefa.evs.voto.votar'))
            ->with('message', 'Ya registró su voto en el sistema')
            ->with('typealert', 'danger');
    }
}

    


public function getResultados()
{
    $now = Carbon::now();

    $dataelecciones = Election::with([
        'candidates.person.apprentices.course.program',
        'electeds.candidate.person',
        'candidates.votes'
    ])
    ->withCount([
        'votes as votes_count' => function ($query) {
            $query->whereNull('candidate_id'); // votos en blanco
        }
    ])
    ->orderBy('id', 'desc')
    ->get()
    ->map(function ($election) use ($now) {
        // Si la elección NO ha terminado, forzar todos los votos a cero
        if ($election->end_date > $now) {
            $election->votes_count = 0;

            foreach ($election->candidates as $candidate) {
                $candidate->votes_count = 0; // opcional, si quieres mostrarlo en la vista
                $candidate->votes = collect(); // vacía los votos
            }
        }

        // Puedes calcular ganador solo si quieres mostrarlo (opcional)
        $winner = $election->candidates->sortByDesc(function ($c) {
            return $c->votes->count();
        })->first();
        $election->winner = $winner;

        return $election;
    });

    return view('evs::voto.resultados', ['dataelecciones' => $dataelecciones]);
}

    public function normatividad(){
        return view('evs::voto.normatividad');
    }

    public function desarrolladores(){
        return view('evs::voto.desarrolladores');
    }


 
}
