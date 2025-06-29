<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'clave' => 'required',
        ]);

        $usuario = $request->input('usuario');
        $clave = $request->input('clave');

        $user = DB::table('usuarios')
            ->where('nombre', $usuario)
            ->orWhere('correo', $usuario)
            ->first();

        if ($user && Hash::check($clave, $user->contrasena)) {
            session([
                'usuario' => [
                    'id' => $user->id,
                    'nombre' => $user->nombre,
                    'rol' => $user->rol
                ]
            ]);

            if ($user->rol === 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/');
            }
        } else {
            return back()->with('error', 'Usuario o contraseña incorrectos.');
        }
    }

    public function logout()
    {
        session()->forget('usuario');
        return redirect('/');
    }
    
}

