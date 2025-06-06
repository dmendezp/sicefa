<?php

namespace Modules\PQRS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\PQRS\Entities\Pqrs;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AnswerController extends Controller
{
    public function index(){
        $titlePage = trans('pqrs::answer.pqrs_response');
        $titleView = trans('pqrs::answer.pqrs_response');

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
            'type_answer' => 'required',
            'response_date' => 'required',
        ];

        $messages = [
            'type_answer.required' => trans('pqrs::answer.you_must_select_a_response_type'),
            'response_date.required' => trans('pqrs::answer.you_must_register_a_date')
        ];

        $validatedData = $request->validate($rules, $messages);
        try {
            DB::beginTransaction();

            $pqrs = Pqrs::find($request->pqrs_id);
            $pqrs->state = $validatedData['type_answer'];
            $pqrs->answer = $request->input('answer');
            $pqrs->filed_response = $request->input('filed_response');
            $pqrs->response_date = $validatedData['response_date'];
            $pqrs->save();

            DB::commit();

            return redirect()->route('pqrs.official.answer.index')->with(['success' => trans('pqrs::answer.the_response_was_registered_successfully')]); 

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['error' => trans('pqrs::answer.error_registering_response')]);;
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
        try {
            $pqrs_save = Pqrs::find($request->id);

            $existing = $pqrs_save->people()->wherePivot('person_id', $request->responsible)
            ->exists();
            if (!$existing) {
                // Si no existe, entonces lo agregamos
                $pqrs_save->people()->attach($request->responsible, [
                    'date_time' => now()->format('Y-m-d H:i:s'),
                    'type' => $request->type
                ]);
            } else {
                // Ya existe este registro en la tabla pivote
                return back()->with('error', 'Este responsable ya está asociado con este PQRS.');
            }

            $pqrs = Pqrs::where('id', $request->id)->get();

            $person = Person::where('id', $request->responsible)->get();

            Mail::send('pqrs::emails.reasign', compact('pqrs'), function ($msg) use ($person) {
                $email = $person->first()->sena_email;
               
                // Eliminar espacios en blanco alrededor de la dirección de correo electrónico
                $clean_email = trim($email);

                // Validar la dirección de correo electrónico
                if (filter_var($clean_email, FILTER_VALIDATE_EMAIL)) {
                    $valid_email = $clean_email;
                } else {
                    throw new \Exception(trans('pqrs::tracking.the_email_address_is_not_valid'));
                }

                $msg->subject('Reasignación de la PQRS');
                $msg->to($valid_email);
                $msg->cc('dmcuellar@sena.edu.co');
            });

            // Redirige a una página de confirmación o de vuelta a la vista original
            return redirect()->back()->with('success', trans('pqrs::tracking.email_sent_successfully'));
        } catch (\Exception $e) {
            // Manejar la excepción y redirigir con un mensaje de error
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('pqrs.official.answer.index')->with(['success' => trans('pqrs::answer.the_pqrs_was_correctly_reassigned')]); 
    }
}
