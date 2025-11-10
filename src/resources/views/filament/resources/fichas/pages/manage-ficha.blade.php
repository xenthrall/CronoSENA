<x-filament-panels::page>
    <div class="space-y-8">

        {{-- Encabezado principal --}}
        @php
            $leader = $record->currentLeader();
            $photoUrl = $leader?->photo_url ? Storage::url($leader->photo_url) : asset('images/crono.svg');
        @endphp

        <header
            class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-200 dark:border-gray-700 pb-4">

            {{-- Columna izquierda: información principal (ocupa todo el ancho en sm, crece en md) --}}
            <div class="md:flex-1 space-y-3">

                {{-- Programa --}}
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Programa:
                    <span class="font-medium text-primary-600 dark:text-primary-400">
                        {{ $record->program->name }}
                    </span>
                </p>

                {{-- Fechas Ficha --}}
                <div class="flex flex-wrap gap-4 text-sm text-gray-600 dark:text-gray-400 mt-1">
                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">Inicio:</strong>
                        {{ $record->start_date }}
                    </span>

                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">Fin lectiva:</strong>
                        {{ $record->lective_end_date }}
                    </span>

                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">Fin total:</strong>
                        {{ $record->end_date }}
                    </span>
                </div>

                {{-- Instructor y foto --}}
                <div class="flex items-center gap-3 mt-2">
                    <img src="{{ $photoUrl }}" alt="Foto del instructor"
                        class="w-12 h-12 rounded-full object-cover shadow-sm" />

                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                            {{ $leader?->full_name ?? 'Sin instructor asignado' }}
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            Instructor Gestor
                        </span>
                    </div>
                </div>
            </div>

            {{-- Columna derecha: botón Volver (alineado verticalmente con el header en md) --}}
            <div class="mt-4 md:mt-0 md:ml-6 flex items-start md:items-center">
                <x-filament::button color="gray" tag="a"
                    href="{{ static::getResource()::getUrl('index') }}"
                    class="whitespace-nowrap">
                    ← Volver
                </x-filament::button>
            </div>

        </header>

        {{-- Componente de competencias (debajo del encabezado) --}}
        <div class="space-y-4">
            @livewire('fichas.ficha-competencies', ['ficha' => $this->record])
        </div>

    </div>
</x-filament-panels::page>
