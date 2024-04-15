<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $user = Usuario::where('strNombreUsuario', $request->username)->first();

    if (!$user) {
        return back()->withErrors(['username' => 'El nombre de usuario no existe.']);
    }

    if ($user && Hash::check($request->password, $user->getAuthPassword())) {
        // Realiza la autenticación manualmente si es necesario
        Auth::login($user, $request->filled('remember'));

        // Regenera la sesión para evitar ataques de sesión fija
        $request->session()->regenerate();

        // Redirige al usuario a su dashboard o a cualquier página que desees después del login exitoso
        return redirect()->intended(route('inicio.index'));
    }

    return back()->withErrors([
        'password' => 'La contraseña es incorrecta.',
    ]);
}
public function logout()
{
    Auth::logout();
    return redirect('/');
}
}