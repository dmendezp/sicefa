<?php

namespace Modules\SICA\Http\Controllers\academy;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Holiday;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Network;
use Modules\SICA\Entities\KnowledgeNetwork;
use Modules\SICA\Entities\Line;
use Modules\SICA\Entities\Quarter;
use Illuminate\Support\Facades\DB;

class AcademyController extends Controller
{

    /* Listado de días festivos registrados */
    public function holidays_index(){
        $holidays = Holiday::orderBy('updated_at','DESC')->get();
        $data = ['title'=>'Festivos', 'holidays'=>$holidays];
        return view('sica::admin.academy.holidays.index', $data);
    }

    /* Registrar día festivo */
    public function holidays_store(Request $request){
        $rules = [
            'date' => 'required',
            'issue' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        if (Holiday::create($request->all())){
            $icon = 'success';
            $message_holiday = trans('sica::menu.Holiday successfully added');
        } else {
            $icon = 'error';
            $message_holiday = trans('sica::menu.Could not add Holiday');
        }
        return redirect(route('sica.'.getRoleRouteName(Route::currentRouteName()).'.academy.holidays.index'))->with(['icon'=>$icon, 'message_holiday'=>$message_holiday]);
    }

    /* Formulario para actualizar día festivo */
    public function holidays_edit(Holiday $holiday){
        $holidays = Holiday::orderBy('updated_at','DESC')->get();
        $data = ['title'=>'Festivos - Actualización', 'holidays'=>$holidays, 'holiday'=>$holiday];
        return view('sica::admin.academy.holidays.index', $data);
    }

    /* Actualizar día festivo */
    public function holidays_update(Request $request, Holiday $holiday){
        $rules = [
            'date' => 'required',
            'issue' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        if ($holiday->update($request->all())){
            $icon = 'success';
            $message_holiday = trans('sica::menu.Holiday successfully updated');
        } else {
            $icon = 'error';
            $message_holiday = trans('sica::menu.Failed to update Holiday');
        }
        return redirect(route('sica.'.getRoleRouteName(Route::currentRouteName()).'.academy.holidays.index'))->with(['icon'=>$icon, 'message_holiday'=>$message_holiday]);
    }

    /* Formulario de eliminación del festivo */
    public function holidays_delete($id){
        $holiday = Holiday::find($id);
        $data = [ 'title' => 'Eliminar festivo', 'holiday' => $holiday];
        return view('sica::admin.academy.holidays.delete', $data);
    }

     /* Eliminar festivo */
     public function holidays_destroy(Request $request){
        $holiday = Holiday::findOrFail($request->input('id'));
        if($holiday->delete()){
            $icon = 'success';
            $message_holiday = trans('sica::menu.Holiday successfully removed');
        }else{
            $icon = 'error';
            $message_holiday = trans('sica::menu.Could not delete Holiday');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_holiday'=>$message_holiday]);
    }

    /* Listado de trimestres registrados */
    public function quarters_index(){
        $quarters = Quarter::orderBy('updated_at','DESC')->get();
        $data = ['title'=>'Trimestres','quarters'=>$quarters];
        return view('sica::admin.academy.quarters.index', $data);
    }

    /* Formulario de registro de trimestre */
    public function quarters_create(){
        $data = ['title'=>'Trimestres - Registro'];
        return view('sica::admin.academy.quarters.create', $data);
    }

    /* Registrar trimestre */
    public function quarters_store(Request $request){
        $rules = [
            'name'=> 'required',
            'start_date'=> 'required|date',
            'end_date'=> 'required|date|after:start_date'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        if (Quarter::create($request->all())){
            $icon = 'success';
            $message_quarter = trans('sica::menu.Quarter successfully added');
        } else {
            $icon = 'error';
            $message_quarter = trans('sica::menu.Could not add Quarter');
        }
        return redirect(route('sica.'.getRoleRouteName(Route::currentRouteName()).'.academy.quarters.index'))->with(['icon'=>$icon, 'message_quarter'=>$message_quarter]);
    }

    /* Formulario de actualización de trimestre (Administrador) */
    public function quarters_edit(Quarter $quarter){
        $data = ['title'=>'Trimestres - Actualización', 'quarter'=>$quarter];
        return view('sica::admin.academy.quarters.edit', $data);
    }

    /* Actualizar trimestre */
    public function quarters_update(Request $request, Quarter $quarter){
        $rules = [
            'name'=> 'required',
            'start_date'=> 'required|date',
            'end_date'=> 'required|date|after:start_date'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Actualizar registro
        if ($quarter->update($request->all())){
            $icon = 'success';
            $message_quarter = trans('sica::menu.Quarter successfully updated');
        } else {
            $icon = 'error';
            $message_quarter = trans('sica::menu.Failed to update Quarter');
        }
        return redirect(route('sica.'.getRoleRouteName(Route::currentRouteName()).'.academy.quarters.index'))->with(['icon'=>$icon, 'message_quarter'=>$message_quarter]);
    }

    /* Formulario de eliminación del trimestre */
    public function quarters_delete($id){
        $quarter = Quarter::find($id);
        $data = [ 'title' => 'Eliminar Trimestre', 'quarter' => $quarter];
        return view('sica::admin.academy.quarters.delete', $data);
    }

     /* Eliminar trimestre */
     public function quarters_destroy(Request $request){
        $quarter = Quarter::findOrFail($request->input('id'));
        if($quarter->delete()){
            $icon = 'success';
            $message_quarter = trans('sica::menu.Quarter successfully removed');
        }else{
            $icon = 'error';
            $message_quarter = trans('sica::menu.Could not delete Quarter');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_quarter'=>$message_quarter]);
    }

    /* Listado de programas de formación registrados */
    public function programs_index(){
        $programs = Program::with('knowledge_network')->orderBy('updated_at','DESC')->get();
        $data = ['title'=>trans('sica::menu.Formation Programs'),'programs'=>$programs];
        return view('sica::admin.academy.programs.index',$data);
    }

    /* Formulario de registro de programa de formación */
    public function programs_create(){
        $network = KnowledgeNetwork::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('sica::admin.academy.programs.create', compact('network'));
    }

    /* Registrar programa de formación */
    public function programs_store(Request $request){
        $program = new Program();
        $program->sofia_code = e($request->input('sofia_code'));
        $program->version = e($request->input('version'));
        $program->training_type = e($request->input('training_type'));
        $program->name = e($request->input('name'));
        $program->quarter_number = e($request->input('quarter_number'));
        $program->program_type = e($request->input('program_type'));
        $program->maximum_duration = e($request->input('maximum_duration'));
        $program->modality = e($request->input('modality'));
        $program->priority_bets = e($request->input('priority_bets'));
        $program->fic = e($request->input('fic'));
        $program->months_lectiva = e($request->input('months_lectiva'));
        $program->months_productiva = e($request->input('months_productiva'));
        $program->knowledge_network()->associate(KnowledgeNetwork::find($request->input('knowledge_network_id')));
        if($program->save()){
            $icon = 'success';
            $message_program = trans('sica::menu.Formation Program successfully added');
        }else{
            $icon = 'error';
            $message_program = trans('sica::menu.Could not add Formation Program');
        }
        return back()->with(['icon'=>$icon, 'message_program'=>$message_program]);
    }

    /* Formulario de actualización de programa de formación */
    public function programs_edit($id){
        $program = Program::find($id);
        $network = KnowledgeNetwork::orderBy('name', 'ASC')->pluck('name', 'id');
        $data = [
            'title' => 'Editar programa de formación',
            'program' => $program,
            'network' => $network
        ];
        return view('sica::admin.academy.programs.edit', $data);
    }

    /* Actualizar programa de formación */
    public function programs_update(Request $request){
        $program = Program::find($request->input('id'));
        $program->sofia_code = e($request->input('sofia_code'));
        $program->version = e($request->input('version'));
        $program->training_type = e($request->input('training_type'));
        $program->name = e($request->input('name'));
        $program->quarter_number = e($request->input('quarter_number'));
        $program->program_type = e($request->input('program_type'));
        $program->maximum_duration = e($request->input('maximum_duration'));
        $program->modality = e($request->input('modality'));
        $program->priority_bets = e($request->input('priority_bets'));
        $program->fic = e($request->input('fic'));
        $program->months_lectiva = e($request->input('months_lectiva'));
        $program->months_productiva = e($request->input('months_productiva'));
        $program->knowledge_network_id = e($request->input('knowledge_network_id'));
        if($program->save()){
            $icon = 'success';
            $message_program = trans('sica::menu.Formation Program successfully updated');
        }else{
            $icon = 'error';
            $message_program = trans('sica::menu.Failed to update formation program');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_program'=>$message_program]);
    }

    /* Formulario de eliminación de programa de formación */
    public function programs_delete($id){
        $program = Program::find($id);
        $data = [ 'title' => 'Eliminar programa de formación', 'program' => $program];
        return view('sica::admin.academy.programs.delete', $data);
    }

    /* Eliminar programa de formación */
    public function programs_destroy(Request $request){
        $program = Program::findOrFail($request->input('id'));
        if($program->delete()){
            $icon = 'success';
            $message_program = trans('sica::menu.Formation program successfully removed');
        }else{
            $icon = 'error';
            $message_program = trans('sica::menu.Could not delete formation program');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_program'=>$message_program]);
    }

    /* Listado de redes de conocimiento registrados */
    public function networks_index(){
        $networks = Network::with('line')->orderBy('updated_at','DESC')->get();
        $data = ['title'=>trans('sica::menu.Networks'),'networks'=>$networks];
        return view('sica::admin.academy.networks.index', $data);
    }

    // Formulario de registro de red de conocimiento
    public function networks_create(){
        $lines = Line::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('sica::admin.academy.networks.create', compact('lines'));
    }

    /* Registrar red de conocimiento */
    public function networks_store(Request $request){
        $network = new Network();
        $network->name = e($request->input('name'));
        $network->line()->associate(Line::find($request->input('line_id')));
        if($network->save()){
            $icon = 'success';
            $message_network = trans('sica::menu.Network successfully added');
        }else{
            $icon = 'error';
            $message_network = trans('sica::menu.Could not add Network');
        }
        return back()->with(['icon'=>$icon, 'message_network'=>$message_network]);
    }

    /* Formulario de actualización de red de conocimiento */
    public function networks_edit($id){
        $network = Network::find($id);
        $lines = Line::orderBy('name', 'ASC')->pluck('name', 'id');
        $data = [
            'title' => 'Editar Red Tecnológica',
            'network' => $network,
            'lines' => $lines
        ];
        return view('sica::admin.academy.networks.edit', $data);
    }

    /* Actualizar red de conocimiento */
    public function networks_update(Request $request){
        $network = Network::find($request->input('id'));
        $network->name = e($request->input('name'));
        $network->line_id = e($request->input('line_id'));
        if($network->save()){
            $icon = 'success';
            $message_network = trans('sica::menu.Network successfully updated');
        }else{
            $icon = 'error';
            $message_network = trans('sica::menu.Failed to update Network');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_network'=>$message_network]);
    }

    /* Formulario de eliminación de red de conocimiento */
    public function networks_delete($id){
        $network = Network::find($id);
        $data = [ 'title' => 'Eliminar Red Tecnológica', 'network' => $network,];
        return view('sica::admin.academy.networks.delete', $data);
    }

    /* Eliminar red de conocimiento */
    public function networks_destroy(Request $request){
        $network = Network::findOrFail($request->input('id'));
        if($network->delete()){
            $icon = 'success';
            $message_network = trans('sica::menu.Network successfully removed');
        }else{
            $icon = 'error';
            $message_network = trans('sica::menu.Could not delete Network');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_network'=>$message_network]);
    }


     /* Listado de redes de conocimiento registrados */
     public function knowledgenetworks_index(){
        $knowledgenetworks = KnowledgeNetwork::with('network')->orderBy('updated_at','DESC')->get();
        $data = ['title'=>trans('sica::menu.Knowledge Networks'),'knowledgenetworks'=>$knowledgenetworks];
        return view('sica::admin.academy.knowledge_networks.index', $data);
    }

    // Formulario de registro de red de conocimiento
    public function knowledgenetworks_create(){
        $networks = Network::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('sica::admin.academy.knowledge_networks.create', compact('networks'));
    }

    /* Registrar red de conocimiento */
    public function knowledgenetworks_store(Request $request){
        $network = new KnowledgeNetwork();
        $network->name = e($request->input('name'));
        $network->network()->associate(Network::find($request->input('network_id')));
        if($network->save()){
            $icon = 'success';
            $message_network = trans('sica::menu.Knowledge Network successfully added');
        }else{
            $icon = 'error';
            $message_network = trans('sica::menu.Could not add Knowledge Network');
        }
        return back()->with(['icon'=>$icon, 'message_network'=>$message_network]);
    }

    /* Formulario de actualización de red de conocimiento */
    public function knowledgenetworks_edit($id){
        $knowledgenetworks = KnowledgeNetwork::find($id);
        $networks = Network::orderBy('name', 'ASC')->pluck('name', 'id');
        $data = [
            'title' => 'Editar Red de Conocimiento',
            'knowledgenetworks' => $knowledgenetworks,
            'networks' => $networks
        ];
        return view('sica::admin.academy.knowledge_networks.edit', $data);
    }

    /* Actualizar red de conocimiento */
    public function knowledgenetworks_update(Request $request){
        $knowledgenetworks = KnowledgeNetwork::find($request->input('id'));
        $knowledgenetworks->name = e($request->input('name'));
        $knowledgenetworks->network_id = e($request->input('network_id'));
        if($knowledgenetworks->save()){
            $icon = 'success';
            $message_network = trans('sica::menu.Knowledge Network successfully updated');
        }else{
            $icon = 'error';
            $message_network = trans('sica::menu.Failed to update Knowledge Network');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_network'=>$message_network]);
    }

    /* Formulario de eliminación de red de conocimiento */
    public function knowledgenetworks_delete($id){
        $knowledgenetwork = KnowledgeNetwork::find($id);
        $data = [ 'title' => 'Eliminar Red de Conocimiento', 'knowledgenetwork' => $knowledgenetwork,];
        return view('sica::admin.academy.knowledge_networks.delete', $data);
    }

    /* Eliminar red de conocimiento */
    public function knowledgenetworks_destroy(Request $request){
        $knowledgenetwork = KnowledgeNetwork::findOrFail($request->input('id'));
        if($knowledgenetwork->delete()){
            $icon = 'success';
            $message_network = trans('sica::menu.Knowledge Network successfully removed');
        }else{
            $icon = 'error';
            $message_network = trans('sica::menu.Could not delete Knowledge Network');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_network'=>$message_network]);
    }

    /* Listado de líneas tecnológicas registradas */
    public function lines_index(){
        $line = Line::orderBy('updated_at','DESC')->get();
        $data = ['title'=>trans('sica::menu.Lines'),'lines'=>$line];
        return view('sica::admin.academy.lines.index', $data);
    }

    /* Formulario de registro de línea tecnológica */
    public function lines_create(){
        return view('sica::admin.academy.lines.create');
    }

    /* Registrar línea tecnológica */
    public function lines_store(Request $request){
        $line = new Line;
        $line->name = e($request->input('name'));
        if($line->save()){
            $icon = 'success';
            $message_line = trans('sica::menu.Technological line successfully added');
        }else{
            $icon = 'error';
            $message_line = trans('sica::menu.Could not add technological line');
        }
        return back()->with(['icon'=>$icon, 'message_line'=>$message_line]);
    }

    /* Formulario de actualización de línea tecnológica */
    public function lines_edit($id){
        $line = Line::find($id);
        return view('sica::admin.academy.lines.edit',compact('line'));
    }

    /* Actualizar línea tecnológica */
    public function lines_update(Request $request){
        $line = Line::findOrFail($request->input('id'));
        $line->name = e($request->input('name'));
        if($line->save()){
            $icon = 'success';
            $message_line = trans('sica::menu.Technological line updated successfully');
        }else{
            $icon = 'error';
            $message_line = trans('sica::menu.Could not update technological line');
        }
        return back()->with(['icon'=>$icon, 'message_line'=>$message_line]);
    }

    /* Formulario de eliminación de línea tecnológica */
    public function lines_delete($id){
        $line = Line::find($id);
        return view('sica::admin.academy.lines.delete', compact('line'));
    }

    /* Eliminar línea tecnológica */
    public function lines_destroy(Request $request){
        $line = Line::findOrFail($request->input('id'));
        if($line->delete()){
            $icon = 'success';
            $message_line = trans('sica::menu.Technological line successfully removed');
        }else{
            $icon = 'error';
            $message_line = trans('sica::menu.Could not delete technological line');
        }
        return back()->with(['icon'=>$icon, 'message_line'=>$message_line]);
    }

    /* Listado de cursos registados */
    public function courses_index(){
        $courses = Course::with('program', 'person')->orderByDesc('updated_at')->get();
        $data = ['title'=>trans('sica::menu.Courses'),'courses'=>$courses];
        return view('sica::admin.academy.courses.index',$data);
    }

    /* Formulario de registro de curso */
    public function courses_create(){
        $program = Program::orderBy('name', 'ASC')->pluck('name','id');

        $getInstructor = DB::table('employees')
        ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
        ->join('people', 'employees.person_id', '=', 'people.id')
        ->where('state', 'Activo')
        ->where('employee_types.name', 'Instructor')
        ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
        ->union(
            DB::table('contractors')
            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
            ->join('people', 'contractors.person_id', '=', 'people.id')
            ->where('state', 'Activo')
            ->where('employee_types.name', 'Instructor')
            ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
        )->get();

        $instructors = $getInstructor->map(function ($i) {
            $id = $i->id;
            $name = $i->first_name . ' ' . $i->first_last_name . ' ' . $i->second_last_name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.SelectAnInstructor')])->pluck('name', 'id');

        $data = [
            'program' => $program,
            'instructors' => $instructors
        ];

        return view('sica::admin.academy.courses.create', $data);
    }

    /* Registrar curso */
    public function courses_store(Request $request){
        $course = new Course();
        $course->code = e($request->input('code'));
        $course->person_id = e($request->input('person_id'));
        $course->star_date = e($request->input('star_date'));
        $course->school_end_date = e($request->input('school_end_date'));
        $course->star_production_date = e($request->input('star_production_date'));
        $course->end_date = e($request->input('end_date'));
        $course->status = e($request->input('status'));
        $course->program()->associate(Program::find($request->input('program_id')));
        $course->deschooling = e($request->input('deschooling'));
        if($course->save()){
            $icon = 'success';
            $message_course = trans('sica::menu.Successfully added Course');
        }else{
            $icon = 'error';
            $message_course = trans('sica::menu.Course could not be added');
        }
        return back()->with(['icon'=>$icon, 'message_course'=>$message_course]);
    }

    /* Formulario de actualización de curso */
    public function courses_edit($id){
        $course = Course::find($id);
        $program = Program::orderBy('name', 'ASC')->pluck('name','id');

        $getInstructor = DB::table('employees')
        ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
        ->join('people', 'employees.person_id', '=', 'people.id')
        ->where('state', 'Activo')
        ->where('employee_types.name', 'Instructor')
        ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
        ->union(
            DB::table('contractors')
            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
            ->join('people', 'contractors.person_id', '=', 'people.id')
            ->where('state', 'Activo')
            ->where('employee_types.name', 'Instructor')
            ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
        )->get();

        $instructors = $getInstructor->map(function ($i) {
            $id = $i->id;
            $name = $i->first_name . ' ' . $i->first_last_name . ' ' . $i->second_last_name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.SelectAnInstructor')])->pluck('name', 'id');
        
        $data = [
            'title' => 'Editar titulada',
            'course' => $course,
            'program' => $program,
            'instructors' => $instructors
        ];
        return view('sica::admin.academy.courses.edit', $data);
    }

    /* Actualizar curso */
    public function courses_update(Request $request){
        $course = Course::find($request->input('id'));
        $course->code = e($request->input('code'));
        $course->program_id = e($request->input('program_id'));
        $course->person_id = e($request->input('person_id'));
        $course->star_date = e($request->input('star_date'));
        $course->school_end_date = e($request->input('school_end_date'));
        $course->star_production_date = e($request->input('star_production_date'));
        $course->end_date = e($request->input('end_date'));
        $course->status = e($request->input('status'));
        $course->deschooling = e($request->input('deschooling'));
        if($course->save()){
            $icon = 'success';
            $message_course = trans('sica::menu.Successfully upgraded Course');
        }else{
            $icon = 'error';
            $message_course = trans('sica::menu.Could not update the Course');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_course'=>$message_course]);
    }

    /* Formulario de eliminación de curso */
    public function courses_delete($id){
        $course = Course::find($id);
        $data = ['title' => 'Eliminar Titulada', 'course' => $course];
        return view('sica::admin.academy.courses.delete', $data);
    }

    /* Eliminar curso */
    public function course_destroy(Request $request){
        $course = Course::findOrFail($request->input('id'));
        if($course->delete()){
            $icon = 'success';
            $message_course = trans('sica::menu.Course successfully removed');
        }else{
            $icon = 'error';
            $message_course = trans('sica::menu.Could not remove the Course');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_course'=>$message_course]);
    }

}
