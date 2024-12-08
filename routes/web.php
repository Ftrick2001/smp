<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ExamController;


Route::get('/', function () {
    return view('welcome');
});


// Ruta para la vista con selector
Route::get('lecciones', [PeriodController::class, 'index']);

// Ruta para ver/obtener un periodo específico
Route::get('leccion/{period_id}', [PeriodController::class, 'show']);


// Ruta para la vista con selector
Route::get('examenes', [ExamController::class, 'index']);
Route::get('/examen/{id}', [ExamController::class, 'show'])->name('examen.show');
Route::post('/guardar-resultados', [ExamController::class, 'storeResult']);

// En routes/web.php
Route::get('/favicon.ico', function () {
    return response()->file(public_path('favicon.ico'));
});