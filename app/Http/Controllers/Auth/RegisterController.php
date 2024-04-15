<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $usucattipoestado = UserType::all(); 
        $usucatestado = Estado::all();
        return view('auth.register', compact('usucattipoestado','usucatestado'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'strNombreUsuario' => ['required', 'string', 'max:255', 'unique:usuusuario'],
            'strContrasena' => ['required', 'string', 'min:8', 'confirmed'],
            'idUsuCatTipoUsuario' => ['required', 'exists:usucattipoestado,id'],
            'idUsuCatEstado' => ['required', 'exists:usucatestado,id'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'strNombreUsuario' => $request->strNombreUsuario,
            'strContrasena' => Hash::make($request->strContrasena),
            'idUsuCatTipoUsuario' => $request->idUsuCatTipoUsuario,
            'idUsuCatEstado' => $request->idUsuCatEstado,
        ]);

        return redirect()->route('usuarios.index')->with('success', '¡Registro exitoso! Por favor, inicia sesión.');
    }
}
