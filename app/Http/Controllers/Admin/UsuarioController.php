<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = DB::table('usuarios')->orderBy('id')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'rol' => 'required|in:cliente,admin',
        ]);

        DB::table('usuarios')->where('id', $id)->update([
            'rol' => $request->rol,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Rol actualizado correctamente.');
    }
}
