<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Person;

class EnvironmentControlController extends Controller
{
    public function index()
    {
        $titlePage = 'Control de ambientes';
        $titleView = 'Novedades';

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
        ];
        return view('sigac::environment_control.news.index', $data);
    }

    public function authorized_index()
    {
        $titlePage = trans('sigac::environment.Environ_Control');
        $titleView = trans('sigac::environment.Personnel_Authorization');

        $authorizedPersonnels = DB::table('authorized_personnels')->get();
        $roles = DB::table('roles')->pluck('name', 'id');

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'authorizedPersonnels' => $authorizedPersonnels,
            'roles' => $roles,
        ];

        return view('sigac::environment_control.authorized_personnels.index', $data);
    }

    public function searchperson(Request $request)
    {
        $term = $request->input('q');

        $persons = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])->get();

        $results = [];
        foreach ($persons as $person) {
            $results[] = [
                'id' => $person->id,
                'text' => $person->first_name . ' ' . $person->first_last_name. ' ' . $person->second_last_name,
            ];
        }

        return response()->json($results);
    }


    // Función para agregar un nuevo registro
    public function authorized_store(Request $request)
    {
        $request->validate([
            'person_id' => 'required|integer|exists:people,id',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        DB::table('authorized_personnels')->insert([
            'person_id' => $request->person_id,
            'role_id' => $request->role_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('sigac.academic_coordination.environment_control.authorized_personnels.authorized_index')->with('success', 'Registro agregado exitosamente');
    }

    // Función para eliminar un registro por ID
    public function authorized_destroy($id)
    {
        $authorizedPersonnel = DB::table('authorized_personnels')->where('id', $id)->first();

        if (!$authorizedPersonnel) {
            return redirect()->route('sigac.academic_coordination.environment_control.authorized_personnels.authorized_index')->with('error', 'Registro no encontrado');
        }

        DB::table('authorized_personnels')->where('id', $id)->delete();

        return redirect()->route('sigac.academic_coordination.environment_control.authorized_personnels.authorized_index')->with('success', 'Registro eliminado exitosamente');
    }
}
