@extends('layouts.app')

@section('title', 'Consultar horario')
@section('header', 'Consulta de horarios')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow rounded-lg p-8">

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Consultar horario
    </h2>

    {{-- Mensaje de error general --}}
    @if(session('error'))
        <div class="mb-4 p-3 rounded bg-red-100 text-red-700 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('horario.buscar') }}" class="space-y-6">
        @csrf

        {{-- Tipo de consulta --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Consultar por
            </label>

            <select
                name="tipo"
                id="tipo"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required
            >
                <option value="">Seleccione una opción</option>
                <option value="instructor" {{ old('tipo') === 'instructor' ? 'selected' : '' }}>
                    Instructor
                </option>
                <option value="ficha" {{ old('tipo') === 'ficha' ? 'selected' : '' }}>
                    Ficha
                </option>
                <option value="ambiente" {{ old('tipo') === 'ambiente' ? 'selected' : '' }}>
                    Ambiente
                </option>
            </select>

            @error('tipo')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Campo dinámico --}}
        <div>
            <label id="label-valor" class="block text-sm font-medium text-gray-700 mb-2">
                Valor
            </label>

            <input
                type="text"
                name="valor"
                id="valor"
                value="{{ old('valor') }}"
                placeholder="Ingrese el valor"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required
            >

            @error('valor')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botón --}}
        <div class="pt-4">
            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition"
            >
                Consultar horario
            </button>
        </div>
    </form>
</div>

{{-- Script pequeño para cambiar labels --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tipoSelect = document.getElementById('tipo');
        const labelValor = document.getElementById('label-valor');
        const inputValor = document.getElementById('valor');

        const updateLabel = () => {
            switch (tipoSelect.value) {
                case 'instructor':
                    labelValor.textContent = 'Documento del instructor';
                    inputValor.placeholder = 'Ej: 1022334455';
                    break;
                case 'ficha':
                    labelValor.textContent = 'Número de ficha';
                    inputValor.placeholder = 'Ej: 2456789';
                    break;
                case 'ambiente':
                    labelValor.textContent = 'Código del ambiente';
                    inputValor.placeholder = 'Ej: LAB-101';
                    break;
                default:
                    labelValor.textContent = 'Valor';
                    inputValor.placeholder = 'Ingrese el valor';
            }
        };

        tipoSelect.addEventListener('change', updateLabel);
        updateLabel(); // Inicial
    });
</script>
@endsection
