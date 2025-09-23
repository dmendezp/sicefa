<?php

namespace Modules\GDMF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Element;
use Modules\SIGAC\Entities\TrainingMaterial;
use Modules\SIGAC\Entities\TrainingProject;

class TrainingMaterialController extends Controller
{
   public function index(Request $request)
    {
        $projects = TrainingProject::pluck('name', 'id');
        $elements = Element::pluck('name', 'id');
        $selectedProject = null;
        $assignedMaterials = [];

        $selectedProjectId = $request->input('training_project_id');
        if ($selectedProjectId) {
            $selectedProject = TrainingProject::find($selectedProjectId);
            $assignedMaterials = TrainingMaterial::with('element')
                ->where('training_project_id', $selectedProjectId)
                ->get();
        }

        return view('gdmf::curriculum_planning.training_project.manage_materials')->with([
            'titlePage' => trans('Asignaicon de materiales'),
            'titleView' => trans('Asignaicon de materiales'),
            'projects' => $projects,
            'elements' => $elements,
            'selectedProjectId' => $selectedProjectId,
            'selectedProject' => $selectedProject,
            'assignedMaterials' => $assignedMaterials,
        ]);;;
    }

    /**
     * Asignar un material a un proyecto
     */
    public function store(Request $request)
    {
        $request->validate([
            'training_project_id' => 'required|exists:training_projects,id',
            'element_id' => 'required|exists:elements,id',
        ]);

        // Verificar si ya está asignado
        $exists = TrainingMaterial::where('training_project_id', $request->training_project_id)
            ->where('element_id', $request->element_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'El material ya ha sido asignado a este proyecto.');
        }

        // Asignar material
        TrainingMaterial::create([
            'training_project_id' => $request->training_project_id,
            'element_id' => $request->element_id,
        ]);

        return redirect()->back()->with('success', 'Material asignado correctamente.');
    }

    /**
     * Eliminar la asignación de un material
     */
    public function destroy($id)
    {
        $material = TrainingMaterial::findOrFail($id);
        $material->delete();

        return redirect()->back()->with('success', 'Material eliminado correctamente.');
    }
}
