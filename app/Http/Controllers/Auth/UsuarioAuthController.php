<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('strNombreUsuario', 'strContrasena');

        if (Auth::attempt(['strNombreUsuario' => $credentials['strNombreUsuario'], 'password' => $credentials['strContrasena']])) {
            return redirect()->intended('/usuarios');
        }

        return back()->withErrors([
            'login_error' => 'Las credenciales no coinciden con nuestros registros.'
        ]);
    }
}
