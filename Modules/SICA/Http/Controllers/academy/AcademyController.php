<?php

namespace Modules\SICA\Http\Controllers\academy;

use Dotenv\Parser\Lines;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Holiday;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Network;
use Modules\SICA\Entities\Line;
use Modules\SICA\Entities\Quarter;

class AcademyController extends Controller
{

    /* Listado de trimestres registrados */
    public function quarters_index(){
        $quarters = Quarter::orderBy('updated_at','DESC')->get();
        $data = ['title'=>'Trimestres','quarters'=>$quarters];
        return view('sica::admin.academy.quarters.index', $data);
    }

    /* Formulario de registro de trimestre */
    public function quarters_create(){
        $data = ['title'=>'Trimestres - Registro'];
        return view('sica::admin.academy.quarters.create',$data);
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
            $message = ['message'=>'Se registró exitosamente el trimestre.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo realizar el registro del trismestre.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.academy.quarters.index'))->with($message);
    }

    /* Formulario de actualización de trimestre (Administrador) */
    public function quarters_edit(Quarter $quarter){
        $data = ['title'=>'Trimestres - Actualización', 'quarter'=>$quarter];
        return view('sica::admin.academy.quarters.edit',$data);
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
            $message = ['message'=>'Se actualizó exitosamente el trimestre.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo actualizar el trimestre.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.academy.quarters.index'))->with($message);
    }

    /* Eliminar trimestre */
    public function quarters_destroy(Quarter $quarter){
        if ($quarter->delete()){
            $message = ['message'=>'Se eliminó exitosamente el trimestre.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar el trimestre.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.academy.quarters.index'))->with($message);
    }

    /* Listado de días festivos disponibles */
    public function holidays_index(){
        $holidays = Holiday::orderBy('updated_at','DESC')->get();
        $data = ['title'=>'Festivos', 'holidays'=>$holidays];
        return view('sica::admin.academy.holidays.index',$data);
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
            $message = ['message'=>'Se registró exitosamente el día festivo.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo realizar el registro del día festivo.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.academy.holidays.index'))->with($message);
    }

    /* Formulario para actualizar día festivo */
    public function holidays_edit(Holiday $holiday){
        $holidays = Holiday::orderBy('updated_at','DESC')->get();
        $data = ['title'=>'Festivos - Actualización', 'holidays'=>$holidays, 'holiday'=>$holiday];
        return view('sica::admin.academy.holidays.index',$data);
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
            $message = ['message'=>'Se actualizó exitosamente el día festivo.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo actualizar el día festivo.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.academy.holidays.index'))->with($message);
    }

    /* Eliminar día festivo */
    public function holidays_destroy(Holiday $holiday){
        if ($holiday->delete()){
            $message = ['message'=>'Se eliminó exitosamente el día festivo.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar el día festivo.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.academy.holidays.index'))->with($message);
    }

    public function lines(){
        $line = Line::orderBy('updated_at','DESC')->get();
        $data = ['title'=>trans('sica::menu.Lines'),'lines'=>$line];
        return view('sica::admin.academy.lines.home',$data);
    }

    public function createLine(){
        return view('sica::admin.academy.lines.create');
    }

    public function storeLine(Request $request){
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

    public function editLine($id){
        $line = Line::find($id);
        return view('sica::admin.academy.lines.edit',compact('line'));
    }

    public function updateLine(Request $request){
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

    public function deleteLine($id){
        $line = Line::find($id);
        return view('sica::admin.academy.lines.delete',compact('line'));
    }

    public function destroyLine(Request $request){
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

    //-------------------Seccion de Redes de Conocimiento------------------------
    public function networks(){
        $networks = Network::with('line')->orderBy('updated_at','DESC')->get();
        $data = ['title'=>trans('sica::menu.Knowledge Networks'),'networks'=>$networks];
        return view('sica::admin.academy.networks.home',$data);
    }

    public function createNetwork(){
        $lines = Line::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('sica::admin.academy.networks.create', compact('lines'));
    }

    public function storeNetwork(Request $request){
        $network = new Network();
        $network->name = e($request->input('name'));
        $network->line()->associate(Line::find($request->input('line_id')));
        if($network->save()){
            $icon = 'success';
            $message_network = trans('sica::menu.Knowledge Network successfully added');
        }else{
            $icon = 'error';
            $message_network = trans('sica::menu.Could not add Knowledge Network');
        }
        return back()->with(['icon'=>$icon, 'message_network'=>$message_network]);
    }

    public function editNetwork($id){
        $network = Network::find($id);
        $lines = Line::orderBy('name', 'ASC')->pluck('name', 'id');
        $data = [
            'title' => 'Editar Red de Conocimiento',
            'network' => $network,
            'lines' => $lines
        ];
        return view('sica::admin.academy.networks.edit', $data);
    }

    public function updateNetwork(Request $request){
        $network = Network::find($request->input('id'));
        $network->name = e($request->input('name'));
        $network->line_id = e($request->input('line_id'));
        if($network->save()){
            $icon = 'success';
            $message_network = trans('sica::menu.Knowledge Network successfully updated');
        }else{
            $icon = 'error';
            $message_network = trans('sica::menu.Failed to update Knowledge Network');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_network'=>$message_network]);
    }

    public function deleteNetwork($id){
        $network = Network::find($id);
        $data = [ 'title' => 'Eliminar Red de Conocimiento', 'network' => $network,];
        return view('sica::admin.academy.networks.delete', $data);
    }

    public function destroyNetwork(Request $request){
        $network = Network::findOrFail($request->input('id'));
        if($network->delete()){
            $icon = 'success';
            $message_network = trans('sica::menu.Knowledge Network successfully removed');
        }else{
            $icon = 'error';
            $message_network = trans('sica::menu.Could not delete Knowledge Network');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_network'=>$message_network]);
    }

    //-------------------Seccion de Programas de Formación------------------------
    public function programs(){
        $programs = Program::with('network')->orderBy('updated_at','DESC')->get();
        $data = ['title'=>trans('sica::menu.Formation Programs'),'programs'=>$programs];
        return view('sica::admin.academy.programs.home',$data);
    }

    public function createProgram(){
        $network = Network::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('sica::admin.academy.programs.create', compact('network'));
    }

    public function storeProgram(Request $request){
        $program = new Program();
        $program->sofia_code = e($request->input('sofia_code'));
        $program->program_type = e($request->input('program_type'));
        $program->name = e($request->input('name'));
        $program->network()->associate(Network::find($request->input('network_id')));
        if($program->save()){
            $icon = 'success';
            $message_program = trans('sica::menu.Formation Program successfully added');
        }else{
            $icon = 'error';
            $message_program = trans('sica::menu.Could not add Formation Program');
        }
        return back()->with(['icon'=>$icon, 'message_program'=>$message_program]);
    }

    public function editProgram($id){
        $program = Program::find($id);
        $network = Network::orderBy('name', 'ASC')->pluck('name', 'id');
        $data = [
            'title' => 'Editar programa de formación',
            'program' => $program,
            'network' => $network
        ];
        return view('sica::admin.academy.programs.edit', $data);
    }

    public function updateProgram(Request $request){
        $program = Program::find($request->input('id'));
        $program->sofia_code = e($request->input('sofia_code'));
        $program->program_type = e($request->input('program_type'));
        $program->name = e($request->input('name'));
        $program->network_id = e($request->input('network_id'));
        if($program->save()){
            $icon = 'success';
            $message_program = trans('sica::menu.Formation Program successfully updated');
        }else{
            $icon = 'error';
            $message_program = trans('sica::menu.Failed to update formation program');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_program'=>$message_program]);
    }

    public function deleteProgram($id){
        $program = Program::find($id);
        $data = [ 'title' => 'Eliminar programa de formación', 'program' => $program];
        return view('sica::admin.academy.programs.delete', $data);
    }

    public function destroyProgram(Request $request){
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

    //-------------------Seccion de Titulaciones------------------------
    public function courses(){
        $courses = Course::with('program')->orderBy('code','desc')->get();
        $data = ['title'=>trans('sica::menu.Courses'),'courses'=>$courses];
        return view('sica::admin.academy.courses.home',$data);
    }

    public function createCourse(){
        $program = Program::orderBy('name', 'ASC')->pluck('name','id');
        return view('sica::admin.academy.courses.create', compact('program'));
    }

    public function storeCourse(Request $request){
        $course = new Course();
        $course->code = e($request->input('code'));
        $course->star_date = e($request->input('star_date'));
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

    public function editCourse($id){
        $course = Course::find($id);
        $program = Program::orderBy('name', 'ASC')->pluck('name','id');
        $data = [
            'title' => 'Editar titulada',
            'course' => $course,
            'program' => $program
        ];
        return view('sica::admin.academy.courses.edit', $data);
    }

    public function updateCourse(Request $request){
        $course = Course::find($request->input('id'));
        $course->code = e($request->input('code'));
        $course->program_id = e($request->input('program_id'));
        $course->star_date = e($request->input('star_date'));
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

    public function deleteCourse($id){
        $course = Course::find($id);
        $data = ['title' => 'Eliminar Titulada', 'course' => $course];
        return view('sica::admin.academy.courses.delete', $data);
    }

    public function destroyCourse(Request $request){
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
