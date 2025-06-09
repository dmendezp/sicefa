<?php

namespace Modules\SIA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
use App\Models\User;
use Modules\SICA\Entities\Person;
use Modules\SIA\Entities\ApprenticeResearcher;
use Modules\SICA\Entities\Role;
use Illuminate\Support\Facades\Log;

class ApprenticeResearcherController extends Controller
{
    public function index()
    {
        $apprentices = ApprenticeResearcher::with(['user', 'person', 'program', 'course', 'group', 'project', 'defaultRole'])->get();
        return view('sia::apprentice_researchers.index', compact('apprentices'));
    }

    public function create()
    {
        return view('sia::apprentice_researchers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nickname' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'document_type' => 'required|in:Cédula de ciudadanía,Tarjeta de identidad,Cédula de extranjería,Pasaporte,Documento nacional de identidad,Registro civil',
            'document_number' => 'required|numeric|unique:people',
            'first_name' => 'required|string|max:255',
            'first_last_name' => 'required|string|max:255',
            'second_last_name' => 'nullable|string|max:255',
            'eps_id' => 'required|exists:e_p_s,id',
            'telephone1' => 'required|numeric',
            'population_group_id' => 'required|exists:population_groups,id',
            'pension_entity_id' => 'required|exists:pension_entities,id',
            'program_id' => 'required|exists:programs,id',
            'course_id' => 'required|exists:courses,id',
            'group_id' => 'required|exists:groups,id',
            'project_id' => 'nullable|exists:projects,id',
            'institution' => 'required|string|max:100',
        ]);

        try {
            // Create Person record
            $person = Person::create([
                'document_type' => $validated['document_type'],
                'document_number' => $validated['document_number'],
                'first_name' => $validated['first_name'],
                'first_last_name' => $validated['first_last_name'],
                'second_last_name' => $validated['second_last_name'],
                'eps_id' => $validated['eps_id'],
                'telephone1' => $validated['telephone1'],
                'population_group_id' => $validated['population_group_id'],
                'pension_entity_id' => $validated['pension_entity_id'],
            ]);

            // Create User record
            $user = User::create([
                'nickname' => $validated['nickname'],
                'person_id' => $person->id,
                'email' => $validated['email'],
            ]);

            // Get the default 'Aprendiz Investigador' role (ID 41)
            $defaultRole = Role::find(41); // ID 41 corresponds to "Aprendiz Investigador"

            // Create Apprentice Researcher record with default role
            $apprentice = ApprenticeResearcher::create([
                'user_id' => $user->id,
                'person_id' => $person->id,
                'program_id' => $validated['program_id'],
                'course_id' => $validated['course_id'],
                'group_id' => $validated['group_id'],
                'project_id' => $validated['project_id'],
                'institution' => $validated['institution'],
                'default_role_id' => $defaultRole->id,
            ]);

            // Assign the role to the user via role_user
            $user->roles()->sync([$defaultRole->id]);

            Log::info('Aprendiz investigador registrado: ', ['user_id' => $user->id, 'person_id' => $person->id]);

            return redirect()->route('sia.apprentice_researchers.index')
                ->with('message', 'Aprendiz investigador registrado exitosamente.')
                ->with('typealert', 'success');
        } catch (\Exception $e) {
            Log::error('Error al registrar aprendiz investigador: ' . $e->getMessage());
            return redirect()->back()
                ->with('message', 'Error al registrar el aprendiz investigador: ' . $e->getMessage())
                ->with('typealert', 'danger')
                ->withInput();
        }
    }

    public function edit($id)
    {
        $apprentice = ApprenticeResearcher::with(['user', 'person', 'program', 'course', 'group', 'project', 'defaultRole'])->findOrFail($id);
        return view('sia::apprentice_researchers.edit', compact('apprentice'));
    }

    public function update(Request $request, $id)
    {
        $apprentice = ApprenticeResearcher::findOrFail($id);
        $user = $apprentice->user;
        $person = $apprentice->person;

        $validated = $request->validate([
            'nickname' => 'required|string|max:255|unique:users,nickname,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'document_type' => 'required|in:Cédula de ciudadanía,Tarjeta de identidad,Cédula de extranjería,Pasaporte,Documento nacional de identidad,Registro civil',
            'document_number' => 'required|numeric|unique:people,document_number,' . $person->id,
            'first_name' => 'required|string|max:255',
            'first_last_name' => 'required|string|max:255',
            'second_last_name' => 'nullable|string|max:255',
            'eps_id' => 'required|exists:e_p_s,id',
            'telephone1' => 'required|numeric',
            'population_group_id' => 'required|exists:population_groups,id',
            'pension_entity_id' => 'required|exists:pension_entities,id',
            'program_id' => 'required|exists:programs,id',
            'course_id' => 'required|exists:courses,id',
            'group_id' => 'required|exists:groups,id',
            'project_id' => 'nullable|exists:projects,id',
            'institution' => 'required|string|max:100',
        ]);

        try {
            // Update Person
            $person->update([
                'document_type' => $validated['document_type'],
                'document_number' => $validated['document_number'],
                'first_name' => $validated['first_name'],
                'first_last_name' => $validated['first_last_name'],
                'second_last_name' => $validated['second_last_name'],
                'eps_id' => $validated['eps_id'],
                'telephone1' => $validated['telephone1'],
                'population_group_id' => $validated['population_group_id'],
                'pension_entity_id' => $validated['pension_entity_id'],
            ]);

            // Update User
            $user->update([
                'nickname' => $validated['nickname'],
                'email' => $validated['email'],
            ]);

            // Get the default 'Aprendiz Investigador' role (ID 41)
            $defaultRole = Role::find(41); // ID 41 corresponds to "Aprendiz Investigador"

            // Update Apprentice Researcher with default role
            $apprentice->update([
                'program_id' => $validated['program_id'],
                'course_id' => $validated['course_id'],
                'group_id' => $validated['group_id'],
                'project_id' => $validated['project_id'],
                'institution' => $validated['institution'],
                'default_role_id' => $defaultRole->id,
            ]);

            // Sync the role with the user
            $user->roles()->sync([$defaultRole->id]);

            Log::info('Aprendiz investigador actualizado: ', ['user_id' => $user->id, 'person_id' => $person->id]);

            return redirect()->route('sia.apprentice_researchers.index')
                ->with('message', 'Aprendiz investigador actualizado exitosamente.')
                ->with('typealert', 'success');
        } catch (\Exception $e) {
            Log::error('Error al actualizar aprendiz investigador: ' . $e->getMessage());
            return redirect()->back()
                ->with('message', 'Error al actualizar el aprendiz investigador: ' . $e->getMessage())
                ->with('typealert', 'danger')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $apprentice = ApprenticeResearcher::findOrFail($id);
            $apprentice->delete(); // This will cascade to users and people due to onDelete('cascade')

            Log::info('Aprendiz investigador eliminado: ', ['id' => $id]);

            return redirect()->route('sia.apprentice_researchers.index')
                ->with('message', 'Aprendiz investigador eliminado exitosamente.')
                ->with('typealert', 'success');
        } catch (\Exception $e) {
            Log::error('Error al eliminar aprendiz investigador: ' . $e->getMessage());
            return redirect()->back()
                ->with('message', 'Error al eliminar el aprendiz investigador: ' . $e->getMessage())
                ->with('typealert', 'danger');
        }
    }
}