@extends('admin.includes.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

  {{-- Mensajes --}}
  @if(session('success'))
    <div class="mb-4 rounded-lg bg-green-100 border border-green-200 text-green-800 px-4 py-3">
      ✅ {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="mb-4 rounded-lg bg-red-100 border border-red-200 text-red-800 px-4 py-3">
      ❌ {{ session('error') }}
    </div>
  @endif

  {{-- Encabezado --}}
  <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    <h2 class="text-2xl font-bold flex items-center gap-2">🗂️ Listado de Categorías</h2>
    <a href="{{ route('admin.categorias.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
      + Agregar Categoría
    </a>
  </div>

  {{-- Tabla --}}
  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full text-center">
      <thead class="bg-blue-50 border-b">
        <tr>
          <th class="py-3 px-4 text-sm font-semibold text-gray-600">ID</th>
          <th class="py-3 px-4 text-sm font-semibold text-gray-600">Nombre</th>
          <th class="py-3 px-4 text-sm font-semibold text-gray-600">Descripción</th>
          <th class="py-3 px-4 text-sm font-semibold text-gray-600">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categorias as $cat)
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4">{{ $cat->id }}</td>
            <td class="py-3 px-4">{{ $cat->nombre }}</td>
            <td class="py-3 px-4">{{ $cat->descripcion }}</td>
            <td class="py-3 px-4 space-x-2">
              <a href="{{ route('admin.categorias.edit', $cat->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-yellow-900 text-xs font-semibold rounded hover:bg-yellow-500 transition">
                ✏️ Editar
              </a>
              <form method="POST" action="{{ route('admin.categorias.destroy', $cat->id) }}" class="inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('¿Eliminar esta categoría?')" type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded hover:bg-red-600 transition">
                  🗑️ Eliminar
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="py-4 text-gray-500">No hay categorías registradas.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
