@extends('admin.includes.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 border border-green-200 text-green-800 px-4 py-3">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Tarjeta --}}
    <div class="bg-white shadow rounded-lg p-6">
         <h2 class="text-2xl font-bold mb-6 flex items-center gap-2 text-yellow-600">
            ✏️ Editar Producto
        </h2>


        <form method="POST" action="{{ route('admin.productos.update', $producto->id) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input
                    type="text"
                    name="nombre"
                    value="{{ old('nombre', $producto->nombre) }}"
                    required
                    class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 @error('nombre') border-red-500 @enderror"
                >
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Precio --}}
            <div>
                <label class="block text-sm font-medium mb-1">Precio ($)</label>
                <input
                    type="number"
                    name="precio"
                    step="0.01"
                    value="{{ old('precio', $producto->precio) }}"
                    required
                    class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 @error('precio') border-red-500 @enderror"
                >
                @error('precio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-medium mb-1">Descripción</label>
                <textarea
                    name="descripcion"
                    required
                    class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 @error('descripcion') border-red-500 @enderror"
                    rows="3"
                >{{ old('descripcion', $producto->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Stock --}}
            <div>
                <label class="block text-sm font-medium mb-1">Stock</label>
                <input
                    type="number"
                    name="stock"
                    value="{{ old('stock', $producto->stock) }}"
                    required
                    class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 @error('stock') border-red-500 @enderror"
                >
                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Categoría --}}
            <div>
                <label class="block text-sm font-medium mb-1">Categoría</label>
                <select
                    name="categoria_id"
                    required
                    class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 @error('categoria_id') border-red-500 @enderror"
                >
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $cat)
                        <option
                            value="{{ $cat->id }}"
                            {{ old('categoria_id', $producto->categoria_id) == $cat->id ? 'selected' : '' }}
                        >
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen --}}
            <div>
                <label class="block text-sm font-medium mb-1">Imagen actual</label>
                @if($producto->imagen)
                    <img
                        src="{{ asset('uploads/' . $producto->imagen) }}"
                        alt="Imagen"
                        class="w-32 h-32 object-cover rounded border mb-2"
                    >
                @else
                    <p class="text-gray-500">No hay imagen subida.</p>
                @endif
                <input
                    type="file"
                    name="imagen"
                    accept="image/*"
                    class="w-full border-gray-300 rounded shadow-sm mt-2 @error('imagen') border-red-500 @enderror"
                >
                @error('imagen')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-2 pt-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                    Actualizar
                </button>
                <a href="{{ route('admin.productos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded hover:bg-gray-300 transition">
                    Volver
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
