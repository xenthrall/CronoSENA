<div class="bg-white shadow-xl rounded-xl p-6 space-y-6">

    {{-- Header con título y filtros --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h3 class="text-xl font-semibold text-gray-800">
            Cronograma — {{ $monthLabel }}
        </h3>

        <div class="flex flex-wrap items-center gap-3">
            {{-- Selector de mes --}}
            <select
                wire:model.live="month"
                class="form-select w-36 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors"
            >
                @foreach(range(1,12) as $m)
                    <option value="{{ $m }}">
                        {{ ucfirst(\Carbon\Carbon::create(0, $m, 1)->translatedFormat('F')) }}
                    </option>
                @endforeach
            </select>

            {{-- Selector de año --}}
            <select
                wire:model.live="year"
                class="form-select w-28 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors"
            >
                @php
                    $current = now()->year;
                @endphp
                @for($y = $current - 3; $y <= $current + 2; $y++)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>
    </div>

    {{-- Contenedor principal con scroll --}}
    <div
        class="overflow-auto border border-gray-200 rounded-lg bg-gray-50"
        style="max-height: 70vh;"
    >
        <div class="min-w-full">

            {{-- Encabezado de tabla / calendario --}}
            <div class="grid grid-cols-[240px_1fr] bg-gray-100 border-b border-gray-200 sticky top-0 z-20">
                <div class="p-3 font-semibold text-sm text-gray-700 sticky left-0 z-30 bg-gray-100 border-r border-gray-200">
                    Instructor
                </div>

                <div class="relative flex" style="min-width: {{ $totalDays * 40 }}px;">
                    @foreach($days as $day)
                        <div class="w-10 flex-shrink-0 text-center border-r border-gray-200 py-2">
                            <div class="text-xs text-gray-500">{{ $day->translatedFormat('D') }}</div>
                            <div class="text-sm font-medium text-gray-800">{{ $day->format('d') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Filas de instructores --}}
            <div class="divide-y divide-gray-200">
                @forelse($instructors as $instructor)
                    <div class="grid grid-cols-[240px_1fr] items-stretch odd:bg-white even:bg-gray-50">

                        {{-- Columna izquierda: datos del instructor --}}
                        <div class="p-3 flex items-center gap-3 sticky left-0 z-10 bg-inherit border-r border-gray-200">
                            @if(method_exists($instructor, 'getFilamentAvatarUrl') && $instructor->getFilamentAvatarUrl())
                                <img
                                    src="{{ $instructor->getFilamentAvatarUrl() }}"
                                    class="w-9 h-9 rounded-full object-cover shadow-sm"
                                    alt="{{ $instructor->full_name }}"
                                >
                            @else
                                <div class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center text-sm font-semibold text-gray-700 shadow-sm">
                                    {{ Str::upper(Str::substr($instructor->full_name, 0, 1)) }}
                                </div>
                            @endif

                            <div>
                                <div class="font-medium text-sm text-gray-900 truncate max-w-[180px]">
                                    {{ $instructor->full_name }}
                                </div>
                                <div class="text-xs text-gray-500 truncate max-w-[180px]">
                                    {{ $instructor->email ?? '' }}
                                </div>
                            </div>
                        </div>

                        {{-- Timeline del instructor --}}
                        <div class="py-3 px-1 relative">
                            <div class="relative h-10" style="min-width: {{ $totalDays * 40 }}px;">
                                
                                {{-- Líneas de días --}}
                                <div class="absolute inset-0 flex">
                                    @foreach($days as $_)
                                        <div class="w-10 flex-shrink-0 border-r border-gray-200"></div>
                                    @endforeach
                                </div>

                                {{-- Barras de ejecución --}}
                                @php $bars = $barsByInstructor[$instructor->id] ?? []; @endphp
                                @foreach($bars as $bar)
                                    <div
                                        class="absolute top-0 h-10 rounded-md text-sm font-medium text-white overflow-hidden shadow-md transition-all duration-200 hover:z-20 hover:scale-[1.03] hover:shadow-lg"
                                        style="
                                            left: {{ $bar['left'] }}%;
                                            width: {{ $bar['width'] }}%;
                                            background: {{ $bar['color'] }};
                                            border: 1px solid rgba(255,255,255,0.7);
                                        "
                                        title="{{ $bar['title'] }} — {{ $bar['started_at'] }} → {{ $bar['ended_at'] }}{{ $bar['notes'] ? ' — ' . Str::limit($bar['notes'], 80) : '' }}"
                                    >
                                        <div class="px-2 truncate" style="line-height: 2.5rem;">
                                            {{ Str::limit($bar['title'], 40) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500 bg-white">
                        No hay instructores para mostrar en este período.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Leyenda --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center text-sm text-gray-700 gap-3">
        <div class="flex gap-5 items-center">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-green-600 border border-gray-300"></div>
                <span>Finalizado</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-amber-400 border border-gray-300"></div>
                <span>En curso</span>
            </div>
        </div>

        <div class="text-xs text-gray-500">
            Días: {{ $totalDays }} — Instructores: {{ $instructors->count() }}
        </div>
    </div>
</div>
