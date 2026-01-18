<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vaga
 *
 * @property $id
 * @property $titulo
 * @property $descricao
 * @property $localizacao
 * @property $remoto
 * @property $tipo_contrato
 * @property $salario_min
 * @property $salario_max
 * @property $nivel_experiencia
 * @property $requisitos
 * @property $diferenciais
 * @property $carga_horaria_semanal
 * @property $beneficios
 * @property $status
 * @property $empresas_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Empresa $empresa
 * @property Candidatura[] $candidaturas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Vaga extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['titulo', 'descricao', 'localizacao', 'remoto', 'tipo_contrato', 'salario_min', 'salario_max', 'nivel_experiencia', 'requisitos', 'diferenciais', 'carga_horaria_semanal', 'beneficios', 'status', 'empresas_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo(\App\Models\Empresa::class, 'empresas_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function candidaturas()
    {
        return $this->hasMany(\App\Models\Candidatura::class, 'vagas_id');
    }
    
    public static function updateRule(){
        return [		'titulo' => 'sometimes|string',
			'descricao' => 'sometimes|string',
			'localizacao' => 'sometimes|string',
			'remoto' => 'sometimes',
			'tipo_contrato' => 'sometimes|string',
			'salario_min' => 'sometimes|numeric',
			'salario_max' => 'sometimes|numeric',
			'nivel_experiencia' => 'sometimes|string',
			'requisitos' => 'sometimes|string',
			'diferenciais' => 'sometimes|string',
			'carga_horaria_semanal' => 'sometimes|numeric',
			'beneficios' => 'string',
			'status' => 'sometimes|in:Aberta,Pausada,Cancelada,Preenchida',];
    }
}
