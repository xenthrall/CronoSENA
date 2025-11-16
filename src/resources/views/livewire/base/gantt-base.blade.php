<div class="bg-white dark:bg-gray-900 shadow-xl rounded-xl p-6 space-y-6 transition-colors duration-300">

    {{-- Button exportar --}}
    <div class="flex justify-end">
        <a class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600"
            href="{{ route('export.monthly_executions', ['month' => $month, 'year' => $year]) }}"
            target='_blank'>Previsualizar PDF</a>
    </div>
    
    {{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
        {{ $monthLabel }}
    </h3>

    <div class="flex flex-wrap items-start gap-6">

        {{-- Contenedor vertical de los zooms --}}
        <div class="flex flex-col gap-3">
            <div class="flex items-center gap-2">
                <label class="text-sm text-gray-600 dark:text-gray-400">X:</label>
                <input
                    type="range"
                    min="30"
                    max="100"
                    step="2"
                    wire:model.live="columnWidthPx"
                    class="w-40 accent-blue-500 dark:accent-blue-400"
                />
            </div>

            <div class="flex items-center gap-2">
                <label class="text-sm text-gray-600 dark:text-gray-400">Y:</label>
                <input
                    type="range"
                    min="40"
                    max="100"
                    step="2"
                    wire:model.live="rowHeightPx"
                    class="w-40 accent-blue-500 dark:accent-blue-400"
                />
            </div>
        </div>

        {{-- Selects --}}
        <div class="flex items-center gap-3">
            <select wire:model.live="month"
                class="form-select w-36 p-2 rounded-lg border-gray-300 dark:border-gray-600 
                bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 shadow-sm 
                focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors">
                @foreach (range(1, 12) as $m)
                    <option value="{{ $m }}">
                        {{ ucfirst(\Carbon\Carbon::create(0, $m, 1)->translatedFormat('F')) }}
                    </option>
                @endforeach
            </select>

            <select wire:model.live="year"
                class="form-select w-28 p-2 rounded-lg border-gray-300 dark:border-gray-600 
                bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 shadow-sm 
                focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors">
                @php $current = now()->year; @endphp
                @for ($y = $current - 3; $y <= $current + 2; $y++)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>

    </div>
</div>

    {{-- Contenedor con scroll --}}
    <div class="overflow-auto border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 transition-colors duration-300"
        style="max-height: 60vh;">
        <div class="min-w-full">

            {{-- Encabezado --}}
            <div
                class="grid grid-cols-[240px_1fr] bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-20">
                <div
                    class="p-3 font-semibold text-sm text-gray-700 dark:text-gray-200 sticky left-0 z-30 bg-gray-100 dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
                    {{ $entityName }}
                </div>

                <div class="relative flex" style="min-width: {{ $totalColumns * $columnWidthPx }}px;">

                    <div class="flex-shrink-0 text-center border-r border-gray-200 dark:border-gray-700 py-2"
                        style="width: {{ $columnWidthPx }}px;">
                        {{-- Columna vacia --}}
                    </div>

                    @foreach ($columns as $column)
                        <div class="flex-shrink-0 text-center border-r border-gray-200 dark:border-gray-700 py-2"
                            style="width: {{ $columnWidthPx }}px;">
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $column->translatedFormat('D') }}
                            </div>
                            <div class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                {{ $column->format('d') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Filas por entidad --}}
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($rows as $row)
                    <div
                        class="grid grid-cols-[240px_1fr] items-stretch odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800 transition-colors">

                        {{-- Información de la entidad --}}
                        <div
                            class="p-3 flex items-center gap-3 sticky left-0 z-10 bg-inherit border-r border-gray-200 dark:border-gray-700">

                            @if ($row['avatarUrl'] ?? '')
                                <img src="{{ $row['avatarUrl'] }}" class="w-9 h-9 rounded-full object-cover shadow-sm"
                                    alt="{{ $row['label'] }}">
                            @else
                                <div
                                    class="w-9 h-9 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-sm font-semibold text-gray-700 dark:text-gray-100 shadow-sm">
                                    {{ Str::upper(Str::substr($row['label'], 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <div
                                    class="font-medium text-sm text-gray-900 dark:text-gray-100 truncate max-w-[180px]">
                                    {{ $row['label'] }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[180px]">
                                    {{ $row['sub_label'] ?? '' }}
                                </div>
                            </div>
                        </div>

                        {{-- Timeline --}}
                        <div class="py-3 px-1 relative">
                            <div class="relative"
                                style="width: {{ $totalColumns * $columnWidthPx }}px; height: {{ $rowHeightPx }}px;">
                                {{-- Cuadrícula --}}
                                <div class="absolute inset-0 flex">
                                    @foreach ($columns as $_)
                                        <div class="flex-shrink-0 border-r border-gray-200 dark:border-gray-700"
                                            style="width: {{ $columnWidthPx }}px;"></div>
                                    @endforeach
                                </div>

                                {{-- Barras de ejecución --}}
                                @php $bars = $barsByRow[$row['id']] ?? []; @endphp
                                @foreach ($bars as $bar)
                                    <div class="absolute top-0 left-0 transition-all duration-200 hover:z-20 hover:scale-[1.03] hover:shadow-lg"
                                        style="
                                            left: {{ $bar['left'] }}%;
                                            width: {{ $bar['width'] }}%;
                                            height: {{ $rowHeightPx }}px;
                                        ">
                                        {{-- Wrapper para permitir overflow-visible --}}
                                        <div class="relative w-full h-full overflow-visible">

                                            {{-- Badge solapada en la esquina superior izquierda --}}
                                            <span
                                                class="absolute -top-2 -left-4 w-7 h-6 rounded-full flex items-center justify-center 
                                                text-[10px] font-semibold
                                                border border-white shadow-sm
                                                bg-white text-primary-600
                                                dark:bg-gray-800 dark:text-white dark:border-gray-700"
                                                aria-hidden="true">
                                                {{ $bar['badge'] }}
                                            </span>

                                            {{-- Contenido real de la barra --}}
                                            <div class="h-full w-full rounded-md overflow-hidden shadow-md dark:bg-gray-700 bg-primary-600/80"
                                                style="border: 1px solid rgba(255,255,255,0.2);">
                                                <div
                                                    class="relative h-full w-full flex flex-col items-start justify-start px-2 leading-tight pt-2">

                                                    <div class="flex items-center gap-2">
                                                        {{-- SUB-LABEL --}}
                                                        @if (!empty($bar['sub_label']))
                                                            <span class="text-[10px] text-gray-300 leading-tight">
                                                                {{ $bar['sub_label'] }}
                                                            </span>
                                                        @endif

                                                        {{-- Rango de fechas --}}
                                                        <span class="text-[10px] text-gray-200/90 leading-tight">
                                                            {{ $bar['started_at'] . ' - ' . $bar['ended_at'] }}
                                                        </span>
                                                    </div>


                                                    {{-- LABEL PRINCIPAL --}}
                                                    <span class="text-[11px] font-semibold text-white w-full">
                                                        {{ $bar['label'] ?? 'Sin título' }}
                                                    </span>

                                                </div>
                                            </div>

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
                    Generado con <a href="https://cronosena.site/" target="_blank" class="underline">CronoSENA</a>
                </span>
            </div>
        </div>
        <div class="text-xs text-gray-500 dark:text-gray-400">
            Columnas: {{ $totalColumns }}
        </div>
    </div>
</div>
