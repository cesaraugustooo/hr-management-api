<?php

namespace App\Http\Controllers\Api;

use App\Models\Candidatura;
use Illuminate\Http\Request;
use App\Http\Requests\CandidaturaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CandidaturaResource;

class CandidaturaController extends Controller
{
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
        $candidatura = Candidatura::create($request->validated());

        return response()->json(new CandidaturaResource($candidatura));
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidatura $candidatura): JsonResponse
    {
        return response()->json(new CandidaturaResource($candidatura));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CandidaturaRequest $request, Candidatura $candidatura): JsonResponse
    {
        $candidatura->update($request->validated());

        return response()->json(new CandidaturaResource($candidatura));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Candidatura $candidatura): Response
    {
        $candidatura->delete();

        return response()->noContent();
    }
}
