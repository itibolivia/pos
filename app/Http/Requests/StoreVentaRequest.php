<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fecha' => 'required',
            'tipo' => 'required',
            'pago' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'fecha.required' => 'Fecha es necesario',
            'tipo.required' => 'Tipo es necesario',
            'pago.required' => 'Pago es necesario',
        ];
    }
}
