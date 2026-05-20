<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePqrsRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nombres'    => ['required', 'string', 'min:2', 'max:100'],
            'apellidos'  => ['required', 'string', 'min:2', 'max:100'],
            'correo'     => ['required', 'email:rfc', 'max:180'],
            'rol'        => ['required', 'in:Cliente,Socio,Empleado'],
            'tipo_pqrs'  => ['required', 'in:Queja,Felicitacion,Recomendacion'],
            'comentario' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombres.required'    => 'El nombre es obligatorio.',
            'nombres.min'         => 'El nombre debe tener al menos 2 caracteres.',
            'apellidos.required'  => 'Los apellidos son obligatorios.',
            'apellidos.min'       => 'Los apellidos deben tener al menos 2 caracteres.',
            'correo.required'     => 'El correo electrónico es obligatorio.',
            'correo.email'        => 'Ingresa un correo electrónico válido.',
            'rol.required'        => 'Selecciona tu rol.',
            'rol.in'              => 'El rol seleccionado no es válido.',
            'tipo_pqrs.required'  => 'Selecciona el tipo de PQRS.',
            'tipo_pqrs.in'        => 'El tipo de PQRS no es válido.',
            'comentario.required' => 'El comentario es obligatorio.',
            'comentario.min'      => 'El comentario debe tener al menos 10 caracteres.',
            'comentario.max'      => 'El comentario no puede superar los 1000 caracteres.',
        ];
    }
}