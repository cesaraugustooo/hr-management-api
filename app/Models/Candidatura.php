<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Candidatura
 *
 * @property $id
 * @property $name
 * @property $contact_email
 * @property $telefone
 * @property $status
 * @property $vagas_id
 * @property $users_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Vaga $vaga
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Candidatura extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'contact_email', 'telefone', 'status', 'vagas_id', 'users_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vaga()
    {
        return $this->belongsTo(\App\Models\Vaga::class, 'vagas_id');
    }
    
}
