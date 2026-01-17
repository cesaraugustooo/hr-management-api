<?php

namespace App\services;

use App\Http\Requests\AssociationCompanyRequest;
use App\Models\Empresa;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmpresaService
{
    use AuthorizesRequests;

    public function index(): object
    {
        $empresas = Empresa::with(['companyAssociation'])->paginate();

        return $empresas;
    }

    
    public function store($data): Empresa
    {
        $empresa = Empresa::create($data);

        return $empresa;
    }

    
    public function update($data,$empresa): Empresa
    {
        $this->authorize("update",$empresa);

        $empresa->update($data);

        return $empresa;
    }

    
    public function destroy($empresa)
    {
        $this->authorize("update",$empresa);

        $empresa->delete();

        return true;
    }


    public function associationCompanyHasUser($arrayUsers,Empresa $empresa){
        try {            
            $empresa->companyAssociation()->attach($arrayUsers);
            return $empresa->companyAssociation;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }   
}