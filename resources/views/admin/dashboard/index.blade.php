@extends('admin.includes.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10 space-y-10">

    {{-- Título --}}
    <h2 class="text-3xl font-extrabold flex items-center gap-2 text-gray-800">
        📊 Panel de Administración
    </h2>

    {{-- Métricas --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        {{-- Productos --}}
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl shadow-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
            <div>
                <h5 class="text-lg font-medium mb-2">📦 Productos</h5>
                <p class="text-4xl font-extrabold">{{ $totalProductos }}</p>
            </div>
            <a href="{{ route('admin.productos.index') }}" class="mt-4 inline-flex items-center justify-center bg-white text-blue-600 font-semibold px-4 py-2 rounded-lg hover:bg-blue-50 transition">
                Ver Productos
            </a>
        </div>
        {{-- Categorías --}}
        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl shadow-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
            <div>
                <h5 class="text-lg font-medium mb-2">🗂️ Categorías</h5>
                <p class="text-4xl font-extrabold">{{ $totalCategorias }}</p>
            </div>
            <a href="{{ route('admin.categorias.index') }}" class="mt-4 inline-flex items-center justify-center bg-white text-green-600 font-semibold px-4 py-2 rounded-lg hover:bg-green-50 transition">
                Ver Categorías
            </a>
        </div>
        {{-- Usuarios --}}
        <div class="bg-gradient-to-br from-gray-700 to-gray-800 text-white rounded-2xl shadow-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
            <div>
                <h5 class="text-lg font-medium mb-2">👥 Usuarios</h5>
                <p class="text-4xl font-extrabold">{{ $totalUsuarios }}</p>
            </div>
            <a href="{{ route('admin.usuarios.index') }}" class="mt-4 inline-flex items-center justify-center bg-white text-gray-800 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                Ver Usuarios
            </a>
        </div>
        {{-- Stock bajo --}}
        <div class="bg-gradient-to-br from-red-500 to-red-600 text-white rounded-2xl shadow-lg p-6 flex flex-col justify-between transform hover:scale-105 transition duration-300">
            <div>
                <h5 class="text-lg font-medium mb-2">⚠️ Stock Bajo</h5>
                <p class="text-4xl font-extrabold">{{ $stockBajo }}</p>
            </div>
            <a href="{{ route('admin.productos.index') }}" class="mt-4 inline-flex items-center justify-center bg-white text-red-600 font-semibold px-4 py-2 rounded-lg hover:bg-red-50 transition">
                Ver Detalle
            </a>
        </div>
    </div>

    {{-- Gráfico --}}
    <div class="bg-white rounded-2xl shadow p-6 border border-gray-200">
        <h5 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-700">
            📈 Estadísticas generales
        </h5>
        <canvas id="dashboardChart" height="120"></canvas>
    </div>

    {{-- Últimos Productos --}}
    <div class="bg-white rounded-2xl shadow p-6 border border-gray-200">
        <h5 class="text-xl font-semibold mb-4 text-gray-700">
            🆕 Últimos Productos
        </h5>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($ultimosProductos as $p)
                <div class="border rounded-lg p-4 flex flex-col hover:shadow-lg transition duration-300">
                    @if($p->imagen)
                        <img draggable="false" src="{{ asset('uploads/' . $p->imagen) }}" alt="Imagen" class="rounded mb-2 h-32 w-full object-cover">
                    @else
                        <div class="bg-gray-100 h-32 flex items-center justify-center text-gray-400">
                            Sin Imagen
                        </div>
                    @endif
                    <h6 class="font-semibold truncate">{{ $p->nombre }}</h6>
                    <p class="text-sm text-gray-600">${{ number_format($p->precio, 2) }}</p>
                    <a href="{{ route('admin.productos.edit', $p->id) }}" class="mt-auto inline-block text-blue-600 hover:underline text-sm">
                        ✏️ Editar
                    </a>
                </div>
            @empty
                <p class="text-gray-500">No hay productos recientes.</p>
            @endforelse
        </div>
    </div>

    {{-- Últimos Usuarios --}}
    <div class="bg-white rounded-2xl shadow p-6 border border-gray-200">
        <h5 class="text-xl font-semibold mb-4 text-gray-700">
            🙋 Últimos Usuarios Registrados
        </h5>
        <ul class="divide-y divide-gray-200">
            @forelse($ultimosUsuarios as $u)
                <li class="py-3 flex justify-between items-center">
                    <div class="truncate">
                        <span class="font-semibold">{{ $u->nombre }}</span>
                        <span class="text-gray-600 text-sm">({{ $u->correo }})</span>
                    </div>
                    <span class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($u->creado_en)->format('d/m/Y') }}</span>
                </li>
            @empty
                <li class="py-2 text-gray-500">No hay usuarios recientes.</li>
            @endforelse
        </ul>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const ctx = document.getElementById('dashboardChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Productos', 'Categorías', 'Usuarios'],
      datasets: [{
        label: 'Totales',
        data: {!! json_encode([$totalProductos, $totalCategorias, $totalUsuarios]) !!},
        backgroundColor: ['#3b82f6', '#10b981', '#374151']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
});
</script>
@endsection
