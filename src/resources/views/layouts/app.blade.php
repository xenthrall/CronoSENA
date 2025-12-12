<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Aplicación')</title>

    {{-- Estilos generados por Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Estilos propios de la página (opcional) --}}
    @stack('styles')
</head>

<body class="min-h-screen bg-gray-100 text-gray-900">

    {{-- Navbar global opcional --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto p-4">
            <h1 class="text-xl font-semibold">
                @yield('header', 'Panel')
            </h1>
        </div>
    </header>

    {{-- Contenido principal --}}
    <main class="max-w-7xl mx-auto py-6 px-4">
        @yield('content')
    </main>

    {{-- Scripts específicos de cada vista --}}
    @stack('scripts')
</body>
</html>
