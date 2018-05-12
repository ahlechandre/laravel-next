<?php

namespace Modules\User\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 
     * @return BelongsTo
     */
    public function role() 
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * 
     * @param string $value
     * @return void
     */
    protected function setPasswordAttribute($value) 
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
