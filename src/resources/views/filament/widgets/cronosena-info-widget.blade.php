<x-filament-widgets::widget >
    <x-filament::section>
        <div class="w-full max-w-2xl mx-auto">

        <!-- Widget Card -->
            <div class="flex items-center gap-4">
                
                <!-- Logo / Enlace a GitHub (SVG más pequeño) -->
                <a
                    href="https://github.com/xenthrall/CronoSENA"
                    rel="noopener noreferrer"
                    target="_blank"
                    class="flex-shrink-0"
                    aria-label="CronoSENA en GitHub"
                >
                    <!-- SVG del monograma + reloj. Se ha reducido el tamaño para una mejor integración. -->
                    <svg
                        class="h-9 w-9 text-primary-500 hover:text-primary-700 transition-colors duration-300"

                        viewBox="0 0 48 48"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                    >
                        <!-- Círculo exterior -->
                        <circle cx="24" cy="24" r="22" stroke="currentColor" stroke-width="2" fill="none" opacity="0.2"/>
                        <!-- Marcadores / Ticks -->
                        <g stroke="currentColor" stroke-width="1.5" opacity="0.28">
                            <line x1="24" y1="4" x2="24" y2="7"/>
                            <line x1="24" y1="41" x2="24" y2="44"/>
                            <line x1="4" y1="24" x2="7" y2="24"/>
                            <line x1="41" y1="24" x2="44" y2="24"/>
                        </g>
                        <!-- Manecilla (hora) -->
                        <line x1="24" y1="24" x2="24" y2="14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <!-- Manecilla (min) -->
                        <line x1="24" y1="24" x2="33" y2="20" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" opacity="0.9"/>
                        <!-- Monograma CS centrado -->
                        <text
                            x="24"
                            y="33.5"
                            text-anchor="middle"
                            font-family="Inter, ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial"
                            font-size="10"
                            font-weight="700"
                            fill="currentColor"
                            opacity="0.98"
                        >CS</text>
                    </svg>
                </a>

                <!-- Información Principal -->
                <div class="flex-1 min-w-0">
                    <h3 class="text-base font-semibold fi-filament-info-widget-logo">
                        CronoSENA
                    </h3>
                    <p class="fi-filament-info-widget-version">
                        v{{config('app.version', '1.0.0')}}
                    </p>
                </div>

                <!-- Acciones / Botones -->
                <div class="flex items-center gap-3 flex-shrink-0">
                    <!-- Enlace a Documentación -->
                    <a
                        href="https://cronosena.site"
                        rel="noopener noreferrer"
                        target="_blank"
                        class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500 transition-colors duration-300 whitespace-nowrap"
                    >
                        <!-- Icono de Libro (Heroicon) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                        <span class="hidden sm:inline">Documentación</span>
                    </a>
                    
                    <!-- Enlace a GitHub -->
                    <a
                        href="https://github.com/xenthrall/CronoSENA"
                        rel="noopener noreferrer"
                        target="_blank"
                        class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500 transition-colors duration-300 whitespace-nowrap"
                    >
                        <!-- Icono de GitHub -->
                        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" aria-hidden="true">
                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/>
                        </svg>
                        <span class="hidden sm:inline">GitHub</span>
                    </a>
                </div>
            </div>
        </div>

    </x-filament::section>
</x-filament-widgets::widget>
