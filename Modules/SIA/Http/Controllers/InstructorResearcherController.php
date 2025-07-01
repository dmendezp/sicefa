<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\InstructorResearcher;
use Modules\SICA\Entities\Person;
use App\Models\User;
use Modules\SIGAC\Entities\Profession;

class InstructorResearcherController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Muestra la lista de instructores investigadores.
     */
    public function index()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_instructor_index_title_page'),
            'titleView' => trans('sia::controllers.SIA_instructor_index_title_view'),
        ];
        $instructors = InstructorResearcher::with(['person', 'user', 'profession'])->paginate(10);
        return view('sia::instructor-researchers.index', compact('view', 'instructors'));
    }

    /**
     * Muestra el formulario para crear un nuevo instructor investigador.
     */
    public function create()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_instructor_create_title_page'),
            'titleView' => trans('sia::controllers.SIA_instructor_create_title_view'),
        ];
        $professions = Profession::orderBy('name', 'ASC')->get();

        return view('sia::instructor-researchers.create', compact('view', 'professions'));
    }

    /**
     * Almacena un nuevo instructor investigador en la base de datos.
     */
    public function store(Request $request)
    {
        $request->merge(['contraseña' => bcrypt($request->input('contraseña'))]);
        $rules = [
            'tipo_documento' => 'required|in:Cédula de ciudadanía,Tarjeta de identidad,Cédula de extranjería,Pasaporte,Documento nacional de identidad,Registro civil',
            'numero_documento' => 'required|numeric|unique:people,document_number,' . ($request->input('person_id') ?: 'NULL'),
            'nombre_completo' => 'required|string|max:255',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'numero_celular' => 'required|numeric|digits:10',
            'profesion' => 'required|exists:professions,name',
            'correo' => 'required|email|unique:users,email',
            'contraseña' => 'required|string|min:8',
            'habilidades_investigacion' => 'required|string',
        ];

        $messages = [
            'tipo_documento.required' => trans('sia::controllers.SIA_instructor_document_type_required'),
            'numero_documento.unique' => trans('sia::controllers.SIA_instructor_document_number_unique'),
            'nombre_completo.required' => trans('sia::controllers.SIA_instructor_full_name_required'),
            'genero.required' => trans('sia::controllers.SIA_instructor_gender_required'),
            'numero_celular.digits' => trans('sia::controllers.SIA_instructor_phone_digits'),
            'profesion.exists' => trans('sia::controllers.SIA_instructor_profession_exists'),
            'correo.unique' => trans('sia::controllers.SIA_instructor_email_unique'),
            'contraseña.min' => trans('sia::controllers.SIA_instructor_password_min'),
            'habilidades_investigacion.required' => trans('sia::controllers.SIA_instructor_research_skills_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request) {
            $personId = $request->input('person_id');
            if (!$personId) {
                $nameParts = preg_split('/\s+/', trim($request->input('nombre_completo')));
                $firstName = $nameParts[0] ?? '';
                $firstLastName = $nameParts[1] ?? '';
                $secondLastName = $nameParts[2] ?? '';

                $person = Person::create([
                    'document_type' => $request->input('tipo_documento'),
                    'document_number' => $request->input('numero_documento'),
                    'first_name' => $firstName,
                    'first_last_name' => $firstLastName,
                    'second_last_name' => $secondLastName,
                    'gender' => $request->input('genero'),
                    'telephone1' => $request->input('numero_celular'),
                ]);
                $personId = $person->id;
            }

            $user = User::create([
                'nickname' => str_replace(' ', '', $firstName . $firstLastName),
                'person_id' => $personId,
                'email' => $request->input('correo'),
                'password' => $request->input('contraseña'),
            ]);

            $profession = Profession::where('name', $request->input('profesion'))->first();
            $instructor = InstructorResearcher::create([
                'person_id' => $personId,
                'profession_id' => $profession->id,
                'user_id' => $user->id,
                'research_skills' => $request->input('habilidades_investigacion'),
            ]);

            $instructor->syncDefaultRole();
        });

        return redirect()->route('sia.admin.instructor-researchers.index')
            ->with('message_sia', trans('sia::controllers.SIA_instructor_store_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Muestra el formulario para editar un instructor investigador existente.
     */
    public function edit(InstructorResearcher $instructor)
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_instructor_edit_title_page'),
            'titleView' => trans('sia::controllers.SIA_instructor_edit_title_view'),
        ];
        $professions = Profession::orderBy('name', 'ASC')->get();

        return view('sia::instructor-researchers.edit', compact('view', 'instructor', 'professions'));
    }

    /**
     * Actualiza un instructor investigador en la base de datos.
     */
    public function update(Request $request, InstructorResearcher $instructor)
    {
        $rules = [
            'tipo_documento' => 'required|in:Cédula de ciudadanía,Tarjeta de identidad,Cédula de extranjería,Pasaporte,Documento nacional de identidad,Registro civil',
            'numero_documento' => 'required|numeric|unique:people,document_number,' . $instructor->person->id,
            'nombre_completo' => 'required|string|max:255',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'numero_celular' => 'required|numeric|digits:10',
            'profesion' => 'required|exists:professions,name',
            'correo' => 'required|email|unique:users,email,' . $instructor->user->id,
            'contraseña' => 'nullable|string|min:8',
            'habilidades_investigacion' => 'required|string',
        ];

        $messages = [
            'tipo_documento.required' => trans('sia::controllers.SIA_instructor_document_type_required'),
            'numero_documento.unique' => trans('sia::controllers.SIA_instructor_document_number_unique'),
            'nombre_completo.required' => trans('sia::controllers.SIA_instructor_full_name_required'),
            'genero.required' => trans('sia::controllers.SIA_instructor_gender_required'),
            'numero_celular.digits' => trans('sia::controllers.SIA_instructor_phone_digits'),
            'profesion.exists' => trans('sia::controllers.SIA_instructor_profession_exists'),
            'correo.unique' => trans('sia::controllers.SIA_instructor_email_unique'),
            'contraseña.min' => trans('sia::controllers.SIA_instructor_password_min'),
            'habilidades_investigacion.required' => trans('sia::controllers.SIA_instructor_research_skills_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $instructor) {
            $nameParts = preg_split('/\s+/', trim($request->input('nombre_completo')));
            $firstName = $nameParts[0] ?? '';
            $firstLastName = $nameParts[1] ?? '';
            $secondLastName = $nameParts[2] ?? '';

            $instructor->person->update([
                'document_type' => $request->input('tipo_documento'),
                'document_number' => $request->input('numero_documento'),
                'first_name' => $firstName,
                'first_last_name' => $firstLastName,
                'second_last_name' => $secondLastName,
                'gender' => $request->input('genero'),
                'telephone1' => $request->input('numero_celular'),
            ]);

            $password = $request->filled('contraseña') ? bcrypt($request->input('contraseña')) : $instructor->user->password;
            $instructor->user->update([
                'email' => $request->input('correo'),
                'password' => $password,
            ]);

            $profession = Profession::where('name', $request->input('profesion'))->first();
            $instructor->update([
                'profession_id' => $profession->id,
                'research_skills' => $request->input('habilidades_investigacion'),
            ]);

            $instructor->syncDefaultRole();
        });

        return redirect()->route('sia.admin.instructor-researchers.index')
            ->with('message_sia', trans('sia::controllers.SIA_instructor_update_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Elimina un instructor investigador de la base de datos.
     */
    public function destroy(InstructorResearcher $instructor)
    {
        if ($instructor->remove()) {
            return redirect()->route('sia.admin.instructor-researchers.index')
                ->with('message_sia', trans('sia::controllers.SIA_instructor_destroy_success'))
                ->with('message_sia_type', 'success');
        }
        return redirect()->route('sia.admin.instructor-researchers.index')
            ->with('message_sia', trans('sia::controllers.SIA_instructor_destroy_error'))
            ->with('message_sia_type', 'error');
    }

    /**
     * Verifica si un número de documento ya existe.
     */
    public function checkDocument(Request $request)
    {
        $documentNumber = $request->input('numero_documento');
        $person = Person::where('document_number', $documentNumber)->first();

        return response()->json([
            'exists' => $person ? true : false,
            'person_id' => $person ? $person->id : null,
        ]);
    }
}