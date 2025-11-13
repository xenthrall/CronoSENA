<div class="bg-white dark:bg-gray-900 shadow-xl rounded-xl p-6 space-y-6 transition-colors duration-300">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
            {{ $monthLabel }}
        </h3>

        <div class="flex flex-wrap items-center gap-3">

            {{-- Zoom horizontal --}}
            <div class="flex items-center gap-2">
                <label class="text-sm text-gray-600 dark:text-gray-400">Zoom horizontal:</label>
                <input type="range" min="40" max="100" step="2" wire:model.live="dayWidthPx"
                    class="w-40 accent-blue-500 dark:accent-blue-400" />
            </div>

            {{-- Zoom vertical --}}
            <div class="flex items-center gap-2">
                <label class="text-sm text-gray-600 dark:text-gray-400">Zoom vertical:</label>
                <input type="range" min="40" max="100" step="2" wire:model.live="rowHeightPx"
                    class="w-40 accent-blue-500 dark:accent-blue-400" />
            </div>

            {{-- Select mes --}}
            <select wire:model.live="month"
                class="form-select w-36 p-2 rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors">
                @foreach (range(1, 12) as $m)
                    <option value="{{ $m }}">
                        {{ ucfirst(\Carbon\Carbon::create(0, $m, 1)->translatedFormat('F')) }}
                    </option>
                @endforeach
            </select>

            {{-- Select año --}}
            <select wire:model.live="year"
                class="form-select w-28 p-2 rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors">
                @php $current = now()->year; @endphp
                @for ($y = $current - 3; $y <= $current + 2; $y++)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>
    </div>

    {{-- Contenedor con scroll --}}
    <div class="overflow-auto border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 transition-colors duration-300"
        style="max-height: 70vh;">
        <div class="min-w-full">

            {{-- Encabezado --}}
            <div
                class="grid grid-cols-[240px_1fr] bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-20">
                <div
                    class="p-3 font-semibold text-sm text-gray-700 dark:text-gray-200 sticky left-0 z-30 bg-gray-100 dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
                    {{ $entityName }}
                </div>

                <div class="relative flex" style="min-width: {{ $totalDays * $dayWidthPx }}px;">
                    @foreach ($days as $day)
                        <div class="flex-shrink-0 text-center border-r border-gray-200 dark:border-gray-700 py-2"
                            style="width: {{ $dayWidthPx }}px;">
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $day->translatedFormat('D') }}
                            </div>
                            <div class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                {{ $day->format('d') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Filas por entidad --}}
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($entities as $entity)
                    <div
                        class="grid grid-cols-[240px_1fr] items-stretch odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800 transition-colors">

                        {{-- Información de la entidad --}}
                        <div
                            class="p-3 flex items-center gap-3 sticky left-0 z-10 bg-inherit border-r border-gray-200 dark:border-gray-700">
                            <div
                                class="w-9 h-9 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-sm font-semibold text-gray-700 dark:text-gray-100 shadow-sm">
                                {{ strtoupper(Str::substr($entity->name ?? 'E', 0, 1)) }}
                            </div>
                            <div>
                                <div
                                    class="font-medium text-sm text-gray-900 dark:text-gray-100 truncate max-w-[180px]">
                                    {{ $entity->full_name ?? 'Entidad' }}
                                </div>
                            </div>
                        </div>

                        {{-- Timeline --}}
                        <div class="py-3 px-1 relative">
                            <div class="relative"
                                style="min-width: {{ $totalDays * $dayWidthPx }}px; height: {{ $rowHeightPx }}px;">
                                {{-- Cuadrícula --}}
                                <div class="absolute inset-0 flex">
                                    @foreach ($days as $_)
                                        <div class="flex-shrink-0 border-r border-gray-200 dark:border-gray-700"
                                            style="width: {{ $dayWidthPx }}px;"></div>
                                    @endforeach
                                </div>

                                {{-- Barras de ejecución --}}
                                @php $bars = $barsByEntity[$entity->id] ?? []; @endphp
                                @foreach ($bars as $bar)
                                    <div class="absolute top-0 rounded-md overflow-hidden shadow-md transition-all duration-200 hover:z-20 hover:scale-[1.03] hover:shadow-lg dark:bg-gray-700 bg-primary-600/80"
                                        style="
                                            left: {{ $bar['left'] }}%;
                                            width: {{ $bar['width'] }}%;
                                            height: {{ $rowHeightPx }}px;
                                            border: 1px solid rgba(255,255,255,0.2);
                                        ">
                                        <div
                                            class="relative h-full w-full flex flex-col items-start justify-center px-2 leading-tight">
                                            {{-- SUB-LABEL --}}
                                            @if (!empty($bar['sub_label']))
                                                <span
                                                    class="text-[10px] text-gray-300 whitespace-normal break-words leading-tight">
                                                    {{ $bar['sub_label'] }}
                                                </span>
                                            @endif

                                            {{-- LABEL PRINCIPAL --}}
                                            <span class="text-[11px] font-semibold text-white w-full">
                                                {{ $bar['label'] ?? 'Sin título' }}
                                            </span>

                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-900">
                        No hay entidades para mostrar en este período.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Pie --}}
    <div
        class="flex flex-col sm:flex-row sm:justify-between sm:items-center text-sm text-gray-700 dark:text-gray-300 gap-3">
        <div class="flex gap-5 items-center">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full border border-gray-300 dark:border-gray-600"></div>
                <span class="text-gray-400 dark:text-gray-500">
                    Developed by xenthrall
                </span>
            </div>
        </div>
        <div class="text-xs text-gray-500 dark:text-gray-400">
            Días: {{ $totalDays }} — Entidades: {{ $entities->count() }}
        </div>
    </div>
</div>
