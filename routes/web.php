<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;

Route::get('/', [DiagnosisController::class, 'form'])->name('form');
Route::post('/diagnosis', [DiagnosisController::class, 'diagnose'])->name('diagnosis');


