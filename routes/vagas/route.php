<?php

use App\Http\Controllers\Api\VagaController;
use Illuminate\Support\Facades\Route;

Route::post('/vagas/{empresa}', [VagaController::class, 'store']);
Route::apiResource('vagas', VagaController::class)->except('store');
