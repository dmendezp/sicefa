<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;

class RecipesController extends Controller
{
    public function index()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_recipes_index_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_recipes_index_title_view')];
        return view('cafeto::recipes.index', compact('view'));
    }
}
