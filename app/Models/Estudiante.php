<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';

    protected $fillable = [
        'documento',
        'nombre_completo',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'ciudad_nacimiento',
        'departamento_nacimiento',
        'fecha_ingreso',
        'foto',

        'sexo',
        'edad',
        'peso',
        'altura',
        'talla_uniforme',
        'categoria',
        'modalidad_contrato',
        'sede',
        'precio_mensualidad',

        'otro_club',
        'nombre_otro_club',

        'nombre_padre',
        'documento_padre',
        'telefono_padre',
        'correo_padre',
        'direccion_padre',
        'departamento_padre',
        'ciudad_padre',

        'nombre_madre',
        'documento_madre',
        'telefono_madre',
        'correo_madre',
        'direccion_madre',
        'departamento_madre',
        'ciudad_madre',

        'sistema_salud',
        'nombre_eps',
        'medicina_prepagada',
        'entidad_medicina_prepagada',
        'enfermedad_grave',
        'enfermedad_respiratoria',
        'apto_deporte',
        'contacto_emergencia',
    ];

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }
}
