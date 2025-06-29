<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = DB::table('categorias')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        DB::table('categorias')->insert([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit($id)
    {
        $categoria = DB::table('categorias')->where('id', $id)->first();
        if (!$categoria) {
            abort(404, 'Categoría no encontrada.');
        }
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        DB::table('categorias')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy($id)
    {
        // Verificar si hay productos usando esta categoría
        $uso = DB::table('productos')->where('categoria_id', $id)->exists();
        if ($uso) {
            return redirect()->route('admin.categorias.index')->with('error', 'No se puede eliminar la categoría porque está en uso.');
        }

        DB::table('categorias')->where('id', $id)->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
