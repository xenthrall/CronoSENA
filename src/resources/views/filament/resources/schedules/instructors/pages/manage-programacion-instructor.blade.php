<x-filament-panels::page>
    <div>

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    {{ $record->full_name }}
                </p>
            </div>

            <x-filament::button
                color="gray"
                tag="a"
                href="{{ static::getResource()::getUrl('index') }}"
                icon="heroicon-o-arrow-left"
            >
                Volver
            </x-filament::button>
        </div>

        {{-- Card calendario --}}
        <x-filament::card>
            <div
                wire:ignore
                id="calendar"
                class="min-h-[600px]"
                data-tipo="instructor"
                data-id="{{ $record->id }}"
            ></div>
        </x-filament::card>

    </div>
</x-filament-panels::page>
