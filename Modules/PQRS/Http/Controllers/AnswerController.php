<?php

namespace Modules\PQRS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\PQRS\Entities\Pqrs;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\DB;
class AnswerController extends Controller
{
    public function index(){
        $titlePage = 'Respuesta de PQRS';
        $titleView = 'Respuesta de PQRS';

        $user = Auth::user()->person_id;
        $person = Person::find($user);

        $pqrs = Pqrs::with(['people' => function($query) {
            $query->orderBy('date_time', 'desc');
        }])->get();

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'pqrs' => $pqrs
        ];
        
        return view('pqrs::answer.index', $data);
    }

    public function store(Request $request){
        $rules = [
            'answer' => 'required',
            'type_answer' => 'required',
            'filed_response' => 'required',
            'response_date' => 'required',
        ];

        $messages = [
            'answer.required' => 'Debe registrar una respuesta',
            'type_answer.required' => 'Debe seleccionar un tipo de respuesta',
            'filed_response.required' => 'Debe registrar el numero de radicado',
            'response_date' => 'Debe registrar una fecha'
        ];

        $validatedData = $request->validate($rules, $messages);
        try {
            DB::beginTransaction();

            $pqrs = Pqrs::find($request->pqrs_id);
            $pqrs->state = $validatedData['type_answer'];
            $pqrs->answer = $validatedData['answer'];
            $pqrs->filed_response = $validatedData['filed_response'];
            $pqrs->response_date = $validatedData['response_date'];
            $pqrs->save();

            DB::commit();

            return redirect()->route('pqrs.official.answer.index')->with(['success' => 'Se registro la respuesta exitosamente']); 

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['error' => 'Error al registrar la respuesta']);;
        }
    }

    public function searchOfficial(Request $request){
        $term = $request->input('name');

        $people = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])->get();
        $results = [];
        foreach ($people as $person) {
            $results[] = [
                'id' => $person->id,
                'name' => $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name,
            ];
        }

        return response()->json($results);
    }

    public function reasign(Request $request){
        $pqrs = Pqrs::find($request->id);
                        
        $pqrs->people()->attach($request->responsible, [
            'date_time' => now()->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('pqrs.official.answer.index')->with(['success' => 'Se reasigno correctamente la PQRS']); 
    }
}
