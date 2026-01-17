<?php

namespace App\Services;
use App\Models\Vaga;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VagaService {
    use AuthorizesRequests;

    public function index(): object {

        $vagas = Vaga::with(['empresa'])->withCount('candidaturas')->paginate();
        
        return $vagas;
    } 
   
    public function create($data,$empresa): object {
        $this->authorize('create',[Vaga::class,$empresa]);

        $vaga = Vaga::create($data);

        return $vaga;
    }

    public function update($data,$vaga): object
    {
        $this->authorize('update',$vaga);

        $vaga->update($data);

        return $vaga;
    }

    public function destroy($vaga) 
    {
        $this->authorize('update',$vaga);

        $vaga->delete();
    }

    public function show($vaga){
        return Vaga::with('empresa')->withCount('candidaturas')->find($vaga);
    }
}