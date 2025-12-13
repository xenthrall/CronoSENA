@extends('layouts.app')

@section('title', $title)

@section('content')

{{-- Fondo SVG --}}
<img
    src="/images/background.svg"
    alt="Fondo CronoSENA"
    class="fixed inset-0 w-full h-full object-cover -z-10 blur-3xl opacity-100 animate-[pulse_15s_ease-in-out_infinite]"
>

<div class="min-h-screen flex flex-col px-4 py-6 gap-6">

    {{-- Header en card --}}
    <div
        class="w-full max-w-5xl mx-auto backdrop-blur-xl bg-white/60
               border border-white/50 rounded-2xl shadow-lg px-8 py-6 animate-fadeIn"
    >
        <div class="flex items-center justify-between">
            <h2
                class="text-2xl font-semibold bg-gradient-to-r from-blue-600 to-purple-500
                       bg-clip-text text-transparent"
            >
                {{ $tipo }}: {{ $name }}
            </h2>

            <a
                href="{{ url('/consultar-horario') }}"
                class="text-sm text-gray-500 hover:text-purple-600 transition"
            >
                ← Volver
            </a>
        </div>
    </div>

    {{-- Calendario FULL WIDTH --}}
    <div
        class="w-full max-w-7xl mx-auto backdrop-blur-xl bg-white/70
               border border-white/50 rounded-2xl shadow-lg p-4 md:p-6"
    >
        <div
            id="calendar"
            data-tipo="{{ $tipo }}"
            data-id="{{ $id }}"
            class="w-full h-[70vh] rounded-xl bg-white/90 border border-purple-200"
        >
            {{-- FullCalendar se renderiza aquí --}}
        </div>
    </div>

</div>

@endsection
