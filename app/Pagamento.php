<?php

namespace Gastos;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Pagamento extends Authenticatable
{

    protected $table = 'pagamentos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valor', 'user_id', 'data_referencia'
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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * The method that mutates the valor to a valid date time.
     *
     * @param string $value
     * @return void
     */
    public function setValorAttribute($value)
    {
        $this->attributes['valor'] = str_replace(",", ".", str_replace(".", "", $value));
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
