<?php

namespace Modules\User\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug'
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Escopo de papéis permitidos para o usuário indicado.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Modules\User\Entities\User  $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfUser($query, User $user)
    {
        // Todos os papéis para administrador.
        if ($user->isAdmin()) {
            return $query;
        }
        
        return $query->where('slug', '!=', 'admin');
    }
}
