<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfExportController;

use App\Http\Controllers\HorarioController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/reportes/mensual/{month}/{year}', [PdfExportController::class, 'exportMonthlyExecutionsReport'])
    ->name('export.monthly_executions');



Route::controller(HorarioController::class)->group(function () {

    Route::get('/consultar-horario', 'index')
        ->name('horario.index');

    Route::post('/consultar-horario', 'buscar')
        ->name('horario.buscar');

    Route::prefix('calendario')->name('horario.')->group(function () {
        Route::get('/instructor/{id}', 'calendarInstructor')->name('instructor');
        Route::get('/ficha/{id}', 'calendarFicha')->name('ficha');
        Route::get('/ambiente/{id}', 'calendarAmbiente')->name('ambiente');
    });

});
