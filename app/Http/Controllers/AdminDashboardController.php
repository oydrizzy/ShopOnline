<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
{
    $totalProductos = DB::table('productos')->count();
    $totalCategorias = DB::table('categorias')->count();
    $totalUsuarios = DB::table('usuarios')->count();

    $ultimoProducto = DB::table('productos')->orderBy('id', 'desc')->value('nombre');
    $ultimoUsuario = DB::table('usuarios')->orderBy('creado_en', 'desc')->value('nombre');

    $ultimosProductos = DB::table('productos')
    ->orderBy('id', 'desc')
    ->limit(5)
    ->get();

$ultimosUsuarios = DB::table('usuarios')
    ->orderBy('creado_en', 'desc')
    ->limit(5)
    ->get();

$stockBajo = DB::table('productos')
    ->where('stock', '<', 5)
    ->count();

    return view('admin.dashboard.index', compact(
        'totalProductos',
        'totalCategorias',
        'totalUsuarios',
        'ultimoProducto',
        'ultimoUsuario',
        'ultimosProductos',
        'ultimosUsuarios',
        'stockBajo'
    ));
}

}
