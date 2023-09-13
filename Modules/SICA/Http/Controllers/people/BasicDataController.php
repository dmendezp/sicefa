<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;
use Modules\SICA\Entities\Event;
use Modules\SICA\Entities\EventAttendance;
use Modules\SICA\Entities\PensionEntity;
use Validator, DB;

class BasicDataController extends Controller
{

    /* Buscar o registrar datos básicos de persona para registrar asistencia a evento */
    public function search(Request $request){
        $title = trans('sica::menu.Personal data Add');
        $events = Event::where('state','available')->pluck('name','id');
        $eps = Eps::orderBy('name','asc')->get();
        $population_groups = PopulationGroup::orderBy('name','desc')->get();
        $pension_entities = PensionEntity::orderBy('name','asc')->get();
        $title = trans('sica::menu.Personal data Add');
        $document_type = Person::pluck('document_type');
        $rules = [
            'document' => 'required',
            'event_id' => 'required'
        ];
        $messages = [
            'document.required' => 'El campo consulta es requerido.',
            'event_id.required' => 'El campo de evento es requerido'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return view('sica::admin.people.attendance.index')->withErrors($validator)->with('message_result', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        }else{
            $doc =$request->input('document');
            $event = $request->input('event_id');
            $person = Person::where('document_number',$doc)->with('users')->first();
            switch ($person) {
                case '':
                    return view('sica::admin.people.attendance.create')->with([
                        'title'=>$title,
                        'document_type'=>$document_type,
                        'doc' =>$doc,
                        'eps'=>$eps,
                        'population_groups'=>$population_groups,
                        'pension_entities'=>$pension_entities,
                        'event' =>$event
                    ]);
                    break;
                default:
                    //$people->events()->syncWithoutDetaching($request->input('event_id'));
                    //return date('Y-m-d');
                    $att = EventAttendance::where(DB::raw("(DATE_FORMAT(date,'%Y-%m-%d'))"),date('Y-m-d'))->where('event_id',$event)->where('person_id',$person->id)->get();
                    if(count($att)>0){
                        return redirect(route('sica.'.getRoleRouteName(Route::currentRouteName()).'.people.events_attendance.index'))->with('message_result', ucfirst($person->full_name).' ya se encuentra registrado en la asistencia')->with('typealert', 'info')->with(['title'=>$title,'events'=>$events]);
                        break;
                    }
                    $ea = EventAttendance::create(['event_id' => $event,'person_id' => $person->id,'date' => date('Y-m-d')]);
                    return redirect(route('sica.'.getRoleRouteName(Route::currentRouteName()).'.people.events_attendance.index'))->with('message_result', 'Asistencia registrada exitosamente para: '.ucfirst($person->full_name))->with('typealert', 'success')->with(['title'=>$title,'events'=>$events]);
                    break;
            }
        }
    }

    /* Registrar datos básicos de personas y asistencia a evento */
    public function store(Request $request){
        $title = trans('sica::menu.Personal data Add');
        $events = Event::pluck('name','id');
        $rules = [
            'document_number' => 'required',
            'document_type' => 'required',
            'first_name' => 'required',
            'first_last_name' => 'required',
            'eps_id' => 'required',
            'population_group_id' => 'required',
            'pension_entity_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        else:
            $p = new Person;
            $p->document_type = e($request->input('document_type'));
            $p->document_number = e($request->input('document_number'));
            $p->first_name = strtoupper(e($request->input('first_name')));
            $p->first_last_name = strtoupper(e($request->input('first_last_name')));
            $p->second_last_name = strtoupper(e($request->input('second_last_name')));
            $p->eps_id = e($request->input('eps_id'));
            $p->population_group_id = e($request->input('population_group_id'));
            $p->pension_entity_id = e($request->input('pension_entity_id'));
            if($p->save()){
                //$p->events()->syncWithoutDetaching($request->input('event_id'));
                $ea = EventAttendance::create(['event_id' => $request->input('event_id'),'person_id' => $p->id,'date' => date('Y-m-d')]);
                return redirect(route('sica.'.getRoleRouteName(Route::currentRouteName()).'.people.events_attendance.index'))->with('message_result', 'Persona y asistencia registrada exitosamente')->with('typealert', 'success')->with(['title'=>$title,'events'=>$events]);
            }
        endif;
    }

}

