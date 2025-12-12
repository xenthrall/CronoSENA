<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HorarioApiController;


Route::prefix('events')->group(function () {
    Route::get('/instructor/{id}', [HorarioApiController::class, 'eventsInstructor']);
    Route::get('/ficha/{id}', [HorarioApiController::class, 'eventsFicha']);
    Route::get('/ambiente/{id}', [HorarioApiController::class, 'eventsAmbiente']);
});
