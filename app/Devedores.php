<?php

namespace Gastos;

use Illuminate\Database\Eloquent\Model;


class Devedores extends Model
{

    protected $table = 'devedores';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'divida_id', 'porcentagem'
    ];

    /**
     * The attributes that should be guarded.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The method that relates this model with another.
     *
     * @return object
     */
    public function divida()
    {
        return $this->belongsTo(Divida::class, 'divida_id', 'id');
    }
}
