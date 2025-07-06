<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputBuscar = document.querySelector('#input-buscar');
    const contenedor = document.getElementById('resultados-busqueda');

    if (inputBuscar) {
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
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Mostrar modal de login si hay error de inicio de sesión
    @if(session('error'))
        mostrarLogin();
    @endif

    // Mostrar modal de registro si hay error de validación del registro
    @if($errors->any() && old('correo'))
        mostrarRegistro();
    @endif
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const usuarioLogueado = document.getElementById('usuarioLogueado');
    const toggleBtn = document.getElementById('toggleUsuario');
    const mostrarBtn = document.getElementById('mostrarUsuario');

    // Estado inicial según localStorage
    const minimizado = localStorage.getItem('usuarioMinimizado') === 'true';
    if (minimizado) {
        usuarioLogueado.classList.add('oculto');
        mostrarBtn.classList.remove('hidden');
    } else {
        usuarioLogueado.classList.add('visible');
    }

    // Ocultar con animación
    toggleBtn?.addEventListener('click', () => {
        usuarioLogueado.classList.remove('visible');
        usuarioLogueado.classList.add('oculto');
        mostrarBtn.classList.remove('hidden');
        localStorage.setItem('usuarioMinimizado', 'true');
    });

    // Mostrar con animación
    mostrarBtn?.addEventListener('click', () => {
        usuarioLogueado.classList.remove('oculto');
        usuarioLogueado.classList.add('visible');
        mostrarBtn.classList.add('hidden');
        localStorage.setItem('usuarioMinimizado', 'false');
    });
});
</script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
  const tips = tippy('.btn-accion', {
    animation: 'scale',
    theme: 'light-border',
    placement: 'bottom',
  });

  tippy.createSingleton(tips, {
    delay: [0, 0],
  });
</script>
<script>
  const tooltips = tippy('.btn-agregar, .btn-comprar', {
      animation: 'scale',
      theme: 'light-border',
      placement: 'top',
  });

  tippy.createSingleton(tooltips, {
      delay: [0, 0], // Sin retraso al cambiar
  });
</script>

