<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Modules\SIGAC\Entities\InstructorProgram;
use Illuminate\Support\Facades\DB;
use Modules\SIGAC\Entities\InstructorProgramPerson;
use Modules\SIGAC\Entities\EnvironmentInstructorProgram;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KeyController extends Controller
{
    //Iniciar sesion
    public function login(Request $request)
    {

        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);


        if (!Auth::attempt($attrs)) {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }


        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    public function search_instructor_program(Request $request)
    {
        $person_id = $request->query('person_id');
        $date = $request->query('date');
        $current_time = Carbon::now()->format('H:i:s'); // Obtener la hora actual en formato H:i:s

        $instructor_program = InstructorProgramPerson::with(['instructor_program.environment_instructor_programs.environment.keys', 'person'])
            ->where('person_id', $person_id)
            ->whereHas('instructor_program', function ($query) use ($date, $current_time) {
                $query->where('date', $date)
                    ->where('start_time', '<=', $current_time)
                    ->where('end_time', '>=', $current_time);
            })
            ->first();

        if (!$instructor_program) {
            return response()->json([
                'message' => 'No hay programación para el instructor en la fecha y hora actual.',
            ], 404);
        }

        // Obtener detalles de la llave y ambiente
        $environmentInstructorProgram = $instructor_program->instructor_program->environment_instructor_programs->first();
        $environment = $environmentInstructorProgram->environment ?? null;
        $key = $environment ? $environment->keys->first() : null;

        // Verificar si la llave ya ha sido solicitada y no ha sido devuelta
        $existingKeyLog = DB::table('key_logs')
            ->where('key_id', $key->id)
            ->where('person_id', $person_id)
            ->whereNull('returned_at')
            ->first();

        if ($existingKeyLog) {
            return response()->json([
                'message' => 'La llave ya ha sido solicitada y no ha sido devuelta.',
            ], 400);
        }

        // Registrar la entrega de la llave
        DB::table('key_logs')->insert([
            'key_id' => $key->id,
            'person_id' => $person_id,
            'issued_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'Mensaje' => 'La llave ha sido entregada exitosamente.',
            'Persona' => $instructor_program->person->first_name,
            'Llave Nº' => $key->key_code,
            'Posicion' => $key->position,
            'Ambiente' => $environment->name,
        ], 200);
    }

    public function check_authorization(Request $request)
    {
        $person_id = $request->query('person_id');

        // Verificar si la persona está autorizada en la tabla intermedia
        $authorized = DB::table('authorized_personnels')->where('person_id', $person_id)->exists();

        if ($authorized) {
            return response()->json(['message' => 'Personal autorizado para la solicitud de llaves'], 200);
        } else {
            return response()->json(['message' => 'Personal no autorizado'], 403);
        }
    }
    //Consulta para solicitar una llave
    public function request_key_program(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'person_id' => 'required|integer',
            'key_id' => 'required|integer',
        ]);

        $person_id = $request->input('person_id');
        $key_id = $request->input('key_id');

        // Verificar si la persona está autorizada
        $authorized = DB::table('authorized_personnels')->where('person_id', $person_id)->exists();

        if (!$authorized) {
            return response()->json(['message' => 'Personal no autorizado'], 403);
        }

        // Verificar si la llave ya ha sido solicitada
        $keyLog = DB::table('key_logs')->where('key_id', $key_id)->whereNull('returned_at')->exists();

        if ($keyLog) {
            return response()->json(['message' => 'La llave ya ha sido solicitada'], 400);
        }

        // Registrar la entrega de la llave
        DB::table('key_logs')->insert([
            'person_id' => $person_id,
            'key_id' => $key_id,
            'issued_at' => now(),
        ]);

        return response()->json(['message' => 'LLave entregada correctamente'], 200);
    }

    public function return_key(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'key_id' => 'required|integer',
        ]);

        $key_id = $request->input('key_id');

        // Verificar si la llave está actualmente asignada sin haber sido devuelta
        $keyLog = DB::table('key_logs')
            ->where('key_id', $key_id)
            ->whereNull('returned_at')
            ->first();

        if (!$keyLog) {
            return response()->json(['message' => 'La llave no se encuentra asignada o ya ha sido devuelta'], 400);
        }

        // Registrar la devolución de la llave
        DB::table('key_logs')
            ->where('id', $keyLog->id)
            ->update(['returned_at' => now()]);

        return response()->json(['message' => 'La llave ha sido devuelta exitosamente'], 200);
    }

    public function get_current_program(Request $request)
    {
        $date = $request->query('date');
        $current_time = Carbon::now()->format('H:i:s'); // Obtener la hora actual en formato H:i:s

        // Obtener las programaciones que coincidan con la fecha especificada y la hora actual
        $current_programs = InstructorProgramPerson::with(['instructor_program.environment_instructor_programs.environment', 'person'])
            ->whereHas('instructor_program', function ($query) use ($date, $current_time) {
                $query->where('date', $date);
            })
            ->get();

        if ($current_programs->isEmpty()) {
            return response()->json([
                'message' => 'No hay programación para el instructor en la fecha y hora actual.',
            ], 404);
        }

        $messages = [];

        foreach ($current_programs as $program) {
            $person_name = $program->person->first_name;
            $environment = $program->instructor_program->environment_instructor_programs->first()->environment->name;
            $start_time = $program->instructor_program->start_time;
            $end_time = $program->instructor_program->end_time;

            $messages[] = "Persona: $person_name, Ambiente: $environment, Tiempo de Programación: $start_time - $end_time";
        }

        return response()->json([
            'message' => $messages,
        ], 200);
    }




    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success.'
        ], 200);
    }
}
