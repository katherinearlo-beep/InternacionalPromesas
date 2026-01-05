<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $fillable = [
        'ingreso_id',
        'numero',
        'fecha',
        'valor',
    ];

    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class);
    }
}
