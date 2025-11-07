<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserManualController extends Controller
{
public function viewusermanual()
    {
        $pdfPath1 = asset('modules/gth/manual/MANUAL DE USUARIO GTH.pdf');


        return view('gth::manual_usuario', compact('pdfPath1'));
    }
}
