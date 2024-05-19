<?php

namespace Modules\PQRS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Person;
use Modules\PQRS\Entities\Pqrs;
use Modules\SICA\Entities\Holiday;

class TrackingController extends Controller
{
    public function index(){
        $titlePage = 'Seguimiento PQRS';
        $titleView = 'Seguimiento PQRS';

        $pqrs = Pqrs::with('people')->get();

        $data  = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'pqrs' => $pqrs
        ];

        return view('pqrs::tracking.index', $data);
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

    public function store(Request $request){
        $rules = [
            'filing_number' => 'required',
            'nis' => 'required',
            'filing_date' => 'required',
            'type_pqrs' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'issue' => 'required',
        ];

        $messages =[
            'filing_number.required' => 'Debe registrar el numero de radicación.',
            'nis.required' => 'Debe registrar el NIS.',
            'filing_date.required' => 'Debe registrar la fecha de radicación.',
            'type_pqrs.required' => 'Debe seleccionar un asunto.',
            'start_date.required' => 'Debe registrar la fecha de llegada de la PQRS.',
            'end_date.required' => 'Debe registrar la fecha limite de respuesta.',
            'issue.required' => 'Debe registrar una descripción de la PQRS.'
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            DB::beginTransaction();

            $pqrs = new Pqrs;
            $pqrs->type_pqrs_id = $validatedData['type_pqrs'];
            $pqrs->filing_number = $validatedData['filing_number'];
            $pqrs->filing_date = $validatedData['filing_date'];
            $pqrs->nis = $validatedData['nis'];
            $pqrs->start_date = $validatedData['start_date'];
            $pqrs->end_date = $validatedData['end_date'];
            $pqrs->issue = $validatedData['issue'];
            $pqrs->save();

            DB::commit();

            return redirect()->route('pqrs.tracking.index'); 

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($validatedData);
        }
    }

    public function assign (Request $request, $id){
        $pqrs = Pqrs::find($id);
        $pqrs->people()->attach($request->responsible, [
            'consecutive' => 1,
            'date' => now()->format('Y-m-d')
        ]);

        return redirect()->route('pqrs.tracking.index'); 
    }
}
