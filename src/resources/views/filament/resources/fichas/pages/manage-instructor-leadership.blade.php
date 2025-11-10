<x-filament-panels::page>
    {{-- Encabezado principal --}}
        @php
            $leader = $record->currentLeader();
            $photoUrl = $leader?->photo_url ? Storage::url($leader->photo_url) : asset('images/crono.svg');
        @endphp

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


                {{-- Columna derecha: botón Volver (alineado verticalmente con el header en md) --}}
            <div class="mt-4 md:mt-0 md:ml-6 flex items-start md:items-center">
                <x-filament::button color="gray" tag="a" href="{{ url()->previous() }}" class="whitespace-nowrap">
                    ← Volver
                </x-filament::button>
            </div>

            @livewire('fichas.manage-instructor-leadership-table', ['ficha' => $record])
</x-filament-panels::page>
