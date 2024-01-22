<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompraRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fecha' => 'required',
            'pro' => 'required|array'
        ];
    }

    public function messages(){
        return [
            'fecha.required' => 'Es necesario indicar la fecha',
            'pro.required' => 'Coloque productos'
        ];
    }
}
