<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = DB::table('productos')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function edit($id)
    {
        $producto = DB::table('productos')->where('id', $id)->first();
        if (!$producto) {
            abort(404, 'Producto no encontrado.');
        }
        $categorias = DB::table('categorias')->get();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string',
            'stock' => 'required|integer',
            'categoria_id' => 'required|integer',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $producto = DB::table('productos')->where('id', $id)->first();
        if (!$producto) {
            abort(404, 'Producto no encontrado.');
        }

        $imagen = $producto->imagen;
        if ($request->hasFile('imagen')) {
            $nombreImagen = time() . "_" . $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(public_path('uploads'), $nombreImagen);
            $imagen = $nombreImagen;
        }

        DB::table('productos')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
            'imagen' => $imagen,
        ]);

        return redirect()->route('admin.productos.edit', $id)->with('success', 'Producto actualizado correctamente.');
    }

    public function create()
    {
        $categorias = DB::table('categorias')->get();
        return view('admin.productos.create', compact('categorias'));
    }
public function destroy($id)
{
    $producto = DB::table('productos')->where('id', $id)->first();
    if (!$producto) {
        abort(404, 'Producto no encontrado.');
    }

    // Si quieres, puedes borrar la imagen del servidor aquí
    if ($producto->imagen && file_exists(public_path('uploads/' . $producto->imagen))) {
        unlink(public_path('uploads/' . $producto->imagen));
    }

    DB::table('productos')->where('id', $id)->delete();

    return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente.');
}

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string',
            'stock' => 'required|integer',
            'categoria_id' => 'required|integer',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $imagen = null;
        if ($request->hasFile('imagen')) {
            $nombreImagen = time() . "_" . $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(public_path('uploads'), $nombreImagen);
            $imagen = $nombreImagen;
        }

        DB::table('productos')->insert([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
            'imagen' => $imagen,
        ]);

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente.');
    }
}
