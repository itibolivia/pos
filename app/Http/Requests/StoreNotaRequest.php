<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nota' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nota.required' => 'Por favor coloque el nombre'
        ];
    }
}
