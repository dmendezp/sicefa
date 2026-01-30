<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Category;

class HomeController extends Controller
{
    public function welcome()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->person->id;

            if (Session::has('passwords.' . $user_id)) {
                $session_password = Session::get('passwords.' . $user_id);

                if ($user->password === $session_password) {
                    return redirect(route('cefa.password.change.index'));
                }
            }
        }

        $apps = App::all();

        /*
        |--------------------------------------------------------------------------
        | 1) ID categoría a ELIMINAR: Derivados de café - Agroindustria
        |--------------------------------------------------------------------------
        */
        $excludedCategoryId = Category::whereRaw("
            LOWER(
                REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(name,'Á','A'),'É','E'),'Í','I'),'Ó','O'),'Ú','U')
            ) LIKE ?
        ", ['%derivados%cafe%agroindustria%'])
        ->orWhereRaw("
            LOWER(
                REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(name,'á','a'),'é','e'),'í','i'),'ó','o'),'ú','u')
            ) LIKE ?
        ", ['%derivados%cafe%'])
        ->value('id');

        /*
        |--------------------------------------------------------------------------
        | 2) Inventarios con stock (>0), excluyendo Derivados de café
        |--------------------------------------------------------------------------
        */
        $inventories = Inventory::with('element.category')
            ->where('amount', '>', 0)
            ->whereHas('element', function ($q) use ($excludedCategoryId) {
                if ($excludedCategoryId) {
                    $q->where('category_id', '<>', $excludedCategoryId);
                }
            })
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->unique('element_id')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | 3) Categorías que SÍ se muestran (todas menos Derivados de café)
        |--------------------------------------------------------------------------
        */
        $categories = Category::whereHas('elements.inventories', function ($q) {
                $q->where('amount', '>', 0);
            })
            ->when($excludedCategoryId, function ($q) use ($excludedCategoryId) {
                $q->where('id', '<>', $excludedCategoryId);
            })
            ->orderBy('name', 'ASC')
            ->get();

        return view('welcome', [
            'apps'        => $apps,
            'inventories' => $inventories,
            'categories'  => $categories
        ]);
    }

    public function developers()
    {
        return view('designners');
    }

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->person->id;

            if (Session::has('passwords.' . $user_id)) {
                $session_password = Session::get('passwords.' . $user_id);

                if ($user->password === $session_password) {
                    return redirect(route('cefa.password.change.index'));
                }
            }
        }

        $apps = App::all();

        return view('home', [
            'apps' => $apps
        ]);
    }
}
