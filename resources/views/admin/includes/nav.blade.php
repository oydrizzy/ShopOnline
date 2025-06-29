<nav class="bg-black">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="{{ url('/admin/dashboard') }}" class="text-white font-bold text-lg flex items-center gap-2">
          🛒 Admin Shop
        </a>
      </div>

      <!-- Menú Desktop -->
      <div class="hidden md:flex space-x-2">
        <a href="/"
           class="text-white px-3 py-2 rounded-md hover:bg-gray-800 transition">         
          🛍️  Tienda
        </a>
        <a href="{{ url('/admin/productos') }}"
           class="text-white px-3 py-2 rounded-md hover:bg-gray-800 transition">
          📦 Productos
        </a>
        <a href="{{ url('/admin/categorias') }}"
           class="text-white px-3 py-2 rounded-md hover:bg-gray-800 transition">
          🗂️ Categorías
        </a>
        <a href="{{ url('/logout') }}"
           class="text-white px-3 py-2 rounded-md hover:bg-gray-800 transition">
          🔒 Cerrar sesión
        </a>
      </div>

      <!-- Botón Móvil -->
      <div class="md:hidden">
        <button id="mobileMenuButton"
                class="text-gray-300 hover:text-white focus:outline-none focus:text-white">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Menú Móvil -->
  <div id="mobileMenu" class="hidden md:hidden">
    <a href="{{ url('/admin/productos') }}"
       class="block px-4 py-2 text-white hover:bg-gray-800 transition">📦 Productos</a>
    <a href="{{ url('/admin/categorias') }}"
       class="block px-4 py-2 text-white hover:bg-gray-800 transition">🗂️ Categorías</a>
    <a href="{{ url('/logout') }}"
       class="block px-4 py-2 text-white hover:bg-gray-800 transition">🔒 Cerrar sesión</a>
  </div>
</nav>

<script>
  document.getElementById('mobileMenuButton').addEventListener('click', function () {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
  });
</script>
