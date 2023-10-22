<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\BenefitTypeOfBenefit;
use Modules\BIENESTAR\Entities\TypeOfBenefit;
use Modules\BIENESTAR\Entities\Benefit;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class BenefitsTypesOfBenefitsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function benefitstypeofbenefits()
    {
        $benefitstypeofbenefits = BenefitTypeOfBenefit::all();
        $benefits = Benefit::all();
        $typeOfBenefits = TypeOfBenefit::all();

        return view('bienestar::benefitstypeofbenefits', compact('benefitstypeofbenefits', 'benefits', 'typeOfBenefits'));
    }

  

    
    public function updateInline(Request $request)
    {
        $benefitId = $request->input('benefit_id');
        $typeId = $request->input('type_of_benefit_id');
        $isChecked = $request->input('checked');
        //$recordId = $request->input('record_id'); 
        
        
        // Consultar registro 
        $record = BenefitTypeOfBenefit::withTrashed()
                    ->where('benefit_id', $benefitId)
                    ->where('type_of_benefit_id', $typeId)
                    ->first();
        
        // Validar si existe
        if($record){
            if($isChecked == 'true'){
                if($record->trashed()){
                    $record->restore();
                }
            }else{
                $record->delete();
            }
        }else{
            // Realizar registro
            BenefitTypeOfBenefit::create([
                'benefit_id' => $benefitId,
                'type_of_benefit_id' => $typeId,
            ]);
        }


    
    
        // Responder con una confirmación y el ID del registro (puede ser nulo si no se crea/elimina ningún registro)
        return response()->json(['success' => 'Actualización en línea exitosa.', 'record' => $record], 200);   
    }
    

}
