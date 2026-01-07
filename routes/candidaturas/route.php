<?php

use App\Http\Controllers\Api\CandidaturaController;
use Illuminate\Support\Facades\Route;

Route::apiResource('candidaturas', CandidaturaController::class)->except('index');
Route::put('/empresas/candidatura/update/{candidatura}', [CandidaturaController::class, 'updateCandidaturaStatus']);
