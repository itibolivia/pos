<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required', 
            'precio' => 'required|numeric', 
            'categoria_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Coloque un nombre',
            'precio.required' => 'Coloque un precio',
            'precio.numeric' => 'El precio es de sólo números',
            'categoria_id.required' => 'Seleccione una categoría',
        ];
    }
}
