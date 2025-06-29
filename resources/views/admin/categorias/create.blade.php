@extends('admin.includes.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">

    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2 text-green-600">
            ➕ Crear Categoría
        </h2>

        <form method="POST" action="{{ route('admin.categorias.store') }}" class="space-y-6">
            @csrf

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input 
                    type="text" 
                    name="nombre" 
                    value="{{ old('nombre') }}" 
                    required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
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
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                >{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-3">
                <button 
                    type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition"
                >
                    Guardar
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
