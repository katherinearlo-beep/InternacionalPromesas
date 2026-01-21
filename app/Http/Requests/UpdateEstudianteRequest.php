<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEstudianteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'documento' => [
                'required',
                Rule::unique('estudiantes', 'documento')
                    ->ignore($this->route('estudiante')),
            ],
            'nombre_completo' => 'required|string',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'fecha_nacimiento' => 'required|date',
            'ciudad_nacimiento' => 'required|string',
            'departamento_nacimiento' => 'required|string',
            'fecha_ingreso' => 'required|date',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'sexo' => 'nullable|string',
            'edad' => 'nullable|numeric',
            'talla_uniforme' => 'nullable|string',
            'categoria' => 'nullable|string',
            'modalidad_contrato' => 'nullable|in:mensual,becado_50,becado_100',
            'sede' => 'nullable|string',
            'precio_mensualidad' => 'nullable|numeric',

            'otro_club' => 'nullable|boolean',
            'nombre_otro_club' => 'nullable|string',

            'nombre_padre' => 'nullable|string',
            'documento_padre' => 'nullable|string',
            'telefono_padre' => 'nullable|string',
            'correo_padre' => 'nullable|email',
            'direccion_padre' => 'nullable|string',
            'departamento_padre' => 'nullable|string',
            'ciudad_padre' => 'nullable|string',

            'nombre_madre' => 'nullable|string',
            'documento_madre' => 'nullable|string',
            'telefono_madre' => 'nullable|string',
            'correo_madre' => 'nullable|email',
            'direccion_madre' => 'nullable|string',
            'departamento_madre' => 'nullable|string',
            'ciudad_madre' => 'nullable|string',

            'sistema_salud' => 'nullable|string',
            'nombre_eps' => 'nullable|string',
            'medicina_prepagada' => 'nullable|boolean',
            'entidad_medicina_prepagada' => 'nullable|string',
            'enfermedad_grave' => 'nullable|boolean',
            'enfermedad_respiratoria' => 'nullable|boolean',
            'apto_deporte' => 'nullable|boolean',
            'contacto_emergencia' => 'nullable|string',
        ];
    }
}
