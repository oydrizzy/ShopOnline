<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link rel="icon" href="{{ asset('admin/admin_icon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Si quieres personalizar colores/tipografías de Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#1f2937',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    @include('admin.includes.nav')

    <main class="flex-1 container mx-auto p-6">
        @yield('content')
    </main>

    <footer class="text-center py-4 text-gray-500">
        &copy; {{ date('Y') }} {{ config('app.name') }}
    </footer>

    @yield('scripts')
</body>
</html>
