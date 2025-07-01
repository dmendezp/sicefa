<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\Administrator;
use Modules\SICA\Entities\Person;
use App\Models\User;
use Modules\SIGAC\Entities\Profession;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Muestra la lista de administradores.
     */
    public function index()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_admin_index_title_page'),
            'titleView' => trans('sia::controllers.SIA_admin_index_title_view'),
        ];
        $administrators = Administrator::with(['person', 'user', 'profession'])->paginate(10);
        return view('sia::administrators.index', compact('view', 'administrators'));
    }

    /**
     * Muestra el formulario para crear un nuevo administrador.
     */
    public function create()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_admin_create_title_page'),
            'titleView' => trans('sia::controllers.SIA_admin_create_title_view'),
        ];
        $professions = Profession::orderBy('name', 'ASC')->get();

        return view('sia::administrators.create', compact('view', 'professions'));
    }

    /**
     * Almacena un nuevo administrador en la base de datos.
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
            'tipo_documento.required' => trans('sia::controllers.SIA_admin_document_type_required'),
            'numero_documento.unique' => trans('sia::controllers.SIA_admin_document_number_unique'),
            'nombre_completo.required' => trans('sia::controllers.SIA_admin_full_name_required'),
            'genero.required' => trans('sia::controllers.SIA_admin_gender_required'),
            'numero_celular.digits' => trans('sia::controllers.SIA_admin_phone_digits'),
            'profesion.exists' => trans('sia::controllers.SIA_admin_profession_exists'),
            'correo.unique' => trans('sia::controllers.SIA_admin_email_unique'),
            'contraseña.min' => trans('sia::controllers.SIA_admin_password_min'),
            'habilidades_investigacion.required' => trans('sia::controllers.SIA_admin_research_skills_required'),
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
            $administrator = Administrator::create([
                'person_id' => $personId,
                'profession_id' => $profession->id,
                'user_id' => $user->id,
                'research_skills' => $request->input('habilidades_investigacion'),
            ]);

            $administrator->syncDefaultRole();
        });

        return redirect()->route('sia.admin.administrators.index')
            ->with('message_sia', trans('sia::controllers.SIA_admin_store_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Muestra el formulario para editar un administrador existente.
     */
    public function edit(Administrator $administrator)
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_admin_edit_title_page'),
            'titleView' => trans('sia::controllers.SIA_admin_edit_title_view'),
        ];
        $professions = Profession::orderBy('name', 'ASC')->get();

        return view('sia::administrators.edit', compact('view', 'administrator', 'professions'));
    }

    /**
     * Actualiza un administrador en la base de datos.
     */
    public function update(Request $request, Administrator $administrator)
    {
        $rules = [
            'tipo_documento' => 'required|in:Cédula de ciudadanía,Tarjeta de identidad,Cédula de extranjería,Pasaporte,Documento nacional de identidad,Registro civil',
            'numero_documento' => 'required|numeric|unique:people,document_number,' . $administrator->person->id,
            'nombre_completo' => 'required|string|max:255',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'numero_celular' => 'required|numeric|digits:10',
            'profesion' => 'required|exists:professions,name',
            'correo' => 'required|email|unique:users,email,' . $administrator->user->id,
            'contraseña' => 'nullable|string|min:8',
            'habilidades_investigacion' => 'required|string',
        ];

        $messages = [
            'tipo_documento.required' => trans('sia::controllers.SIA_admin_document_type_required'),
            'numero_documento.unique' => trans('sia::controllers.SIA_admin_document_number_unique'),
            'nombre_completo.required' => trans('sia::controllers.SIA_admin_full_name_required'),
            'genero.required' => trans('sia::controllers.SIA_admin_gender_required'),
            'numero_celular.digits' => trans('sia::controllers.SIA_admin_phone_digits'),
            'profesion.exists' => trans('sia::controllers.SIA_admin_profession_exists'),
            'correo.unique' => trans('sia::controllers.SIA_admin_email_unique'),
            'contraseña.min' => trans('sia::controllers.SIA_admin_password_min'),
            'habilidades_investigacion.required' => trans('sia::controllers.SIA_admin_research_skills_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $administrator) {
            $nameParts = preg_split('/\s+/', trim($request->input('nombre_completo')));
            $firstName = $nameParts[0] ?? '';
            $firstLastName = $nameParts[1] ?? '';
            $secondLastName = $nameParts[2] ?? '';

            $administrator->person->update([
                'document_type' => $request->input('tipo_documento'),
                'document_number' => $request->input('numero_documento'),
                'first_name' => $firstName,
                'first_last_name' => $firstLastName,
                'second_last_name' => $secondLastName,
                'gender' => $request->input('genero'),
                'telephone1' => $request->input('numero_celular'),
            ]);

            $password = $request->filled('contraseña') ? bcrypt($request->input('contraseña')) : $administrator->user->password;
            $administrator->user->update([
                'email' => $request->input('correo'),
                'password' => $password,
            ]);

            $profession = Profession::where('name', $request->input('profesion'))->first();
            $administrator->update([
                'profession_id' => $profession->id,
                'research_skills' => $request->input('habilidades_investigacion'),
            ]);

            $administrator->syncDefaultRole();
        });

        return redirect()->route('sia.admin.administrators.index')
            ->with('message_sia', trans('sia::controllers.SIA_admin_update_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Elimina un administrador de la base de datos.
     */
    public function destroy(Administrator $administrator)
    {
        if ($administrator->remove()) {
            return redirect()->route('sia.admin.administrators.index')
                ->with('message_sia', trans('sia::controllers.SIA_admin_destroy_success'))
                ->with('message_sia_type', 'success');
        }
        return redirect()->route('sia.admin.administrators.index')
            ->with('message_sia', trans('sia::controllers.SIA_admin_destroy_error'))
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