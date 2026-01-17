<?php

use App\Http\Controllers\Api\EmpresaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/me',function(Request $request){
    return $request->user()->load("empresaAdmin");
})->middleware('cookie-auth');

Route::apiResource('empresas', EmpresaController::class);
Route::post('/assoc-users/{empresa}',[EmpresaController::class, 'associationUser']);