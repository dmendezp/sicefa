<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        // Almacena la URL actual en la sesión
        $request->session()->put('url.intended', $request->redirect);

        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        // Redirige al usuario a la URL previa o a la HOME si no hay una URL previa
        return redirect()->intended($this->redirectPath());
    }
}
