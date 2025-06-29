<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Session;

class TiendaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar', '');
        $categoria = $request->input('categoria', '');

        // Obtener categorías
        $categorias = Categoria::all();

        // Buscar productos
        $query = Producto::query()
            ->select('productos.*', 'categorias.nombre as categoria_nombre')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id');

        if ($buscar) {
            $query->where('productos.nombre', 'like', "%$buscar%");
        }
        if ($categoria) {
            $query->where('categoria_id', $categoria);
        }

        $productos = $query->get();

        return view('tienda.index', [
            'categorias' => $categorias,
            'productos' => $productos,
            'buscar' => $buscar,
            'categoria' => $categoria,
            'usuario' => Session::get('usuario'),
        ]);
    }

    public function detalle($id)
{
    $producto = DB::table('productos')->where('id', $id)->first();

    if (!$producto) {
        abort(404, 'Producto no encontrado.');
    }

    return view('tienda.detalle', compact('producto'));
}
public function buscarAjax(Request $request)
{
    $query = trim($request->get('q', ''));

    if (strlen($query) < 2) {
        return response()->json([]);
    }

    $productos = DB::table('productos')
        ->where('nombre', 'LIKE', "%$query%")
        ->limit(10)
        ->get(['id', 'nombre', 'precio']);

    return response()->json($productos);
}

}
