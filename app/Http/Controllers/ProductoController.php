<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }
    public function cargarMas(Request $request)
{
    $page = $request->input('page', 1);
    $perPage = 10;

    $productos = Producto::orderBy('id', 'desc')
        ->skip(($page - 1) * $perPage)
        ->take($perPage)
        ->get();

    return response()->json($productos);
}
}
