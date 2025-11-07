<x-filament-panels::page>
    <div class="space-y-8">
        {{-- Header principal --}}
        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Ficha: <span class="text-primary-600 dark:text-primary-400">{{ $record->code }}</span>
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Programa: {{ $record->program->name ?? 'Sin programa' }} · Inicio {{ $record->start_date}}
                </p>
            </div>
            <x-filament::button color="gray" tag="a" href="{{ url()->previous() }}">
                ← Volver
            </x-filament::button>
        </div>

        @livewire('fichas.ficha-competencies', ['ficha' => $this->record])
</x-filament-panels::page>