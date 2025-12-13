<x-filament-panels::page>
    <div class="mt-4 md:mt-0 md:ml-6 flex items-start md:items-center">
        <x-filament::button color="gray" tag="a" href="{{ static::getResource()::getUrl('index') }}"
            class="whitespace-nowrap">
            ← Volver
        </x-filament::button>
    </div>

    <div id="calendar" data-tipo="instructor" data-id="{{ $record->id }}">
    </div>
</x-filament-panels::page>
