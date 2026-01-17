<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empresa
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $image_path
 * @property $user_admin
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property UsuariosHasEmpresa[] $usuariosHasEmpresas
 * @property Vaga[] $vagas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empresa extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'image_path', 'user_admin','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_admin');
    }

    public $hidden = [
        "remember_token",
        "email_verified_at"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
    // public function usuariosHasEmpresas()
    // {
    //     return $this->hasMany(\App\Models\UsuariosHasEmpresa::class, 'id', 'empresas_id');
    // }
    
    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function vagas()
    // {
    //     return $this->hasMany(\App\Models\Vaga::class, 'id', 'empresas_id');
    // }

    public function companyAssociation(){
        return $this->belongsToMany(User::class,'usuarios_has_empresas','empresas_id', 'users_id');
    }

    public static function updateRule(){
        return [
            'name' => 'sometimes|string',
			'email' => 'sometimes|string',
            'description'=>'sometimes|string'
        ];
    }
}
