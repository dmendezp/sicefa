<?php

namespace Modules\AGROCEFA\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SICA\Entities\Apprentice;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(!Auth::attempt($attrs))
        {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    public function user()
    {

        // Limpiar la variable 'selectedUnitName'
        Session::forget('selectedUnitName');

        // Limpiar la variable 'selectedRole'
        Session::forget('selectedRole');

        $unitIds = [];

        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Obtiene el usuario autenticado
            $user = Auth::user();

            // Obtén el ID del rol del usuario
            $productive_units_role = $user
                ->roles()
                ->with('productive_units')
                ->get();

            // Recorre la colección de roles
            foreach ($productive_units_role as $role) {
                // Accede a la relación "productive_units" en cada rol
                $productiveUnits = $role->productive_units;

                // Recorre las unidades productivas y agrega sus IDs al array
                foreach ($productiveUnits as $unit) {
                    $unitIds[] = $unit->id;
                }
            }

            // Variable para verificar el acceso completo
            $hasFullAccess = false;

            // Recorre la colección de roles
            foreach ($productive_units_role as $role) {
                // Verifica si el rol tiene el atributo 'full_access'
                if ($role->full_access === 'Si' ) {
                   
                    $hasFullAccess = true;
                    break; // Rompe el bucle si se encuentra un rol con acceso completo
                }

            }
            
            if($hasFullAccess === true )
            {
                $productiveUnits = ProductiveUnit::get();
            }
            else {
                $productiveUnits = ProductiveUnit::whereIn('id', $unitIds)->get();
            }

            
            return response([
                'unidades' => $productiveUnits,
            ], 200);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success.'
        ], 200);
    }

    

}