<?php

namespace App\Policies;

class AssociationGlobalPolicy {
    
    public static function verifyMember($empresa,$user){

        if($empresa->user_admin == $user->id){
            return true;
        }
    
        foreach($empresa->companyAssociation as $user_company){
            if($user_company->id == $user->id){
                return true;
            } 
        }
    }
}