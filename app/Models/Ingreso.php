<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $fillable = [
        'estudiante_id',
        'concepto',
        'mes_correspondiente',
        'valor',
        'medio_pago',
        'fecha',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function recibo()
    {
        return $this->hasOne(Recibo::class);
    }
}
