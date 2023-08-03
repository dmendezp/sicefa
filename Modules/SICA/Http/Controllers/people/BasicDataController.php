<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;
use Modules\SICA\Entities\Event;
use Modules\SICA\Entities\EventAttendance;



use Validator, Str, DB;

class BasicDataController extends Controller
{

    public function search_basic_data(Request $request)
    {
        $title = trans('sica::menu.Personal data Add');
        $events = Event::where('state','available')->pluck('name','id');
        $eps = Eps::get();
        $population_groups = PopulationGroup::orderBy('id','desc')->get();
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
            return view('sica::admin.people.attendance.home')->withErrors($validator)->with('message_result', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        }else{
        $doc =$request->input('document');
        $event = $request->input('event_id');
        $people = Person::where('document_number',$doc)->with('users')->first();
        
        
        switch ($people) {
            case '':
                return view('sica::admin.people.attendance.add')->with(
                    [
                     'title'=>$title, 
                     'document_type'=>$document_type, 
                     'doc' =>$doc,
                     'eps'=>$eps,
                     'population_groups'=>$population_groups,
                     'event' =>$event
                     ]);
                break;
            
            default:
            //$people->events()->syncWithoutDetaching($request->input('event_id'));
            //return date('Y-m-d');
            $att = EventAttendance::where(DB::raw("(DATE_FORMAT(date,'%Y-%m-%d'))"),date('Y-m-d'))->where('event_id',$event)->where('person_id',$people->id)->get();
            if(count($att)>0){
                return redirect(route('sica.attendance.people.events_attendance'))->with('message_result', 'Usuario ya registrado')->with('typealert', 'info')->with(['title'=>$title,'events'=>$events]);
                    break;
            }
            $ea = EventAttendance::create(['event_id' => $event,'person_id' => $people->id,'date' => date('Y-m-d')]);
            return redirect(route('sica.attendance.people.events_attendance'))->with('message_result', 'Registro Exitoso - '.ucfirst($people->full_name))->with('typealert', 'success')->with(['title'=>$title,'events'=>$events]);
                break;
        }
    }
    //endif;
    }

    

    public function postAddBasicData(Request $request)
    {
        /*
          //return $doc;
          $eps = Eps::pluck('name','id');
          $population_groups = PopulationGroup::pluck('name', 'id');
          $title = trans('sica::menu.Personal data Add');
          $data = ['doc'=>$doc,'title'=>$title, 'eps'=>$eps, 'population_groups' => $population_groups];
  
          return view('sica::admin.people.attendance.add', $data);
          // return $data;

          */
      }
  
      

      /**
       * Se agregan los datos de la persona si no existe.
       * @return Renderable
       */
      public function postAddData(Request $request)
      {
          $title = trans('sica::menu.Personal data Add');
          $events = Event::pluck('name','id');
          $rules = [
              'document_number' => 'required',
              'document_type' => 'required',
              'first_name' => 'required',
              'first_last_name' => 'required',
              'eps_id' => 'required',
              'population_group_id' => 'required'
          ];
          $messages = [
              'document_number.required' => 'El N¡Æ de documento es requerido',
              'document_type.required' => 'El tipo de documento es requerido',
              'first_name.required' => 'El primer nombre es requerido',
              'first_last_name.required' => 'El primer apellido es requerido',
              'eps_id.required' => 'La eps es requerida',
              'population_group_id.required' => 'El grupo de votacion es requerido'
          ];
          $validator = Validator::make($request->all(), $rules, $messages);
          if($validator->fails()):
              return view('sica::admin.people.attendance.add')->with(
                [
                 'title'=>$title, 
                 'document_type'=>$document_type, 
                 'doc' =>$doc,
                 'eps'=>$eps,
                 'population_groups'=>$population_groups,
                 'event' =>$event
                 ]);
          else:
  
              $p = new Person;
              $p->document_type = e($request->input('document_type'));
              $p->document_number = e($request->input('document_number'));
              
              $p->first_name = strtoupper(e($request->input('first_name')));
              $p->first_last_name = strtoupper(e($request->input('first_last_name')));
              $p->second_last_name = strtoupper(e($request->input('second_last_name')));
              $p->eps_id = e($request->input('eps_id'));
              $p->population_group_id = e($request->input('population_group_id'));
              
              if($p->save()){

                  //$p->events()->syncWithoutDetaching($request->input('event_id')); 
                $ea = EventAttendance::create(['event_id' => $request->input('event_id'),'person_id' => $p->id,'date' => date('Y-m-d')]);
                  return redirect(route('sica.attendance.people.events_attendance'))->with('message_result', 'Registro Exitoso')->with('typealert', 'success')->with(['title'=>$title,'events'=>$events]);
              }
          
      endif;
      }
  
    }

