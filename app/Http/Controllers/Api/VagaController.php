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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VagaController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vagas = Vaga::with(['empresa'])->paginate();

        return VagaResource::collection($vagas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VagaRequest $request,Empresa $empresa): JsonResponse
    {   
        $this->authorize('create',[Vaga::class,$empresa]);

        $vaga = Vaga::create(array_merge($request->validated(),['empresas_id' => $empresa->id]));

        return response()->json(new VagaResource($vaga));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaga $vaga): JsonResponse
    {
        return response()->json(new VagaResource($vaga->load('empresa')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vaga $vaga): JsonResponse
    {
        $this->authorize('update',$vaga);

        $vaga->update($request->validate(Vaga::updateRule()));

        return response()->json(new VagaResource($vaga));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Vaga $vaga): Response
    {
        $this->authorize('update',$vaga);

        $vaga->delete();

        return response()->noContent();
    }
}
