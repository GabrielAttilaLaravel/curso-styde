<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
     * The p roperty on your model provides a convenient method of converting
     * attributes to common data types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean'
    ];

    public function findByEmail($email)
    {
        return static::where(compact('email'))->first();
    }
    
    public function isAdmin()
    {
        return $this->email === 'gabrieljmorenot@gmail.com';
    }
}
