<?php

namespace Modules\SICA\Http\Controllers\people;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Event;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;

class ConfigController extends Controller
{

    public function config(){
        $events = Event::orderBy('id','DESC')->get();
        $epss = EPS::orderBy('name','ASC')->get();
        $populations = PopulationGroup::orderBy('name','ASC')->get();
        $data = ['title'=>trans('sica::menu.Config'), 'events'=>$events, 'epss'=>$epss, 'populations'=>$populations];
        return view('sica::admin.people.config.home',$data);
    }

    public function addEventGet(){
        return view('sica::admin.people.config.events.add');
    }

    public function addEventPost(Request $request){
        $ev = new Event;
        $ev->name = e($request->input('name'));
        $ev->description = e($request->input('description'));
        $ev->start_date = e(Carbon::parse($request->input('start_date'))); /* Format the date to send to the database */
        $ev->end_date = e(Carbon::parse($request->input('end_date'))); /* Format the date to send to the database */
        $ev->state = e($request->input('state'));
        $card = 'card-events';
        if($ev->save()){
            $icon = 'success';
            $message_config = 'Evento registrado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo registrar el evento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function editEventGet($id){
        $event = Event::find($id);
        return view('sica::admin.people.config.events.edit',compact('event'));
    }

    public function editEventPost(Request $request){
        $ev = Event::findOrFail($request->input('id'));
        $ev->name = e($request->input('name'));
        $ev->description = e($request->input('description'));
        $ev->start_date = e(Carbon::parse($request->input('start_date'))); /* Format the date to send to the database */
        $ev->end_date = e(Carbon::parse($request->input('end_date'))); /* Format the date to send to the database */
        $ev->state = e($request->input('state'));
        $card = 'card-events';
        if($ev->save()){
            $icon = 'success';
            $message_config = 'Evento actualizado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar el evento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function deleteEventGet($id){
        $event = Event::find($id);
        return view('sica::admin.people.config.events.delete',compact('event'));
    }

    public function deleteEventPost(Request $request){
        $ev = Event::findOrFail($request->input('id'));
        $card = 'card-events';
        if($ev->delete()){
            $icon = 'success';
            $message_config = 'Evento eliminado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar el evento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function addEpsGet(){
        return view('sica::admin.people.config.eps.add');
    }

    public function addEpsPost(Request $request){
        $ep = new EPS;
        $ep->name = e($request->input('name'));
        $card = 'card-eps';
        if($ep->save()){
            $icon = 'success';
            $message_config = 'Eps registrada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo registrar la eps.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function editEpsGet($id){
        $eps = EPS::find($id);
        return view('sica::admin.people.config.eps.edit',compact('eps'));
    }

    public function editEpsPost(Request $request){
        $ep = EPS::findOrFail($request->input('id'));
        $ep->name = e($request->input('name'));
        $card = 'card-eps';
        if($ep->save()){
            $icon = 'success';
            $message_config = 'Eps actualizada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar la eps.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function deleteEpsGet($id){
        $eps = EPS::find($id);
        return view('sica::admin.people.config.eps.delete',compact('eps'));
    }

    public function deleteEpsPost(Request $request){
        $ep = EPS::findOrFail($request->input('id'));
        $card = 'card-eps';
        if($ep->delete()){
            $icon = 'success';
            $message_config = 'Eps eliminada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar la eps.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function addPopulationGet(){
        return view('sica::admin.people.config.population.add');
    }

    public function addPopulationPost(Request $request){
        $po = new PopulationGroup;
        $po->name = e($request->input('name'));
        $po->description = e($request->input('description'));
        $card = 'card-population';
        if($po->save()){
            $icon = 'success';
            $message_config = 'Grupo poblacional registrado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo registrar el grupo poblacional.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function editPopulationGet($id){
        $population = PopulationGroup::find($id);
        return view('sica::admin.people.config.population.edit',compact('population'));
    }

    public function editPopulationPost(Request $request){
        $po = PopulationGroup::findOrFail($request->input('id'));
        $po->name = e($request->input('name'));
        $po->description = e($request->input('description'));
        $card = 'card-population';
        if($po->save()){
            $icon = 'success';
            $message_config = 'Grupo poblacional actualizado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar el grupo poblacional.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function deletePopulationGet($id){
        $population = PopulationGroup::find($id);
        return view('sica::admin.people.config.population.delete',compact('population'));
    }

    public function deletePopulationPost(Request $request){
        $po = PopulationGroup::findOrFail($request->input('id'));
        $card = 'card-population';
        if($po->delete()){
            $icon = 'success';
            $message_config = 'Grupo poblacional eliminado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar el grupo poblacional.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

}
