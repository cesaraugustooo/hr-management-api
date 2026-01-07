<?php

use App\Http\Controllers\Api\EmpresaController;
use Illuminate\Support\Facades\Route;

Route::apiResource('empresas', EmpresaController::class);
Route::post('/assoc-users/{empresa}',[EmpresaController::class, 'associationUser']);