<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Apprentice;

class InscriptionController extends Controller
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
        $Apprentices = Apprentice::with('Apprentice.Person')->get();
        $data = ['title' => 'Inscripción', 'optionsArray' => $optionsArray, 'Apprentices' => $Apprentices];
        return view('senaempresa::Company.Inscription.inscription', $data);
    }
}
