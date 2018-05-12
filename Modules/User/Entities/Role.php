<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

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
     * @return HasMany
     */
    public function users() 
    {
        return $this->hasMany(User::class);
    }

    /**
     * 
     * @return Role
     */
    public static function admin() 
    {
        return self::where('slug', 'admin')
            ->first();
    }
}
