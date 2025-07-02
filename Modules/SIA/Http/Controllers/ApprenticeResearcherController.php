<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\ApprenticeResearcher;
use Modules\SICA\Entities\Person;
use App\Models\User;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Course;
use Modules\SIA\Entities\Group;
use Modules\SIA\Entities\Project;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;
use Modules\SICA\Entities\PensionEntity;

class ApprenticeResearcherController extends Controller
{
    public function index()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_apprentice_index_title_page'),
            'titleView' => trans('sia::controllers.SIA_apprentice_index_title_view')
        ];
        $apprentices = ApprenticeResearcher::with(['person', 'user', 'program', 'course'])->get();
        return view('sia::apprentice-researchers.index', compact('view', 'apprentices'));
    }

    public function create()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_apprentice_create_title_page'),
            'titleView' => trans('sia::controllers.SIA_apprentice_create_title_view')
        ];
        $programs = Program::orderBy('name', 'ASC')->get();
        $courses = Course::orderBy('code', 'ASC')->get();
        $groups = Group::orderBy('name', 'ASC')->get();
        $projects = Project::orderBy('name', 'ASC')->get();
        $epsList = EPS::orderBy('name', 'ASC')->get();
        $populationGroups = PopulationGroup::orderBy('name', 'ASC')->get();
        $pensionEntities = PensionEntity::orderBy('name', 'ASC')->get();

        return view('sia::apprentice-researchers.create', compact(
            'view', 'programs', 'courses', 'groups', 'projects',
            'epsList', 'populationGroups', 'pensionEntities'
        ));
    }

    public function store(Request $request)
    {
        $request->merge(['password' => bcrypt($request->input('password'))]);
        $rules = [
            'tipo_documento' => 'required|in:Cédula de ciudadanía,Tarjeta de identidad,Cédula de extranjería,Pasaporte,Documento nacional de identidad,Registro civil',
            'numero_documento' => 'required|numeric|unique:people,document_number,' . ($request->input('person_id') ?: 'NULL'),
            'nombres' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'eps_id' => 'required|exists:e_p_s,id',
            'numero_celular' => 'required|numeric|digits:10',
            'population_group_id' => 'required|exists:population_groups,id',
            'pension_entity_id' => 'required|exists:pension_entities,id',
            'nickname' => 'required|string|max:255|unique:users,nickname',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'program_id' => 'required|exists:programs,id',
            'course_id' => 'required|exists:courses,id',
            'group_id' => 'required|exists:groups,id',
            'project_id' => 'nullable|exists:projects,id',
            'institution' => 'required|string|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request) {
            $personId = $request->input('person_id');
            if (!$personId) {
                $person = Person::create([
                    'document_type' => $request->input('tipo_documento'),
                    'document_number' => $request->input('numero_documento'),
                    'first_name' => $request->input('nombres'),
                    'first_last_name' => $request->input('primer_apellido'),
                    'second_last_name' => $request->input('segundo_apellido'),
                    'eps_id' => $request->input('eps_id'),
                    'telephone1' => $request->input('numero_celular'),
                    'population_group_id' => $request->input('population_group_id'),
                    'pension_entity_id' => $request->input('pension_entity_id'),
                ]);
                $personId = $person->id;
            }

            $user = User::create([
                'nickname' => $request->input('nickname'),
                'person_id' => $personId,
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            $apprentice = ApprenticeResearcher::create([
                'person_id' => $personId,
                'user_id' => $user->id,
                'program_id' => $request->input('program_id'),
                'course_id' => $request->input('course_id'),
                'group_id' => $request->input('group_id'),
                'project_id' => $request->input('project_id'),
                'institution' => $request->input('institution'),
            ]);

            // Asignar rol usando el slug 'sia.ap-inv'
            $role = Role::where('slug', 'sia.ap-inv')->first();
            if ($role) {
                $user->roles()->syncWithoutDetaching([$role->id]);
            }

            session()->flash('message_sia', 'Aprendiz registrado exitosamente por el administrador');
            session()->flash('message_sia_type', 'success');
        });

        return redirect()->route('sia.admin.apprentice-researchers.index');
    }

    public function edit(ApprenticeResearcher $apprentice)
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_apprentice_edit_title_page'),
            'titleView' => trans('sia::controllers.SIA_apprentice_edit_title_view')
        ];
        $programs = Program::orderBy('name', 'ASC')->get();
        $courses = Course::orderBy('code', 'ASC')->get();
        $groups = Group::orderBy('name', 'ASC')->get();
        $projects = Project::orderBy('name', 'ASC')->get();
        $epsList = EPS::orderBy('name', 'ASC')->get();
        $populationGroups = PopulationGroup::orderBy('name', 'ASC')->get();
        $pensionEntities = PensionEntity::orderBy('name', 'ASC')->get();

        return view('sia::apprentice-researchers.edit', compact(
            'view', 'apprentice', 'programs', 'courses', 'groups', 'projects',
            'epsList', 'populationGroups', 'pensionEntities'
        ));
    }

    public function update(Request $request, ApprenticeResearcher $apprentice)
    {
        $rules = [
            'tipo_documento' => 'required|in:Cédula de ciudadanía,Tarjeta de identidad,Cédula de extranjería,Pasaporte,Documento nacional de identidad,Registro civil',
            'numero_documento' => 'required|numeric|unique:people,document_number,' . ($apprentice->person_id ?: 'NULL'),
            'nombres' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'eps_id' => 'required|exists:e_p_s,id',
            'numero_celular' => 'required|numeric|digits:10',
            'population_group_id' => 'required|exists:population_groups,id',
            'pension_entity_id' => 'required|exists:pension_entities,id',
            'nickname' => 'required|string|max:255|unique:users,nickname,' . $apprentice->user_id,
            'email' => 'required|email|unique:users,email,' . $apprentice->user_id,
            'password' => 'nullable|string|min:8',
            'program_id' => 'required|exists:programs,id',
            'course_id' => 'required|exists:courses,id',
            'group_id' => 'required|exists:groups,id',
            'project_id' => 'nullable|exists:projects,id',
            'institution' => 'required|string|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $apprentice) {
            $person = $apprentice->person;
            $person->update([
                'document_type' => $request->input('tipo_documento'),
                'document_number' => $request->input('numero_documento'),
                'first_name' => $request->input('nombres'),
                'first_last_name' => $request->input('primer_apellido'),
                'second_last_name' => $request->input('segundo_apellido'),
                'eps_id' => $request->input('eps_id'),
                'telephone1' => $request->input('numero_celular'),
                'population_group_id' => $request->input('population_group_id'),
                'pension_entity_id' => $request->input('pension_entity_id'),
            ]);

            $user = $apprentice->user;
            $user->update([
                'nickname' => $request->input('nickname'),
                'email' => $request->input('email'),
                'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
            ]);

            $apprentice->update([
                'program_id' => $request->input('program_id'),
                'course_id' => $request->input('course_id'),
                'group_id' => $request->input('group_id'),
                'project_id' => $request->input('project_id'),
                'institution' => $request->input('institution'),
            ]);

            // Asignar o actualizar rol usando el slug 'sia.ap-inv'
            $role = Role::where('slug', 'sia.ap-inv')->first();
            if ($role) {
                $user->roles()->sync([$role->id]);
            }

            session()->flash('message_sia', 'Aprendiz actualizado exitosamente por el administrador');
            session()->flash('message_sia_type', 'success');
        });

        return redirect()->route('sia.admin.apprentice-researchers.index');
    }

    public function destroy(ApprenticeResearcher $apprentice)
    {
        if ($apprentice->remove()) {
            session()->flash('message_sia', 'Aprendiz eliminado exitosamente por el administrador');
            session()->flash('message_sia_type', 'success');
        } else {
            session()->flash('message_sia', 'Se ha producido un error al eliminar el aprendiz');
            session()->flash('message_sia_type', 'error');
        }
        return redirect()->route('sia.admin.apprentice-researchers.index');
    }

    public function checkDocument(Request $request)
    {
        $documentNumber = $request->input('document_number');
        $person = Person::where('document_number', $documentNumber)->first();

        return response()->json([
            'exists' => $person ? true : false,
            'person_id' => $person ? $person->id : null
        ]);
    }
}