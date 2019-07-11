<?php

namespace Gastos;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Tipo extends Authenticatable
{

    protected $table = 'tipos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao'
    ];

    /**
     * The attributes that should be guarded.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
