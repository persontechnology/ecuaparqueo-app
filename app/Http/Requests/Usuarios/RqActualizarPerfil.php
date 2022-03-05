<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizarPerfil extends FormRequest
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
            
            'apellidos'=>'required|string|max:255',
            'nombres'=>'required|string|max:255',
            'telefono'=>'required|string|max:255',
            'documento'=>'required|string|max:255',
            'cuidad'=>'required|string|max:255',
            'direccion'=>'required|string|max:255',
            'descripcion'=>'required|string|max:255',
            'foto'=>'nullable|image',
        ];
    }
}
