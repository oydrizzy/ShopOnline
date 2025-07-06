<!-- Botón flotante del carrito -->
<button id="carritoBoton" class="carrito-boton" title="Ver carrito"><i class="fas fa-shopping-cart"></i></button>
<!-- Panel lateral del carrito -->
<div id="carritoPanel" class="carrito-panel">
    <div class="carrito-header">
        <h2>Mi carrito</h2>
        <button id="carritoCerrar" class="carrito-cerrar">&times;</button>
    </div>
    <div class="carrito-contenido">
        @php
            $carrito = session('carrito', []);
            $total = 0;
        @endphp

        @forelse ($carrito as $item)
            @php
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            @endphp
            <div class="carrito-item">
                <img src="{{ asset('uploads/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}">
                <div class="carrito-item-info">
                    <h4>{{ $item['nombre'] }}</h4>
                    <p>${{ number_format($item['precio'], 2) }} × {{ $item['cantidad'] }}</p>
                </div>
                <form method="POST" action="{{ route('carrito.eliminar', $item['id']) }}">
                    @csrf
                    <button type="submit" title="Eliminar" style="border:none; font-size:18px; cursor:pointer;">✕</button>
                </form>
            </div>
        @empty
            <p style="text-align:center; color: var(--gris); margin-top:30px;">Tu carrito está vacío.</p>
        @endforelse
    </div>
    <div class="carrito-total">
        <span>Total:</span>
        <strong>${{ number_format($total, 2) }}</strong>
    </div>
    @if(count($carrito))
        <a href="{{ route('checkout') }}" class="carrito-checkout">Proceder al pago</a>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnAbrir = document.getElementById('carritoBoton');
    const panel = document.getElementById('carritoPanel');
    const btnCerrar = document.getElementById('carritoCerrar');
    const STORAGE_KEY = 'carritoVisible';

    // Restaurar estado al cargar
    if (localStorage.getItem(STORAGE_KEY) === 'true') {
        panel.classList.add('visible');
    }

    btnAbrir?.addEventListener('click', () => {
        panel.classList.add('visible');
        localStorage.setItem(STORAGE_KEY, 'true');
    });

    btnCerrar?.addEventListener('click', () => {
        panel.classList.remove('visible');
        localStorage.setItem(STORAGE_KEY, 'false');
    });
});
</script>