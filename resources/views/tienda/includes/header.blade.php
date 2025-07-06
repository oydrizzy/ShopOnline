<div class="usuario-header" id="usuarioHeader">
    @if($usuario)
        <div class="usuario-logueado" id="usuarioLogueado">
            <div class="usuario-info">
                <img 
                    src="https://pm1.aminoapps.com/6362/348a81339a6db9a3b9c538326b9583db3c33bc22_hq.jpg"  
                    alt="Avatar de {{ $usuario['nombre'] }}" 
                    class="avatar-usuario"
                >
                <div class="texto-usuario">
                    <strong>{{ $usuario['nombre'] }}</strong>
                    <small>{{ ucfirst($usuario['rol']) }}</small>
                </div>
            </div>
            <div class="acciones-usuario">
    <a href="{{ url('/ajustes') }}" class="btn-accion" data-tippy-content="Ajustes de cuenta">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
        </svg>
    </a>

    @if($usuario['rol'] === 'admin')
    <a href="{{ url('/admin/dashboard') }}" class="btn-accion" data-tippy-content="Panel de control">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z"/>
        </svg>
    </a>
    @endif

    <a href="{{ route('logout') }}" class="btn-accion salir" data-tippy-content="Cerrar sesión">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
        </svg>
    </a>
</div>

            {{-- Botón minimizar --}}
            <button id="toggleUsuario" class="btn-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-angle-contract" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M.172 15.828a.5.5 0 0 0 .707 0l4.096-4.096V14.5a.5.5 0 1 0 1 0v-3.975a.5.5 0 0 0-.5-.5H1.5a.5.5 0 0 0 0 1h2.768L.172 15.121a.5.5 0 0 0 0 .707M15.828.172a.5.5 0 0 0-.707 0l-4.096 4.096V1.5a.5.5 0 1 0-1 0v3.975a.5.5 0 0 0 .5.5H14.5a.5.5 0 0 0 0-1h-2.768L15.828.879a.5.5 0 0 0 0-.707"/>
</svg></button>
        </div>
        {{-- Botón mostrar cuando está minimizado --}}
        <button id="mostrarUsuario" class="btn-toggle hidden"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#3490dc" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>
</button>
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
    <form method="POST" action="{{ route('registro') }}">
    @csrf

    {{-- Mostrar errores de validación --}}
    @if($errors->any())
        <div class="alert" style="color:red; margin-bottom:10px; text-align:left;">
            <ul style="list-style:none; padding:0; margin:0;">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <input type="text" name="nombre" placeholder="Nombre completo" value="{{ old('nombre') }}" required>
    <input type="email" name="correo" placeholder="Correo electrónico" value="{{ old('correo') }}" required>
    <input type="password" name="clave" placeholder="Contraseña" required>
    <button type="submit">Registrarse</button>
    <p>¿Ya tienes cuenta? <a href="#" onclick="mostrarLogin()">Iniciar sesión</a></p>
</form>
  </div>
</div>

    <center>
<a href="{{ url('/') }}">
    <img draggable="false" src="{{ asset('assets/img/drizzylogo.png') }}" alt="{{ config('app.name') }}" style="height: 170px; margin-right: 10px;">
</a>
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

        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg></button>
    </form>

    