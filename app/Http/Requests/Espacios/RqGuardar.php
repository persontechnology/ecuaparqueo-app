<?php

namespace App\Http\Requests\Espacios;

use App\Models\Parqueadero;
use App\Models\Vehiculo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'numero' => [
                'required',
                Rule::unique('espacios', 'numero')
               ->where('parqueadero_id', $this->get('parqueadero_id'))
            ],
            'parqueadero_id' => 'required|exists:parqueaderos,id',
            'vehiculo_id'  => 'nullable|exists:vehiculos,id'
        ];
    }
}
