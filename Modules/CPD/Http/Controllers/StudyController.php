<?php

namespace Modules\CPD\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\CPD\Entities\Data;
use Modules\CPD\Entities\Metadata;
use Modules\CPD\Entities\Producer;
use Modules\CPD\Entities\Study;
use Modules\SICA\Entities\Village;

class StudyController extends Controller
{

    public function index(){
        $view = ['titlePage'=>'Monitoreos', 'titleView'=>'Monitoreos de los cultivos de cacao'];
        $datas = Data::all();
        $studies = Study::orderBy('id','DESC')->get();
        return view('cpd::study.index', compact('view','datas','studies'));
    }

    public function create(){
        $view = ['titlePage'=>'Monitoreos - registro', 'titleView'=>'Registro de monitoreo de cultivo de cacao'];
        $datas = Data::all();
        $producers = Producer::orderBy('name','ASC')->pluck('name','id');
        $villages = Village::get()->pluck("VillMun", "id");
        return view('cpd::study.add', compact('view','datas','producers','villages'));
    }

    public function store(Request $request){
        $st = new Study;
        $metadas = Metadata::all();
        $st->producer_id = e($request->input('producer_id'));
        $st->monitoring = e($request->input('monitoring'));
        $st->village_id = e($request->input('village_id'));
        $st->typology = e($request->input('typology'));
        $st->altitud = e($request->input('altitud'));
        foreach($metadas as $metada){
            $ab = $metada->abbreviation;
            if($request->input($ab) == null){
                $st->$ab = null;
            }else{
                $st->$ab = e($request->input($ab));
            }
        }
        if($st->save()){
            $message_cpd_type = 'success';
            $message_cpd = 'Monitoreo registrado exitosamente.';
        }else{
            $message_cpd_type = 'error';
            $message_cpd = 'No se pudo registrar el monitoreo.';
        }
        return redirect(route('cpd.admin.study.index'))->with(['message_cpd_type'=>$message_cpd_type, 'message_cpd'=>$message_cpd]);
    }

    public function edit($id){
        $view = ['titlePage'=>'Monitoreos - actualizar', 'titleView'=>'Actualización de monitoreo de cultivo de cacao'];
        $datas = Data::all();
        $producers = Producer::orderBy('name','ASC')->pluck('name','id');
        $villages = Village::get()->pluck("VillMun", "id");
        $study = Study::find($id);
        return view('cpd::study.edit', compact('view','datas','producers','villages','study'));
    }

    public function update(Request $request){
        $metadas = Metadata::all();
        $st = Study::findOrFail(e($request->input('study_id')));
        $st->producer_id = e($request->input('producer_id'));
        $st->monitoring = e($request->input('monitoring'));
        $st->village_id = e($request->input('village_id'));
        $st->typology = e($request->input('typology'));
        $st->altitud = e($request->input('altitud'));
        foreach($metadas as $metada){
            $ab = $metada->abbreviation;
            if($request->input($ab) == null){
                $st->$ab = null;
            }else{
                $st->$ab = e($request->input($ab));
            }
        }
        if($st->save()){
            $message_cpd_type = 'success';
            $message_cpd = 'Monitoreo actualizado exitosamente.';
        }else{
            $message_cpd_type = 'error';
            $message_cpd = 'No se pudo actualizar el monitoreo.';
        }
        return redirect(route('cpd.admin.study.index'))->with(['message_cpd_type'=>$message_cpd_type, 'message_cpd'=>$message_cpd]);
    }

    public function show($id){
        $titleView = 'Detalle de monitoreo';
        $datas = Data::all();
        $study = Study::find($id);
        return view('cpd::study.detail', compact('titleView','study','datas'));
    }

    public function delete($id){
        $titleView = '¿Confirma eliminar el siguiente monitoreo?';
        $datas = Data::all();
        $study = Study::find($id);
        return view('cpd::study.delete', compact('titleView','study','datas'));
    }

    public function destroy(Request $request){
        $st = Study::findOrFail($request->input('study_id'));
        if($st->delete()){
            $message_cpd_type = 'success';
            $message_cpd = 'Monitoreo eliminado exitosamente.';
        }else{
            $message_cpd_type = 'error';
            $message_cpd = 'No se pudo eliminar el monitoreo.';
        }
        return redirect(route('cpd.admin.study.index'))->with(['message_cpd_type'=>$message_cpd_type, 'message_cpd'=>$message_cpd]);
    }

}
