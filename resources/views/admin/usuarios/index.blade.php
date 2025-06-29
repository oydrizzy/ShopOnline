@extends('admin.includes.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Título --}}
    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
        👥 Usuarios 
    </h2>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
            ✅ <strong>Éxito:</strong> {{ session('success') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">Nombre</th>
                    <th class="py-3 px-4">Correo</th>
                    <th class="py-3 px-4">Rol</th>
                    <th class="py-3 px-4">Registrado</th>
                    <th class="py-3 px-4">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $u->id }}</td>
                    <td class="py-2 px-4">{{ $u->nombre }}</td>
                    <td class="py-2 px-4">{{ $u->correo }}</td>
                    <td class="py-2 px-4">{{ $u->rol }}</td>
                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($u->creado_en)->format('d/m/Y') }}</td>
                    <td class="py-2 px-4">
                        <form method="POST" action="{{ route('admin.usuarios.updateRole', $u->id) }}" class="flex items-center gap-2 justify-center">
                            @csrf
                            @method('PUT')
                            <select
                                name="rol"
                                class="border-gray-300 rounded text-sm py-1 px-2 focus:border-blue-400 focus:ring focus:ring-blue-200"
                            >
                                <option value="cliente" {{ $u->rol === 'cliente' ? 'selected' : '' }}>cliente</option>
                                <option value="admin" {{ $u->rol === 'admin' ? 'selected' : '' }}>admin</option>
                            </select>
                            <button
                                type="submit"
                                class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition"
                            >
                                Guardar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-4 text-gray-500">No hay usuarios registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
