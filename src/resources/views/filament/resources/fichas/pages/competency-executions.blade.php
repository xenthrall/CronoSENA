<x-filament-panels::page>
    <div class="space-y-8">
        {{-- Encabezado principal --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-200 dark:border-gray-700 pb-4">
            
            {{-- Información principal --}}
            <div class="space-y-2">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Ficha: <span class="font-medium text-primary-600 dark:text-primary-400">{{ $ficha->code }}</span>
                </p>

                <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 leading-tight">
                    {{ $fichaCompetency->competency->name }}
                </h1>

                <div class="flex flex-wrap gap-4 mt-3 text-sm text-gray-600 dark:text-gray-400">
                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">Estado:</strong>
                        {{ ucfirst($fichaCompetency->status) }}
                    </span>

                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">Total:</strong>
                        {{ $fichaCompetency->total_hours_competency }} h
                    </span>

                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">Ejecutadas:</strong>
                        {{ $fichaCompetency->executed_hours }} h
                    </span>

                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">Restantes:</strong>
                        {{ $fichaCompetency->remaining_hours }} h
                    </span>
                </div>
            </div>

            {{-- Botón volver --}}
            <div class="mt-4 md:mt-0">
                <x-filament::button color="gray" tag="a" href="{{ static::getResource()::getUrl('manage', ['record' => $ficha->id]) }}">
                    ← Volver
                </x-filament::button>
            </div>
        </div>

        {{-- Sección de desarrollo --}}
        <div class="space-y-4">

            @livewire('fichas.competency-executions', ['fichaCompetency' => $this->fichaCompetency])
        </div>
    </div>
</x-filament-panels::page>
