<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $producto->nombre }} - {{ config('app.name') }}</title>
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

<main>
    <section class="producto-detalle">
        <div class="producto-img-detalle">
            <img
                draggable="false"
                src="{{ asset('uploads/' . $producto->imagen) }}"
                alt="{{ $producto->nombre }}"
                class="producto-img"
            >
        </div>

        <div class="info">
            <h1 class="nombre-producto">{{ $producto->nombre }}</h1>
            <p class="stock {{ $producto->stock < 5 ? 'low' : 'ok' }}">
                {{ $producto->stock < 5 ? '¡Últimas unidades!' : 'Disponible' }}
            </p>
            <p class="descripcion">{{ $producto->descripcion }}</p>
            <p class="precio">${{ number_format($producto->precio, 2) }}</p>

            <div class="acciones">
    <form method="POST" action="{{ route('carrito.agregar', $producto->id) }}">
        @csrf
        <button type="submit" class="btn-agregar" data-tippy-content="Agregar al carrito">
            <i class="fas fa-shopping-cart"></i>
        </button>
    </form>

    <a href="{{ route('carrito.comprar', $producto->id) }}" class="btn-comprar" data-tippy-content="Comprar ahora">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1z"/>
        </svg>
    </a>
</div>
            <div class="acciones-secundarias">
            </div>
        </div>
    </section>

    <!-- NUEVA SECCIÓN DE RESEÑAS -->
  <section class="producto-resenas">
    <h2 class="titulo-resenas">Reseñas de clientes</h2>

    <div class="resenas-lista">
        <div class="resena">
            <div class="resena-header">
                <div class="resena-user">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="María G." class="avatar-resena">
                    <strong>María G.</strong>
                </div>
                <div class="resena-rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
            </div>
            <p class="resena-texto">Me encantó este producto, llegó rápido y en perfecto estado.</p>
        </div>
        <div class="resena">
            <div class="resena-header">
                <div class="resena-user">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos R." class="avatar-resena">
                    <strong>Carlos R.</strong>
                </div>
                <div class="resena-rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                </div>
            </div>
            <p class="resena-texto">Buena calidad por el precio. Lo recomiendo.</p>
        </div>
        <div class="resena">
            <div class="resena-header">
                <div class="resena-user">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Ana P." class="avatar-resena">
                    <strong>Ana P.</strong>
                </div>
                <div class="resena-rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                    <i class="bi bi-star"></i>
                </div>
            </div>
            <p class="resena-texto">Todo bien pero el empaque llegó un poco dañado.</p>
        </div>
    </div>

    <div class="form-resena">
        <h3>Calificar producto</h3>
        <form method="POST" action="#">
            @csrf
            <div class="input-group">
                <textarea name="comentario" id="comentario" rows="4" required></textarea>
                <label for="comentario">Tu comentario...</label>
            </div>
            <div class="input-group">
                <label for="rating" class="label-select">Calificación:</label>
                <select name="rating" id="rating" required>
                    <option value="">Selecciona</option>
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="1">★☆☆☆☆</option>
                </select>
            </div>
            <button type="submit" class="btn-enviar-resena">Calificar</button>
        </form>
    </div>
</section>
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
<!-- Modal de Imagen -->
<div id="modalImagen" class="modal-imagen">
    <span class="cerrar-modal">&times;</span>
    <img class="modal-imagen-contenido" id="imagenAmpliada" alt="Imagen ampliada">
</div>

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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const img = document.querySelector('.producto-img');
    const modal = document.getElementById('modalImagen');
    const modalImg = document.getElementById('imagenAmpliada');
    const cerrar = document.querySelector('.cerrar-modal');

    img.addEventListener('click', function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        modalImg.alt = this.alt;
    });

    cerrar.addEventListener('click', function() {
        modal.style.display = "none";
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
});
</script>

</body>
</html>
