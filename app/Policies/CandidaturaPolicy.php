<?php

namespace App\Policies;

use App\Models\Candidatura;
use App\Models\Empresa;
use App\Models\User;
use App\Models\Vaga;
use Illuminate\Auth\Access\Response;

use function PHPUnit\Framework\returnArgument;

class CandidaturaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Candidatura $candidatura): bool
    {
        $empresa = $candidatura->vaga->empresa;

        if (AssociationGlobalPolicy::verifyMember($empresa, $user)) {
            return true;
        }
        
        return $user->id == $candidatura->users_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Candidatura $candidatura): bool
    {
        return $user->id == $candidatura->users_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Candidatura $candidatura): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Candidatura $candidatura): bool
    {
        return false;
    }

     public function updateCandidaturaStatus(User $user, Candidatura $candidatura): bool
    {
        $empresa = $candidatura->vaga->empresa;

       if (AssociationGlobalPolicy::verifyMember($empresa, $user)) {
            return true;
        }
        
        return false;
    }
}
