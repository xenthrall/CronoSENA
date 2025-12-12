<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfExportController;

use App\Http\Controllers\HorarioController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/reportes/mensual/{month}/{year}', [PdfExportController::class, 'exportMonthlyExecutionsReport'])
    ->name('export.monthly_executions');



Route::get('/consultar-horario', [HorarioController::class, 'index'])
    ->name('horario.index'); // página con el formulario

Route::post('/consultar-horario', [HorarioController::class, 'buscar'])
    ->name('horario.buscar'); // procesa la búsqueda general

Route::get('/calendario/instructor/{id}', [HorarioController::class, 'calendarInstructor'])
    ->name('horario.instructor');

Route::get('/calendario/ficha/{id}', [HorarioController::class, 'calendarFicha'])
    ->name('horario.ficha');

Route::get('/calendario/ambiente/{id}', [HorarioController::class, 'calendarAmbiente'])
    ->name('horario.ambiente');
