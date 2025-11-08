<x-filament-panels::page>
    <div class="space-y-8">
        {{-- Header principal --}}
        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
            <div>
                <span>
                        <strong class="text-gray-800 dark:text-gray-200">Programa:</strong>
                        {{ $record->program->name }}
                </span>
            </div>
            <div class="flex flex-wrap gap-4 mt-3 text-sm text-gray-600 dark:text-gray-400">
                    
                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">Inicio:</strong>
                        {{ $record->start_date }}
                    </span>

                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">fecha lectiva:</strong>
                        {{ $record->lective_end_date }}
                    </span>

                    <span>
                        <strong class="text-gray-800 dark:text-gray-200">fecha fin productiva:</strong>
                        {{ $record->end_date }}
                    </span>
            </div>
            <x-filament::button color="gray" tag="a" href="{{ url()->previous() }}">
                ← Volver
            </x-filament::button>
        </div>

        @livewire('fichas.ficha-competencies', ['ficha' => $this->record])
</x-filament-panels::page>