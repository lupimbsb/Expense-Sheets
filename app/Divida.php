<?php

namespace Gastos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Divida extends Model
{

    protected $table = 'dividas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'criador_id', 'tipo_id', 'tipo_desc', 'data_referencia', 'valor'
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
    public function user()
    {
        return $this->belongsTo(User::class, 'criador_id', 'id');
    }

    /**
     * The method that relates this model with another.
     *
     * @return object
     */
    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    /**
     * The method that relates this model with another.
     *
     * @return object
     */
    public function devedores()
    {
        return $this->hasMany(Devedores::class);
    }

    /**
     * The method that cascade deletes related table devedores.
     *
     * @return void
     */
    public function delete()
    {
        DB::transaction(function () {
            $this->devedores()->delete();
            parent::delete();
        });
    }

    /**
     * The method that mutates the data_referencia to a valid date time.
     *
     * @param string $value
     * @return void
     */
    public function setDataReferenciaAttribute($value)
    {
        $this->attributes['data_referencia'] = date('Y-m-d H:i:s', strtotime(str_replace("/", "-", $value)));
    }

    /**
     * The method that mutates the data_referencia to a valid date time.
     *
     * @param string $value
     * @return void
     */
    public function getDataReferenciaAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
