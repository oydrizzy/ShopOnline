@extends('admin.includes.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 border border-green-200 text-green-800 px-4 py-3">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <h2 class="text-2xl font-bold flex items-center gap-2">📦 Listado de Productos</h2>
        <a href="{{ route('admin.productos.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
            + Agregar Producto
        </a>
    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-center">
            <thead class="bg-blue-50 border-b">
                <tr>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">ID</th>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Nombre</th>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Precio</th>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $p)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $p->id }}</td>
                        <td class="py-3 px-4">{{ $p->nombre }}</td>
                        <td class="py-3 px-4 font-semibold text-green-600">${{ number_format($p->precio, 2) }}</td>
                        <td class="py-3 px-4 space-x-2">
                            {{-- Editar --}}
                            <a href="{{ route('admin.productos.edit', $p->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-yellow-900 text-xs font-semibold rounded hover:bg-yellow-500 transition">
                                ✏️ Editar
                            </a>

                            {{-- Eliminar --}}
                            <form action="{{ route('admin.productos.destroy', $p->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('¿Eliminar producto?')" type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded hover:bg-red-600 transition">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-gray-500">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
