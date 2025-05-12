<?php

namespace Modules\SIA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Role;
use Modules\SIA\Entities\ApprenticeResearcher;
use Modules\SIA\Mail\WelcomeApprenticeMail;

class ApprenticeResearcherController extends Controller
{
    public function index()
    {
        return view('sia::index');
    }

    public function create()
    {
        return view('sia::apprentice_researchers.create');
    }

    public function store(Request $request)
    {
        // Validar datos del formulario
        $rules = [
            'nickname' => 'required|string|max:255|unique:users,nickname',
            'email' => 'required|email|max:255|unique:users,email',
            'document_type' => 'required|in:CC,TI,CE',
            'document_number' => 'required|string|max:20|unique:people,document_number',
            'first_name' => 'required|string|max:255',
            'first_last_name' => 'required|string|max:255',
            'second_last_name' => 'nullable|string|max:255',
            'gender' => 'required|in:M,F,O',
            'telephone1' => 'required|string|max:15',
            'personal_email' => 'required|email|max:255',
            'blood_type' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'eps_id' => 'required|exists:e_p_s,id',
            'program_id' => 'required|exists:programs,id',
            'course_id' => 'required|exists:courses,id',
            'group_id' => 'required|exists:groups,id',
            'project_id' => 'nullable|exists:projects,id',
            'institution' => 'nullable|string|max:100',
            'start_date' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with([
                'message' => 'Error en el formulario.',
                'typealert' => 'danger',
            ]);
        }

        // Iniciar transacción
        DB::beginTransaction();
        try {
            // 1. Crear persona
            $person = Person::create([
                'document_type' => $request->document_type,
                'document_number' => $request->document_number,
                'first_name' => $request->first_name,
                'first_last_name' => $request->first_last_name,
                'second_last_name' => $request->second_last_name,
                'gender' => $request->gender,
                'telephone1' => $request->telephone1,
                'personal_email' => $request->personal_email,
                'blood_type' => $request->blood_type,
                'eps_id' => $request->eps_id,
            ]);

            // 2. Crear usuario
            $user = User::create([
                'nickname' => $request->nickname,
                'person_id' => $person->id,
                'email' => $request->email,
            ]);

            // 3. Crear aprendiz investigador
            $apprentice = ApprenticeResearcher::create([
                'user_id' => $user->id,
                'person_id' => $person->id,
                'eps_id' => $request->eps_id,
                'program_id' => $request->program_id,
                'course_id' => $request->course_id,
                'group_id' => $request->group_id,
                'project_id' => $request->project_id,
                'institution' => $request->institution,
                'start_date' => $request->start_date,
            ]);

            // 4. Asignar rol "Aprendiz Investigador" (id 41)
            $role = Role::findOrFail(41); // Validar que el rol exista
            if (!$user->roles()->where('role_id', 41)->exists()) {
                $user->roles()->attach(41, ['created_at' => now(), 'updated_at' => now()]);
            }

            // 5. Obtener contraseña generada desde la sesión
            $password = Session::get('passwords.' . $person->id);
            if (!$password) {
                // Generar contraseña manualmente si no está en la sesión
                $password = ucfirst(strtolower(
                    substr(\Illuminate\Support\Str::ascii($person->first_name), 0, 2) .
                    substr(\Illuminate\Support\Str::ascii($person->first_last_name), 0, 2) .
                    substr($person->document_number, -4)
                ));
            }

            // 6. Enviar correo de bienvenida
            Mail::to($user->email)->send(new WelcomeApprenticeMail($user, $password));

            // Confirmar transacción
            DB::commit();

            return redirect()->route('sia.apprentice_researchers.index')->with([
                'message' => 'Aprendiz registrado exitosamente.',
                'typealert' => 'success',
            ]);
        } catch (\Exception $e) {
            // Revertir transacción
            DB::rollBack();
            \Log::error('Error al registrar aprendiz: ' . $e->getMessage());
            return back()->with([
                'message' => 'Error al registrar aprendiz: ' . $e->getMessage(),
                'typealert' => 'danger',
            ])->withInput();
        }
    }

    public function show($id)
    {
        return view('sia::show');
    }

    public function edit($id)
    {
        return view('sia::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}