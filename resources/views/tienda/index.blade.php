<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/img/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tienda.css') }}">
</head>
<body>

<div class="usuario-header">
    @if($usuario)
        <div class="usuario-logueado">
            👋 Bienvenido, {{ $usuario['nombre'] }}
            <a href="{{ route('logout') }}" class="btn-logout">Cerrar sesión</a>
        </div>
    @else
        <button class="btn-login" onclick="mostrarLogin()">Iniciar Sesión</button>
    @endif
</div>

<div id="modalLogin" class="modal">

  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarModales()">&times;</span>
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="text" name="usuario" placeholder="Correo o Usuario" required>
    <input type="password" name="clave" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
    <p>¿No tienes cuenta? <a href="#" onclick="mostrarRegistro()">Crear una cuenta</a></p>
</form>

@if(session('error'))
  <div class="alert" style="color: red; margin-top:10px;">
    {{ session('error') }}
  </div>
@endif

  </div>
</div>

<div id="modalRegistro" class="modal">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarModales()">&times;</span>
    <h2>Crear Cuenta</h2>
    <form method="POST" action="/Controllers/registro.php">
      <input type="text" name="nombre" placeholder="Nombre completo" required>
      <input type="email" name="correo" placeholder="Correo electrónico" required>
      <input type="password" name="clave" placeholder="Contraseña" required>
      <button type="submit">Registrarse</button>
      <p>¿Ya tienes cuenta? <a href="#" onclick="mostrarLogin()">Iniciar sesión</a></p>
    </form>
  </div>
</div>

<main>
    <center>
      <img draggable="false" src="{{ asset('assets/img/ld.png') }}" alt="{{ config('app.name') }}" style="height: 170px; margin-right: 10px;">
    </center>

    <form method="GET" action="{{ url('/') }}" class="form-busqueda">
        <div class="input-wrapper">
            <input 
                type="text" 
                name="buscar" 
                placeholder="Buscar producto..." 
                value="{{ $buscar }}" 
                autocomplete="off"
                id="input-buscar"
            />
            <div id="resultados-busqueda" class="sugerencias"></div>
        </div>

        <select name="categoria">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" {{ $categoria == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nombre }}
                </option>
            @endforeach
        </select>

        <button type="submit">Filtrar</button>
    </form>

    @if($productos->isEmpty())
        <div class="alert">No hay productos disponibles por el momento.</div>
    @else
        <section class="row">
            @foreach($productos as $producto)
                <article class="producto-card">
                    <img draggable="false"
                        src="{{ asset('uploads/'.$producto->imagen) }}" 
                        alt="{{ $producto->nombre }}" 
                        class="producto-img"
                    >
                    <h5>{{ $producto->nombre }}</h5>
                    <p class="text-secundario">{{ $producto->categoria_nombre }}</p>
                    <p class="descripcion">{{ $producto->descripcion }}</p>
                    <p class="precio">${{ number_format($producto->precio, 2) }}</p>
                    <span class="stock-label {{ $producto->stock < 5 ? 'bajo' : 'ok' }}">
                        Stock: {{ $producto->stock }}
                    </span>
                    <a href="{{ url('/producto/detalle/'.$producto->id) }}">Ver detalle</a>
                </article>
            @endforeach
        </section>
    @endif
</main>

<footer>
    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
</footer>

<script>
const inputBuscar = document.querySelector('#input-buscar');
const contenedor = document.getElementById('resultados-busqueda');

inputBuscar.addEventListener('input', function () {
    const query = this.value.trim();
    contenedor.innerHTML = '';
    if (query.length < 2) return;

fetch(`{{ route('buscar.ajax') }}?q=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) return;
            data.forEach(producto => {
                const div = document.createElement('div');
                div.textContent = `${producto.nombre} - $${producto.precio}`;
                div.onclick = () => window.location.href = `/producto/detalle/${producto.id}`;
                contenedor.appendChild(div);
            });
        })
        .catch(err => console.error('Error en búsqueda:', err));
});

document.addEventListener('click', e => {
    if (!contenedor.contains(e.target) && e.target !== inputBuscar) {
        contenedor.innerHTML = '';
    }
});

function mostrarLogin() {
  cerrarModales();
  document.getElementById('modalLogin').classList.add('mostrar');
}

function mostrarRegistro() {
  cerrarModales();
  document.getElementById('modalRegistro').classList.add('mostrar');
}

function cerrarModales() {
  document.getElementById('modalLogin').classList.remove('mostrar');
  document.getElementById('modalRegistro').classList.remove('mostrar');
}
</script>

</body>
</html>
