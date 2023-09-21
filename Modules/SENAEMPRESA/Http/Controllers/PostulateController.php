<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\postulate;
use Modules\SICA\Entities\Apprentice;

class PostulateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function inscription()
    {
        $optionsArray = [
            '1' => 'Contador',
            '2' => 'Administrador Talento Humano',
            '3' => 'Administrador Gestion de calidad',
        ];
        $Postulates = postulate::with('Apprentice.Person')->get();
        $Apprentices = Apprentice::all();
        $data = ['title' => 'Inscripción', 'optionsArray' => $optionsArray, 'Apprentices' => $Apprentices, 'Postulates' => $Postulates];
        return view('senaempresa::Company.Inscription.inscription', $data);
    }
}
