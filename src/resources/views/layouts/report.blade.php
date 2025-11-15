<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Reporte')</title>

    {{-- Estilos principales --}}
    @vite('resources/css/filament/theme.css')

    {{-- Manejo del modo oscuro --}}
    @if (!filament()->hasDarkMode())
        <script>
            localStorage.setItem('theme', 'light')
        </script>
    @elseif (filament()->hasDarkModeForced())
        <script>
            localStorage.setItem('theme', 'dark')
        </script>
    @else
        <script>
            const loadDarkMode = () => {
                window.theme = localStorage.getItem('theme') ?? @js(filament()->getDefaultThemeMode()->value)

                if (
                    window.theme === 'dark' ||
                    (window.theme === 'system' &&
                        window.matchMedia('(prefers-color-scheme: dark)')
                        .matches)
                ) {
                    document.documentElement.classList.add('dark')
                }
            }

            loadDarkMode()

            document.addEventListener('livewire:navigated', loadDarkMode)
        </script>
    @endif
</head>

<body>

    <div>

        {{-- Logo alineado a la izquierda --}}
        <div class="mt-6">
            <img src="{{ asset('images/logo-cata-removebg.png') }}" alt="Logo CronoSENA" class="h-12 mb-0">
        </div>

        {{-- Encabezado general centrado --}}
        <div class="text-center mb-6">
            <h1>@yield('report-title', 'Reporte Mensual')</h1>
            <p>@yield('report-subtitle')</p>
        </div>

        <div>
            @yield('content')
        </div>

    </div>

</body>

</html>
