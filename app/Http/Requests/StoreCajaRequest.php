<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCajaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'monto' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'monto.required' => 'Por favor coloque el monto'
        ];
    }
}
