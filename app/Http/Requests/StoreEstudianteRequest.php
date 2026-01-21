<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstudianteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            // ===== ESTUDIANTE =====
            'documento' => 'required|string|unique:estudiantes,documento',
            'nombre_completo' => 'required|string',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'fecha_nacimiento' => 'required|date',
            'ciudad_nacimiento' => 'required|string',
            'departamento_nacimiento' => 'required|string',
            'fecha_ingreso' => 'required|date',

            // ===== FOTO =====
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // ===== INFO DEPORTIVA =====
            'sexo' => 'nullable|string',
            'edad' => 'nullable|integer',
            'talla_uniforme' => 'nullable|string',
            'categoria' => 'nullable|string',
            'modalidad_contrato' => 'nullable|in:mensual,becado_50,becado_100',
            'sede' => 'nullable|string',
            'precio_mensualidad' => 'nullable|numeric',

            // ===== HISTORIAL =====
            'otro_club' => 'nullable|boolean',
            'nombre_otro_club' => 'nullable|string',

            // ===== PADRE =====
            'nombre_padre' => 'nullable|string',
            'documento_padre' => 'nullable|string',
            'telefono_padre' => 'nullable|string',
            'correo_padre' => 'nullable|email',
            'direccion_padre' => 'nullable|string',
            'departamento_padre' => 'nullable|string',
            'ciudad_padre' => 'nullable|string',

            // ===== MADRE =====
            'nombre_madre' => 'nullable|string',
            'documento_madre' => 'nullable|string',
            'telefono_madre' => 'nullable|string',
            'correo_madre' => 'nullable|email',
            'direccion_madre' => 'nullable|string',
            'departamento_madre' => 'nullable|string',
            'ciudad_madre' => 'nullable|string',

            // ===== MÉDICOS =====
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
    
    public function messages(): array
    {
        return [
            'documento.unique' => 'El estudiante ya se encuentra registrado.',
            'documento.required' => 'El campo documento es obligatorio.',
        ];
    }
}
