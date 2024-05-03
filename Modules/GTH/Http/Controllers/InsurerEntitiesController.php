<?php
namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\InsurerEntity;

class InsurerEntitiesController extends Controller
{
    //Funcion mostrar vista tipo de empleado
    public function viewinsurerentities()
    {
        $insurerentities = InsurerEntity::get();
        return view('gth::insurer_entities.insurerentities',['insurerentities'=> $insurerentities]);
    }


    public function postcreateinsurerentities(Request $request)
    {
        $insurerEntities = new InsurerEntity;
        $insurerEntities->name = $request->input('name');
        $insurerEntities->description = $request->input('description');
        $insurerEntities->save();

        return redirect()->route('gth.admin.insurerentities.index');
    }


    public function updateinsurerentities(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255', // Agrega más reglas según tus necesidades
            // Agrega más campos y reglas según tus necesidades
        ]);

        $insurerEntities = InsurerEntity::findOrFail($id);

        // Actualizar los campos necesarios
        $insurerEntities->name = $request->input('name');
        $insurerEntities->description = $request->input('description');

        // Actualiza otros campos si es necesario

        $insurerEntities->save();

        // Redirigir a donde quieras después de la actualización
        return redirect()->route('gth.admin.insurerentities.index')->with('success', trans('gth::menu.Insurance Entity successfully updated.'));
    }

    public function showInsurerEntities($id)
    {
        $insurerEntities = InsurerEntity::find($id);
        return view('insurer_entities.insurerentities', ['insurerEntities' => $insurerEntities]);
    }


    public function deleteInsurerEntities($id)
    {
        try {
            $insurerEntities = InsurerEntity::findOrFail($id);
            $insurerEntities->delete();

            return redirect()->route('gth.admin.insurerentities.index')->with('success', trans('gth::menu.The Insurance Entity has been deleted successfully.'));
        } catch (\Exception $e) {
            return redirect()->route('gth.admin.insurerentities.index')->with('error', trans('gth::menu.The Insurance Entity could not be deleted'));
        }
    }

}
