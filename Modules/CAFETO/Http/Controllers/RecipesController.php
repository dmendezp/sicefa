<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\AGROINDUSTRIA\Entities\Formulation;

class RecipesController extends Controller
{

    /* Vista principal de recetas */
    public function index()
    {
        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_recipes_index_title_page'),
            'titleView' => trans('cafeto::controllers.CAFETO_recipes_index_title_view')
        ];
        $formulations = PUW::getAppPuw()->productive_unit->formulations()->orderByDesc('updated_at')->get(); // Consultar recetas que pertenecen a la unidad productiva de la aplicación CAFETO
        return view('cafeto::recipes.index', compact('view','formulations'));
    }

    public function create()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_recipes_create_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_recipes_create_title_view')];
        return view('cafeto::recipes.create', compact('view'));
    }

}
