<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfExportController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/reportes/mensual/{month}/{year}', [PdfExportController::class, 'exportMonthlyExecutionsReport'])
    ->name('export.monthly_executions');