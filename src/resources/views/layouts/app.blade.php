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

<body>

    {{-- Contenido principal --}}
    <main>
        @yield('content')
    </main>

    {{-- Scripts específicos de cada vista --}}
    @stack('scripts')
</body>
</html>
