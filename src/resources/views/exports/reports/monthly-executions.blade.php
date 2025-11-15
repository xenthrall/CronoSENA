@extends('layouts.report')

@section('title')
    REPORTE-MENSUAL-INSTRUCTORES-{{ strtoupper($month) }}-{{ $year }}
@endsection

@section('report-title', 'Reporte Mensual de Instructores')
@section('report-subtitle')
    Mes: {{ $month }} / Año: {{ $year }}
@endsection


@section('content')
    <div class="bg-white dark:bg-slate-900 shadow-xl rounded-xl p-6 space-y-6">

        {{-- CONTENEDOR PRINCIPAL SIN SCROLL --}}
        <div class="border border-slate-200 dark:border-slate-700 rounded-lg bg-slate-50 dark:bg-slate-800">
            <div class="min-w-full">

                {{-- ENCABEZADO --}}
                {{-- Nota: la segunda columna contiene la "columna vacía" + los días --}}
                <div
                    class="grid grid-cols-[240px_1fr] bg-slate-100 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700">
                    <div
                        class="p-3 font-semibold text-sm text-slate-700 dark:text-slate-200 border-r border-slate-200 dark:border-slate-700">
                        {{ $entityName }}
                    </div>

                    {{-- Contenedor: columna vacía + días --}}
                    @php
                        // ancho total real del timeline incluyendo la columna vacía
                        $timelineTotalPx = ($totalDays + 1) * $dayWidthPx;
                    @endphp
                    <div class="relative flex" style="min-width: {{ $timelineTotalPx }}px;">

                        {{-- Columna vacía (primer 'día' vacío) --}}
                        <div class="flex-shrink-0 text-center border-r border-slate-200 dark:border-slate-700 py-2"
                            style="width: {{ $dayWidthPx }}px;">
                            {{-- Intencionalmente vacío para separación / etiqueta lateral --}}
                        </div>

                        {{-- Días --}}
                        @foreach ($days as $day)
                            <div class="flex-shrink-0 text-center border-r border-slate-200 dark:border-slate-700 py-2"
                                style="width: {{ $dayWidthPx }}px;">
                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                    {{ $day->translatedFormat('D') }}
                                </div>
                                <div class="text-sm font-medium text-slate-800 dark:text-slate-100">
                                    {{ $day->format('d') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- FILAS POR ENTIDAD --}}
                <div class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($rows as $row)
                        <div class="grid grid-cols-[240px_1fr] items-stretch">

                            {{-- Identidad --}}
                            <div
                                class="p-3 flex items-center gap-3 border-r border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900">

                                @if ($row['avatarUrl'] ?? '')
                                    <img src="{{ $row['avatarUrl'] }}" class="w-9 h-9 rounded-full object-cover shadow-sm"
                                        alt="{{ $row['label'] }}">
                                @else
                                    <div
                                        class="w-9 h-9 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-sm font-semibold text-gray-700 dark:text-gray-100 shadow-sm">
                                        {{ Str::upper(Str::substr($row['label'], 0, 1)) }}
                                    </div>
                                @endif

                                {{-- Nombres --}}
                                <div>
                                    <div
                                        class="font-medium text-sm text-slate-900 dark:text-slate-100 truncate max-w-[180px]">
                                        {{ $row['label'] }}
                                    </div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400 truncate max-w-[180px]">
                                        {{ $row['email'] ?? '' }}
                                    </div>
                                </div>
                            </div>

                            {{-- TIMELINE --}}
                            <div class="py-3 px-1 relative bg-white dark:bg-slate-900">
                                {{-- Contenedor con desplazamiento horizontal --}}
                                <div class="relative overflow-x-auto" style="width:100%;">
                                    {{-- ancho total incluyendo columna vacía --}}
                                    <div class="relative"
                                        style="width: {{ $timelineTotalPx }}px; height: {{ $rowHeightPx }}px;">

                                        {{-- Cuadrícula (incluye la celda vacía + celdas por día) --}}
                                        <div class="absolute inset-0 flex">
                                            {{-- celda vacía --}}
                                            <div class="flex-shrink-0 border-r border-slate-200 dark:border-slate-700"
                                                style="width: {{ $dayWidthPx }}px; height: {{ $rowHeightPx }}px;">
                                            </div>

                                            {{-- celdas de días --}}
                                            @foreach ($days as $_)
                                                <div class="flex-shrink-0 border-r border-slate-200 dark:border-slate-700"
                                                    style="width: {{ $dayWidthPx }}px; height: {{ $rowHeightPx }}px;">
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- Barras --}}
                                        @php
                                            $bars = $barsByRow[$row['id']] ?? [];

                                            // tamaño del contenido real sobre el que se calculan left/width porcentuales (sin la columna vacía)
                                            $contentWidthPx = $totalDays * $dayWidthPx;
                                            // ancho total del timeline (incluye la columna vacía)
                                            $totalTimelinePx = $timelineTotalPx;
                                        @endphp

                                        @foreach ($bars as $bar)
                                            @php
                                                // Aseguramos que left/width existan y sean numéricos
                                                $leftPct = isset($bar['left']) ? (float) $bar['left'] : 0.0;
                                                $widthPct = isset($bar['width']) ? (float) $bar['width'] : 0.0;

                                                // Calculamos en px sobre el contenido (sin la columna vacía),
                                                // luego desplazamos todo por 1 * $dayWidthPx para dejar espacio a la columna vacía.
                                                $leftPxContent = round(($leftPct / 100) * $contentWidthPx, 2);
                                                $widthPx = round(($widthPct / 100) * $contentWidthPx, 2);

                                                // El left efectivo suma la columna vacía
                                                $leftPx = $dayWidthPx + $leftPxContent;

                                                // Evitar valores negativos o fuera de rango
                                                if ($leftPx < $dayWidthPx) {
                                                    $leftPx = $dayWidthPx;
                                                }
                                                if ($leftPx > $totalTimelinePx) {
                                                    $leftPx = $totalTimelinePx;
                                                }
                                                if ($widthPx < 0) {
                                                    $widthPx = 0;
                                                }
                                                if ($leftPx + $widthPx > $totalTimelinePx) {
                                                    $widthPx = max(0, $totalTimelinePx - $leftPx);
                                                }
                                            @endphp

                                            {{-- Solo renderizar si tiene ancho --}}
                                            @if ($widthPx > 0)
                                                <div class="absolute top-0 left-0"
                                                    style="left: {{ $leftPx }}px; width: {{ $widthPx }}px; height: {{ $rowHeightPx }}px;">

                                                    <div class="relative w-full h-full">

                                                        {{-- Badge --}}
                                                        <span
                                                            class="absolute -top-2 -left-4 w-7 h-6 rounded-full flex items-center justify-center
                                                            text-[10px] font-semibold bg-white text-indigo-600 dark:bg-slate-800 dark:text-white
                                                            border border-slate-300 dark:border-slate-700 shadow-sm">
                                                            {{ $bar['badge'] }}
                                                        </span>

                                                        {{-- Barra principal --}}
                                                        <div class="h-full w-full rounded-md overflow-hidden shadow bg-indigo-600 dark:bg-slate-700"
                                                            style="border: 1px solid rgba(255,255,255,0.2);">

                                                            <div
                                                                class="relative h-full w-full flex flex-col items-start justify-start px-2 pt-2">

                                                                <div class="flex items-center gap-2">
                                                                    @if (!empty($bar['sub_label']))
                                                                        <span class="text-[10px] text-slate-300">
                                                                            {{ $bar['sub_label'] }}
                                                                        </span>
                                                                    @endif

                                                                    <span class="text-[10px] text-slate-200/90">
                                                                        {{ $bar['started_at'] }} - {{ $bar['ended_at'] }}
                                                                    </span>
                                                                </div>

                                                                <span class="text-[11px] font-semibold text-white">
                                                                    {{ $bar['label'] ?? 'Sin título' }}
                                                                </span>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>


                        </div>
                    @empty
                        <div class="p-6 text-center text-slate-500 dark:text-slate-400">
                            No hay entidades para mostrar.
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

        {{-- Pie --}}
        <div class="flex justify-between items-center text-sm text-slate-700 dark:text-slate-300">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/crono.svg') }}" alt="Logo xenthrall" class="h-10">
                <span class="text-slate-400 dark:text-slate-500">Generado con <a href="https://cronosena.site/"
                        target="_blank" class="underline">CronoSENA</a></span>
            </div>

            <div class="text-xs text-slate-500 dark:text-slate-400">
                Días (visibles): {{ $totalDays }}
            </div>
        </div>

    </div>
@endsection
