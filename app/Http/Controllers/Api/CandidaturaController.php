<?php

namespace App\Http\Controllers\Api;

use App\Models\Candidatura;
use Illuminate\Http\Request;
use App\Http\Requests\CandidaturaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CandidaturaResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CandidaturaController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $candidaturas = Candidatura::paginate();

        return CandidaturaResource::collection($candidaturas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CandidaturaRequest $request): JsonResponse
    {
        $candidatura = Candidatura::create(array_merge($request->validated(),['users_id'=>$request->user()->id,'status'=>'Pendente']));

        return response()->json(new CandidaturaResource($candidatura));
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidatura $candidatura): JsonResponse
    {
        $this->authorize('view',$candidatura);

        return response()->json(new CandidaturaResource($candidatura->load('vaga.empresa')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidatura $candidatura): JsonResponse
    {
        $this->authorize('update',$candidatura);

        $candidatura->update($request->validate([
            'name' => 'sometimes|string',
			'contact_email' => 'sometimes|email',
			'telefone' => 'sometimes|string',
        ]));

        return response()->json(new CandidaturaResource($candidatura));
    }

    public function updateCandidaturaStatus(Request $request,Candidatura $candidatura){
        $this->authorize('updateCandidaturaStatus',$candidatura);

        $candidatura->update($request->validate([
            'status' => 'required|in:Pendente,Em analise,Aprovado, Reprovado',
        ]));

        return response()->json($candidatura);
    }
}
