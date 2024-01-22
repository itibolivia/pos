<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required',
            'activo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Coloque el nombre de categoría',
            'activo.required' => 'Elija un estado',
        ];
    }
}
