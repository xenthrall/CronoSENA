@extends('layouts.app')

@section('title', 'Consultar horario')

@section('content')

    {{-- Fondo SVG igual al welcome --}}
    <img src="/images/background.svg" alt="Fondo CronoSENA"
        class="fixed inset-0 w-full h-full object-cover -z-10 blur-3xl opacity-100 animate-[pulse_15s_ease-in-out_infinite]">

    <div class="min-h-screen flex items-center justify-center px-4">

        <div
            class="w-full max-w-xl backdrop-blur-xl bg-white/60 border border-white/50
               rounded-2xl shadow-lg p-8 animate-fadeIn">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <h2
                    class="text-2xl font-semibold bg-gradient-to-r from-blue-600 to-purple-500
                       bg-clip-text text-transparent">
                    Consultar horario
                </h2>
            </div>

            {{-- Error --}}
            @if (session('error'))
                <div class="mb-4 rounded-lg bg-pink-100/70 text-pink-700 text-sm px-4 py-2 border border-pink-200">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('horario.buscar') }}" class="space-y-6">
                @csrf

                {{-- Tipo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Consultar por
                    </label>

                    <select name="tipo" id="tipo" required
                        class="w-full rounded-lg border border-gray-200 bg-white/80
                           focus:border-purple-400 focus:ring-purple-400 py-2 px-1">
                        <option value="">Seleccione una opción</option>
                        <option value="instructor" @selected(old('tipo') === 'instructor')>
                            Instructor
                        </option>
                        <option value="ficha" @selected(old('tipo') === 'ficha')>
                            Ficha
                        </option>
                        <option value="ambiente" @selected(old('tipo') === 'ambiente')>
                            Ambiente
                        </option>
                    </select>

                    @error('tipo')
                        <p class="text-sm text-pink-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Valor --}}
                <div>
                    <label id="label-valor" class="block text-sm font-medium text-gray-700 mb-2">
                        Valor
                    </label>

                    <input type="text" name="valor" id="valor" value="{{ old('valor') }}" required
                        class="w-full rounded-lg border border-gray-200 bg-white/80
                           focus:border-purple-400 focus:ring-purple-400 py-2 px-4"
                        placeholder="Ingrese el valor">

                    @error('valor')
                        <p class="text-sm text-pink-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Acciones --}}
                <div class="pt-4 flex flex-col sm:flex-row gap-4">

                    {{-- Botón principal (rosa claro minimal) --}}
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center
                           rounded-full px-6 py-2.5 font-semibold
                           text-pink-600 bg-pink-100 hover:bg-pink-200
                           transition shadow-sm">
                        Consultar horario
                    </button>

                    {{-- Secundario --}}
                    <a href="{{ url('/') }}"
                        class="w-full text-center py-2.5 rounded-full
                           border border-gray-300 text-gray-600
                           hover:bg-gray-100 transition">
                        Volver al inicio
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tipo = document.getElementById('tipo');
            const label = document.getElementById('label-valor');
            const input = document.getElementById('valor');

            const map = {
                instructor: ['Documento del instructor', 'Ej: 1022334455'],
                ficha: ['Número de ficha', 'Ej: 2456789'],
                ambiente: ['Código del ambiente', 'Ej: LAB-101'],
            };

            const update = () => {
                if (map[tipo.value]) {
                    label.textContent = map[tipo.value][0];
                    input.placeholder = map[tipo.value][1];
                } else {
                    label.textContent = 'Valor';
                    input.placeholder = 'Ingrese el valor';
                }
            };

            tipo.addEventListener('change', update);
            update();
        });
    </script>

@endsection
