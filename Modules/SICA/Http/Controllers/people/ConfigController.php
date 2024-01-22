<?php

namespace Modules\SICA\Http\Controllers\people;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Event;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\InsurerEntity;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Entities\PopulationGroup;

class ConfigController extends Controller
{

    /* Vista principal de parámetros para datos de personas */
    public function config_index(){
        $events = Event::orderBy('updated_at','DESC')->get();
        $epss = EPS::orderBy('updated_at','DESC')->get();
        $populations = PopulationGroup::orderBy('updated_at','DESC')->get();
        $pension_entities = PensionEntity::orderByDesc('updated_at')->get();
        $insurer_entities = InsurerEntity::orderByDesc('updated_at')->get();
        $data = ['title'=>trans('sica::menu.Config'), 'events'=>$events, 'epss'=>$epss, 'populations'=>$populations, 'pension_entities'=>$pension_entities, 'insurer_entities'=>$insurer_entities];
        return view('sica::admin.people.config.index',$data);
    }

    /* Formulario de registro de EPS */
    public function eps_create(){
        return view('sica::admin.people.config.eps.create');
    }

    /* Registrar EPS */
    public function eps_store(Request $request){
        $ep = new EPS;
        $ep->name = e($request->input('name'));
        $card = 'eps-card';
        if($ep->save()){
            $icon = 'success';
            $message_config = 'Eps registrada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo registrar la eps.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    /* Formulario de actualización de EPS  */
    public function eps_edit($id){
        $eps = EPS::find($id);
        return view('sica::admin.people.config.eps.edit',compact('eps'));
    }

    /* Actualizar EPS */
    public function eps_update(Request $request){
        $ep = EPS::findOrFail($request->input('id'));
        $ep->name = e($request->input('name'));
        $card = 'eps-card';
        if($ep->save()){
            $icon = 'success';
            $message_config = 'Eps actualizada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar la eps.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    /* Formulario de eliminación de EPS */
    public function eps_delete($id){
        $eps = EPS::find($id);
        return view('sica::admin.people.config.eps.delete',compact('eps'));
    }

    /* Eliminar EPS */
    public function epd_destroy(Request $request){
        $ep = EPS::findOrFail($request->input('id'));
        $card = 'eps-card';
        if($ep->delete()){
            $icon = 'success';
            $message_config = 'Eps eliminada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar la eps.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    /* Formulario de registro de grupo poblacional */
    public function population_groups_create(){
        return view('sica::admin.people.config.population.create');
    }

    /* Registrar grupo poblacional */
    public function population_groups_store(Request $request){
        $po = new PopulationGroup;
        $po->name = e($request->input('name'));
        $po->description = e($request->input('description'));
        $card = 'population-groups-card';
        if($po->save()){
            $icon = 'success';
            $message_config = 'Grupo poblacional registrado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo registrar el grupo poblacional.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    /* Formulario de actualización de grupo poblacional */
    public function population_groups_edit($id){
        $population = PopulationGroup::find($id);
        return view('sica::admin.people.config.population.edit',compact('population'));
    }

    /* Actualizar grupo poblacional */
    public function population_groups_update(Request $request){
        $po = PopulationGroup::findOrFail($request->input('id'));
        $po->name = e($request->input('name'));
        $po->description = e($request->input('description'));
        $card = 'population-groups-card';
        if($po->save()){
            $icon = 'success';
            $message_config = 'Grupo poblacional actualizado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar el grupo poblacional.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    /* Formulario para eliminar grupo poblacional */
    public function population_groups_delete($id){
        $population = PopulationGroup::find($id);
        return view('sica::admin.people.config.population.delete',compact('population'));
    }

    /* Eliminar grupo poblacional */
    public function population_groups_destroy(Request $request){
        $po = PopulationGroup::findOrFail($request->input('id'));
        $card = 'population-groups-card';
        if($po->delete()){
            $icon = 'success';
            $message_config = 'Grupo poblacional eliminado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar el grupo poblacional.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    /* Formulario de registro de evento */
    public function events_create(){
        return view('sica::admin.people.config.events.create');
    }

    /* Registrar evento */
    public function events_store(Request $request){
        $ev = new Event;
        $ev->name = e($request->input('name'));
        $ev->description = e($request->input('description'));
        $ev->start_date = e(Carbon::parse($request->input('start_date'))); /* Format the date to send to the database */
        $ev->end_date = e(Carbon::parse($request->input('end_date'))); /* Format the date to send to the database */
        $ev->state = e($request->input('state'));
        $card = 'events-card';
        if($ev->save()){
            $icon = 'success';
            $message_config = 'Evento registrado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo registrar el evento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    /* Formulario de actualización de evento */
    public function events_edit($id){
        $event = Event::find($id);
        return view('sica::admin.people.config.events.edit',compact('event'));
    }

    /* Actualizar evento */
    public function events_update(Request $request){
        $ev = Event::findOrFail($request->input('id'));
        $ev->name = e($request->input('name'));
        $ev->description = e($request->input('description'));
        $ev->start_date = e(Carbon::parse($request->input('start_date'))); /* Format the date to send to the database */
        $ev->end_date = e(Carbon::parse($request->input('end_date'))); /* Format the date to send to the database */
        $ev->state = e($request->input('state'));
        $card = 'events-card';
        if($ev->save()){
            $icon = 'success';
            $message_config = 'Evento actualizado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar el evento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    /* Formulario para eliminar evento */
    public function events_delete($id){
        $event = Event::find($id);
        return view('sica::admin.people.config.events.delete',compact('event'));
    }

    /* Eliminar evento */
    public function events_destroy(Request $request){
        $ev = Event::findOrFail($request->input('id'));
        $card = 'events-card';
        if($ev->delete()){
            $icon = 'success';
            $message_config = 'Evento eliminado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar el evento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

}
