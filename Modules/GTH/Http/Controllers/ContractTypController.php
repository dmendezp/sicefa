<?php
namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ContractorType;


class ContractTypController extends Controller
{
    //Funcion mostrar vista tipo de empleado
    public function viewcontractortypes()
    {
        $contractortype = ContractorType::get();
        return view('gth::types_contractor.contractortype',['contractortype'=> $contractortype]);
    }


    public function postcreatecontractortypes(Request $request)
    {
        $contractorType = new ContractorType;
        $contractorType->name = $request->input('name');
        $contractorType->save();

        return redirect()->route('gth.contractortypes.view');
    }


    public function updatecontractortypes(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255', // Agrega más reglas según tus necesidades
            // Agrega más campos y reglas según tus necesidades
        ]);

        $contractorType = ContractorType::findOrFail($id);

        // Actualizar los campos necesarios
        $contractorType->name = $request->input('name');
        // Actualiza otros campos si es necesario

        $contractorType->save();

        // Redirigir a donde quieras después de la actualización
        return redirect()->route('gth.contractortypes.view')->with('success', 'Tipo de Contrato actualizado exitosamente.');
    }

    public function showContractorTypes($id)
    {
        $contractorType = ContractorType::find($id);
        return view('types_contractor.contractortype', ['contractorType' => $contractorType]);
    }


    public function deleteContractorTypes($id)
    {
        try {
            $contractorType = ContractorType::findOrFail($id);
            $contractorType->delete();

            return redirect()->route('gth.contractortypes.view')->with('success', 'Tipo de contratista eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('gth.contractortypes.view')->with('error', 'No se pudo eliminar el tipo de contratista.');
        }
    }

}