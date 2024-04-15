<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Estado; 
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['estado', 'tipoUsuario']);

        if ($request->has('nombre') && $request->nombre != '') {
            $query->where('strNombreUsuario', 'like', '%' . $request->nombre . '%');
        }

            if ($request->has('estado') && $request->estado != '') {
                $query->whereHas('estado', function($q) use ($request) {
                $q->where('id', $request->estado);
            });
        }

        if ($request->has('tipo') && $request->tipo != '') {
            $query->whereHas('tipoUsuario', function($q) use ($request) {
                $q->where('id', $request->tipo);
            });
        }

        $users = $query->get();
        $estados = Estado::all();
        $tipos = UserType::all();

        return view('users.index', compact('users', 'estados', 'tipos'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $estados = Estado::all();
        $tiposUsuarios = UserType::all();
        return view('users.edit', compact('user', 'estados', 'tiposUsuarios')); // Corregido el nombre de la vista
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validación básica para los campos (ajusta según sea necesario)
        $request->validate([
            'strNombreUsuario' => 'required|string|max:255',
            'idUsuCatEstado' => 'required|exists:usucatestado,id',
            'idUsuCatTipoUsuario' => 'required|exists:usucattipoestado,id',
            // Añade la validación para la contraseña actual si se proporciona una nueva contraseña
            'current_password' => ['required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
    
        // Actualiza la información básica del usuario
        $user->strNombreUsuario = $request->strNombreUsuario;
        $user->idUsuCatEstado = $request->idUsuCatEstado;
        $user->idUsuCatTipoUsuario = $request->idUsuCatTipoUsuario;
    
        // Cambia la contraseña si se proporciona una nueva
        if (!empty($request->new_password)) {
            if (Hash::check($request->current_password, $user->strContrasena)) {
                $user->strContrasena = Hash::make($request->new_password);
            } else {
                // Si la contraseña actual no es correcta, redirige con un error.
                return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
            }
        }
    
        $user->save();
    
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
    
}
