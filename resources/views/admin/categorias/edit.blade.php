@extends('admin.includes.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-100 border border-green-200 text-green-800 px-4 py-3">
            ✅ <strong>Éxito:</strong> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2 text-yellow-600">
            ✏️ Editar Categoría
        </h2>

        <form method="POST" action="{{ route('admin.categorias.update', $categoria->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input 
                    type="text" 
                    name="nombre" 
                    value="{{ old('nombre', $categoria->nombre) }}" 
                    required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                >
                @error('nombre')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea 
                    name="descripcion" 
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                >{{ old('descripcion', $categoria->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-3">
                <button 
                    type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-white hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition"
                >
                    Actualizar
                </button>
                <a 
                    href="{{ route('admin.categorias.index') }}" 
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-300 transition"
                >
                    Volver
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
