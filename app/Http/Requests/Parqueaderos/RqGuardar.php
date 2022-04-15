<?php

namespace App\Http\Requests\Parqueaderos;

use App\Models\User;
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
        $isdRolesGuardia=User::role('Guardia')->pluck('id');
        return [
            'nombre' => 'required|string|max:255|unique:parqueaderos,nombre',
            'descripcion' => 'nullable|string|max:255',
            'guardias'    => 'nullable|array',
            'guardias.*'  => ['nullable',Rule::In($isdRolesGuardia)]

        ];
    }
}
