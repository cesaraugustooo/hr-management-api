<?php

namespace App\Http\Controllers\Api;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssociationCompanyRequest;
use App\Http\Resources\EmpresaResource;
use App\services\EmpresaService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmpresaController extends Controller
{
    use AuthorizesRequests;
    private $empresaService;

    public function __construct() {
        $this->empresaService = new EmpresaService();
    }

    /**
     *  @OA\Get(
     *     path="/api/empresas",
     *     summary="Rota de teste",
     *     @OA\Response(response=200, description="Sucesso")
     * )
     */
    public function index(Request $request)
    {
        $empresas = Empresa::paginate();

        return EmpresaResource::collection($empresas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request): JsonResponse
    {
        $empresa = Empresa::create($request->validated());

        return response()->json(new EmpresaResource($empresa));
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa): JsonResponse
    {
        $this->authorize('view',$empresa);

        return response()->json(new EmpresaResource($empresa));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpresaRequest $request, Empresa $empresa): JsonResponse
    {
        $empresa->update($request->validated());

        return response()->json(new EmpresaResource($empresa));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Empresa $empresa): Response
    {
        $empresa->delete();

        return response()->noContent();
    }

    public function associationUser(AssociationCompanyRequest $request,Empresa $empresa){
        $this->authorize('associationRule',$empresa);

        try {    
            $arrayUsers = $request->validated(); 
    
            $this->empresaService->associationCompanyHasUser($arrayUsers['users'],$empresa);
        } catch (Exception $e) {
            return response()->json(['message'=>'Erro ao associar usuarios a esta empresa'],400);
        }
    }
}
