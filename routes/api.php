<?php

use App\Http\Controllers\Api\CandidaturaController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\VagaController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('cookie-auth');

Route::post('/register',[AuthController::class,'register']);

Route::post('/login',[AuthController::class,'login']);

Route::middleware('cookie-auth')->group(function(){
    Route::apiResource('empresas', EmpresaController::class)->except(['index']);
    Route::post('/assoc-users/{empresa}',[EmpresaController::class, 'associationUser']);
    Route::apiResource('candidaturas', CandidaturaController::class);
    Route::post('/vagas/{empresa}',[VagaController::class,'store']);
    Route::apiResource('vagas', VagaController::class)->except('store');
    Route::apiResource('candidaturas', CandidaturaController::class);
});

