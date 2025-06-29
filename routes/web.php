<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\UsuarioController;

Route::prefix('admin')->group(function() {
    // Categorías
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('admin.categorias.index');
    Route::get('/categorias/crear', [CategoriaController::class, 'create'])->name('admin.categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('admin.categorias.store');
    Route::get('/categorias/{id}/editar', [CategoriaController::class, 'edit'])->name('admin.categorias.edit');
    Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('admin.categorias.update');
    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy');

    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('admin.productos.index');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
    Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');

    // Usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::put('/usuarios/{id}/rol', [UsuarioController::class, 'updateRole'])->name('admin.usuarios.updateRole');

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Búsqueda en tienda
Route::get('/buscar', [TiendaController::class, 'buscarAjax'])->name('buscar.ajax');

// Tienda pública
Route::get('/', [TiendaController::class, 'index'])->name('inicio');
Route::get('/producto/detalle/{id}', [TiendaController::class, 'detalle'])->name('producto.detalle');

// Autenticación
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
