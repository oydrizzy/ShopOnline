<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="{{ asset('assets/img/icon.png') }}">
    <meta charset="UTF-8">
    <title>{{ $producto->nombre }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<body>

<main>
    <div class="producto-detalle">
        <img draggable="false" 
             src="{{ asset('uploads/' . $producto->imagen) }}" 
             alt="{{ $producto->nombre }}" 
             class="producto-img">

        <div class="info">
            <h2>{{ $producto->nombre }}</h2>
            <span class="stock {{ $producto->stock < 5 ? 'low' : 'ok' }}">
                Stock disponible: {{ $producto->stock }}
            </span>
            <p class="descripcion">{{ $producto->descripcion }}</p>
            <p class="precio">${{ number_format($producto->precio, 2) }}</p>
            <a href="{{ url('/') }}" class="btn-volver">← Volver a la tienda</a>
        </div>
    </div>
</main>

<footer>
    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
</footer>

</body>
</html>
