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
use App\Models\Candidatura;
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

    public function index(Request $request, EmpresaService $empresaService)
    {
        $empresas = $empresaService->index();

        return EmpresaResource::collection($empresas);
    }

    
    public function store(EmpresaRequest $request, EmpresaService $empresaService): JsonResponse
    {
        $validate = array_merge($request->validated(),['user_admin'=>$request->user()->id]);

        $empresa = $empresaService->store($validate);

        return response()->json(new EmpresaResource($empresa));
    }

    
    public function show(Empresa $empresa): JsonResponse
    {
        $this->authorize('view',$empresa);

        return response()->json(new EmpresaResource($empresa));
    }

    
    public function update(Request $request, Empresa $empresa, EmpresaService $empresaService): JsonResponse
    {
        $validate = $request->validate(Empresa::updateRule());

        $empresa = $empresaService->update($validate,$empresa);

        return response()->json(new EmpresaResource($empresa));
    }

    
    public function destroy(Empresa $empresa, EmpresaService $empresaService): Response
    {
        $empresaService->destroy($empresa);

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
