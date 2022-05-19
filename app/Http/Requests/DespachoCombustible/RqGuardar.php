<?php

namespace App\Http\Requests\DespachoCombustible;

use Illuminate\Foundation\Http\FormRequest;

class RqGuardar extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        return [
            'fecha'=>'required|date',
            'vehiculo'=>'required|exists:vehiculos,id',
            'numeroMovil'=>'required',
            'kilometraje'=>'numeric|gt:0',
            'conductor'=>'required|exists:users,id',
            'conductor_info'=>'required',
            'destino'=>'required|string|max:255',
            'concepto'=>'required|in:Gasolina extra,Gasolina Super,Diesel',
            'galones'=>'required|regex:'.$rg_decimal,
            'valor'=>'required|regex:'.$rg_decimal,
            'observaciones'=>'nullable|string|max:255',
            'cantidad_letras'=>'required|string|max:255',
            'valor_letras'=>'required|string|max:255',
            'noti'=>'nullable'

        ];
    }
}
