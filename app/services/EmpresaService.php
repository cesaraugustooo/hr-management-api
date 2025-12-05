<?php

namespace App\services;

use App\Http\Requests\AssociationCompanyRequest;
use App\Models\Empresa;
use Exception;

class EmpresaService
{
    public function associationCompanyHasUser($arrayUsers,Empresa $empresa){
        try {            
            $empresa->companyAssociation()->attach($arrayUsers);
            return $empresa->companyAssociation;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }   
}