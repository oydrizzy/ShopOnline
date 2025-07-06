<!DOCTYPE html>
<html lang="es" class="loading">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/img/icon.png') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/tienda.css') }}">
</head>
<body>
@include('tienda.includes.header')

@if(session('success'))
    <div class="alerta-exito" id="mensajeExito">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alerta-error">
        {{ session('error') }}
    </div>
@endif
<div id="loader">
  <div class="spinner"></div>
</div>
<main> 
    @if($productos->isEmpty())
        <div class="alert">No hay productos disponibles por el momento.</div>
    @else
       <section class="row">
@foreach($productos as $producto)
    <div class="producto-card enlace-card">
        <a href="{{ url('/producto/detalle/'.$producto->id) }}" class="card-link">
            <img draggable="false"
                src="{{ asset('uploads/'.$producto->imagen) }}" 
                alt="{{ $producto->nombre }}" 
                class="producto-img">
            <h5>{{ $producto->nombre }}</h5>
            <p class="text-secundario">{{ $producto->categoria_nombre }}</p>
            <p class="descripcion">{{ $producto->descripcion }}</p>
            <p class="precio">${{ number_format($producto->precio, 2) }}</p>
            <span class="stock-label {{ $producto->stock < 5 ? 'bajo' : 'ok' }}">
                Stock: {{ $producto->stock }}
            </span>
        </a>
        <form method="POST" action="{{ route('carrito.agregar', $producto->id) }}" class="form-agregar-rapido">
            @csrf
            <button type="submit" title="Agregar al carrito" class="btn-rapido"><i class="fas fa-shopping-cart"></i></button>
        </form>
    </div>
@endforeach
</section>
    @endif
</main>

<footer>
    <div class="footer-container">
        <p>
            &copy; {{ date('Y') }} <strong>{{ config('app.name') }}</strong>.
            Todos los derechos reservados.
        </p>
    </div>
</footer>


<script src="{{ asset('assets/js/tienda.js') }}"></script>
@include('tienda.includes.scripts')
@include('tienda.includes.carrito')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mensaje = document.getElementById('mensajeExito');
    if (mensaje) {
        setTimeout(() => {
            mensaje.style.transition = 'opacity 0.3s ease';
            mensaje.style.opacity = '0';
            setTimeout(() => mensaje.remove(), 500);
        }, 5000);
    }
});
</script>
</body>
</html>