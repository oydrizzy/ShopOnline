<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    /**
     * Agregar producto al carrito.
     */
    public function agregar(Request $request, $id)
    {
        // Obtener el producto desde la base de datos
        $producto = DB::table('productos')->find($id);

        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Obtener el carrito actual o crear uno vacío
        $carrito = Session::get('carrito', []);

        // Si ya existe, incrementar cantidad
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            // Si no existe, agregarlo
            $carrito[$id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'imagen' => $producto->imagen,
                'cantidad' => 1
            ];
        }

        // Guardar en sesión
        Session::put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    /**
     * Mostrar el carrito.
     */
    public function mostrar()
    {
        $carrito = Session::get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    /**
     * Comprar un producto directamente.
     */
    public function comprar($id)
    {
        // Aquí puedes redirigir a la vista de compra o procesar el pago
        return redirect()->back()->with('success', 'Funcionalidad de compra directa pendiente de implementación.');
    }

    /**
     * Eliminar un producto del carrito.
     */
    public function eliminar($id)
{
    $carrito = Session::get('carrito', []);

    if (isset($carrito[$id])) {
        // Si hay más de 1 unidad, restar 1
        if ($carrito[$id]['cantidad'] > 1) {
            $carrito[$id]['cantidad']--;
        } else {
            // Si queda 1, quitar el producto del carrito
            unset($carrito[$id]);
        }
        Session::put('carrito', $carrito);
    }

    return redirect()->back()->with('success', 'Producto actualizado en el carrito.');
}

    /**
     * Vaciar todo el carrito.
     */
    public function vaciar()
    {
        Session::forget('carrito');
        return redirect()->back()->with('success', 'Carrito vaciado.');
    }
}
