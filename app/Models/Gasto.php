<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    public const SEDE_ENVIGADO = 'envigado';
    public const SEDE_ITAGUI   = 'itagui';


    protected $table = 'gastos';

    protected $fillable = [
        'fecha',
        'nit',
        'nombre',
        'concepto',
        'sede',
        'valor',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];
}
