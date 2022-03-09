<?php

namespace App\Http\Requests\Parqueaderos;

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

        return [
            'nombre' => 'required|string|max:255|unique:departamentos,nombre',
            'descripcion' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'numero_total'=>'required',

        ];
    }
}
