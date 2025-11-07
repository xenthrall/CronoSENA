<x-filament-panels::page>
    <div class="space-y-8">
        {{-- Header principal --}}
        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
            <div>
                <p class="text-2xl text-gray-500 dark:text-gray-400">
                    Ficha: {{ $ficha->code }}
                </p>

                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Competencia: <span class="text-primary-600 dark:text-primary-400">{{ $fichaCompetency->competency->name }}</span>
                </h1>
                <p class="text-1xl text-gray-500 dark:text-gray-400">
                     {{ $fichaCompetency->total_hours_competency }} horas
                </p>
                <p class="text-1xl text-gray-500 dark:text-gray-400">
                     {{ $fichaCompetency->executed_hours }} ejecutadas
                </p>
                <p class="text-1xl text-gray-500 dark:text-gray-400">
                     {{ $fichaCompetency->remaining_hours }} restantes
                </p>
                
            </div>
            <x-filament::button color="gray" tag="a" href="{{ url()->previous() }}">
                ← Volver
            </x-filament::button>
        </div>

        @livewire('fichas.competency-executions', ['fichaCompetency' => $this->fichaCompetency])


</x-filament-panels::page>
