<?php
namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\PensionEntity;

class PensionEntitiesController extends Controller
{
    //Funcion mostrar vista tipo de empleado
    public function viewpensionentities()
    {
        $pensionentities = PensionEntity::get();
        return view('gth::pension_entities.pensionentities',['pensionentities'=> $pensionentities]);
    }


    public function postcreatepensionentities(Request $request)
    {
        $pensionEntities = new PensionEntity;
        $pensionEntities->name = $request->input('name');
        $pensionEntities->description = $request->input('description');
        $pensionEntities->save();

        return redirect()->route('gth.admin.pensionentities.index');
    }


    public function updatepensionentities(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255', // Agrega más reglas según tus necesidades
            // Agrega más campos y reglas según tus necesidades
        ]);

        $pensionEntities = PensionEntity::findOrFail($id);

        // Actualizar los campos necesarios
        $pensionEntities->name = $request->input('name');
        $pensionEntities->description = $request->input('description');

        // Actualiza otros campos si es necesario

        $pensionEntities->save();

        // Redirigir a donde quieras después de la actualización
        return redirect()->route('gth.admin.pensionentities.index')->with('success', 'Entidad Pension actualizado exitosamente.');
    }

    public function showPensionEntities($id)
    {
        $pensionEntities = PensionEntity::find($id);
        return view('pension_entities.pensionentities', ['pensionEntities' => $pensionEntities]);
    }


    public function deletePensionEntities($id)
    {
        try {
            $pensionEntities = PensionEntity::findOrFail($id);
            $pensionEntities->delete();

            return redirect()->route('gth.admin.pensionentities.index')->with('success', 'La Entidad Pension ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('gth.admin.pensionentities.index')->with('error', 'No se pudo eliminar La Entidad Pension.');
        }
    }

}
