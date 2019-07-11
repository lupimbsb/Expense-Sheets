<?php

namespace Gastos;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password'
    ];

    /**
     * The attributes that should be guarded.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * The method that relates this model with another.
     *
     * @return object
     */
    public function dividas()
    {
        return $this->hasMany('Gastos/Divida');
    }
}
