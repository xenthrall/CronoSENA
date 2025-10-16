<x-filament-panels::page>
    <div class="space-y-8">
        {{-- Header principal --}}
        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Gestionar Ficha: <span class="text-primary-600 dark:text-primary-400">{{ $record->code }}</span>
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Programa: {{ $record->program->name ?? 'Sin programa' }} · Inicio {{ $record->start_date}}
                </p>
            </div>
            <x-filament::button color="gray" tag="a" href="{{ url()->previous() }}">
                ← Volver
            </x-filament::button>
        </div>

        {{-- Lista de Competencias --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Competencias</h2>

            @php
                $competencias = $record->fichaCompetencies()->with('competency')->orderBy('order')->get();
            @endphp

            @if ($competencias->isEmpty())
                <div class="text-center py-12 border border-dashed rounded-xl dark:border-gray-700">
                    <p class="text-gray-500 dark:text-gray-400">Esta ficha aún no tiene competencias asignadas.</p>
                </div>
            @else
                <div class="divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                    @foreach ($competencias as $fichaCompetency)
                        <div class="flex items-start justify-between gap-4 p-4 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-colors">
                            {{-- Info principal --}}
                            <div class="flex-1 space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400">
                                        #{{ $fichaCompetency->order }}
                                    </span>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $fichaCompetency->competency->name ?? 'Sin nombre' }}
                                    </p>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Horas totales: <span class="font-medium">{{ $fichaCompetency->total_hours_competency }}</span> ·
                                    Ejecutadas: <span class="font-medium">{{ $fichaCompetency->executed_hours }}</span>
                                </p>
                                @if ($fichaCompetency->notes)
                                    <p class="text-xs italic text-gray-500 dark:text-gray-400">
                                        "{{ $fichaCompetency->notes }}"
                                    </p>
                                @endif
                            </div>

                            {{-- Estado --}}
                            <div>
                                <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full
                                    {{ match($fichaCompetency->status) {
                                        'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300',
                                        'in_progress' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300',
                                        'paused' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
                                        default => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300',
                                    } }}">
                                    {{ ucfirst($fichaCompetency->status ?? 'Sin estado') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
