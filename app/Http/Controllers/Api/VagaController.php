<?php

namespace App\Http\Controllers\Api;

use App\Models\Vaga;
use Illuminate\Http\Request;
use App\Http\Requests\VagaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\VagaResource;
use App\Models\Empresa;
use App\Services\VagaService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VagaController extends Controller
{
   
    public function index(Request $request, VagaService $vagaService)
    {
        $vagas = $vagaService->index();

        return VagaResource::collection($vagas);
    }

 
    public function store(VagaRequest $request,Empresa $empresa, VagaService $vagaService): JsonResponse
    {   
        $vaga = $vagaService->create(array_merge($request->validated(),['empresas_id' => $empresa->id]),$empresa);

        return response()->json(new VagaResource($vaga));
    }


    public function show(Vaga $vaga): JsonResponse
    {
        return response()->json(new VagaResource($vaga->load('empresa')));
    }


    public function update(Request $request, Vaga $vaga, VagaService $vagaService): JsonResponse
    {
        $vaga = $vagaService->update($request->validate(Vaga::updateRule()), $vaga);

        return response()->json(new VagaResource($vaga));
    }


    public function destroy(Vaga $vaga, VagaService $vagaService): Response
    {
        $vagaService->destroy($vaga);

        return response()->noContent();
    }
}
