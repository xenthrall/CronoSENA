@extends('layouts.app')

@section('title', $title)

@section('content')

    {{-- Fondo SVG --}}
    <img src="/images/background.svg" alt="Fondo CronoSENA"
        class="fixed inset-0 w-full h-full object-cover -z-10 blur-3xl opacity-100 animate-[pulse_15s_ease-in-out_infinite]">

    <div class="min-h-screen flex flex-col px-4 py-6 gap-6">

        {{-- Header en card --}}
        <div
            class="w-full max-w-5xl mx-auto backdrop-blur-xl bg-white/60
               border border-white/50 rounded-2xl shadow-lg px-8 py-6 animate-fadeIn">
            <div class="flex items-center justify-between">
                <h2
                    class="text-2xl font-semibold bg-gradient-to-r from-blue-600 to-purple-500
                       bg-clip-text text-transparent">
                    {{ $tipo }}: {{ $name }}
                </h2>

                <a href="{{ url('/consultar-horario') }}" class="text-sm text-gray-500 hover:text-purple-600 transition">
                    ← Volver
                </a>
            </div>
        </div>

        {{-- Calendario FULL WIDTH --}}
        <div
            class="w-full max-w-7xl mx-auto backdrop-blur-xl bg-white/70
               border border-white/50 rounded-2xl shadow-lg p-4 md:p-6">
            <div id="calendar-public" data-tipo="{{ $tipo }}" data-id="{{ $id }}"
                class="w-full h-[70vh] rounded-xl bg-white/90 border border-purple-200">
                {{-- FullCalendar se renderiza aquí --}}
            </div>
        </div>

    </div>



    {{-- MODAL EVENTO --}}
    <div id="event-modal" class="fixed inset-0 z-50 hidden items-center justify-center">
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeModal()"></div>

        {{-- Modal --}}
        <div
            class="relative w-full max-w-xl mx-4
               bg-white rounded-2xl shadow-xl
               p-6 animate-fadeIn">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
                <h3 id="modal-title" class="text-xl font-semibold text-gray-800"></h3>

                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>

            {{-- Content --}}
            <div class="space-y-3 text-sm text-gray-700">
                <div><strong>Jornada:</strong> <span id="modal-shift"></span></div>
                <div><strong>Horas ejecutadas:</strong> <span id="modal-hours"></span></div>
                <div><strong>Rango:</strong> <span id="modal-range"></span></div>
                <div><strong>Sede:</strong> <span id="modal-location"></span></div>
                <div><strong>Ambiente:</strong> <span id="modal-environment"></span></div>
            </div>

            {{-- Footer --}}
            <div class="mt-6 flex justify-end">
                <button onclick="closeModal()" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    Cerrar
                </button>
            </div>
        </div>
    </div>


    <script>
        /* ===============================
                    MODAL LOGIC
        ================================ */

        function openModal(data) {
            const modal = document.getElementById("event-modal")

            document.getElementById("modal-title").innerText = data.title
            document.getElementById("modal-shift").innerText = data.shift ?? "-"
            document.getElementById("modal-hours").innerText = data.executed_hours ?? "-"
            document.getElementById("modal-range").innerText = data.execution_range ?? "-"
            document.getElementById("modal-location").innerText = data.location ?? "-"
            document.getElementById("modal-environment").innerText = data.environment ?? "-"

            modal.classList.remove("hidden")
            modal.classList.add("flex")
            document.body.classList.add("overflow-hidden")
        }

        function closeModal() {
            const modal = document.getElementById("event-modal")
            modal.classList.add("hidden")
            modal.classList.remove("flex")
            document.body.classList.remove("overflow-hidden")
        }

        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") closeModal()
        })
    </script>
@endsection
