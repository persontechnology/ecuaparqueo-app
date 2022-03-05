<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizarVehiculo extends FormRequest
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
            'id'=>'required|exists:vehiculos,id',
            'placa'=>'required|string|max:255|unique:vehiculos,placa,'.$this->input('id'),
            'color'=>'required',
            'numero_chasis'=>'required|string|max:255',
            'estado'=>'required|in:Activo,Inactivo',
            'descripcion'=>'required|string|max:255',
            'foto'=>'nullable|image',
            'tipo'=>'required|exists:tipo_vehiculos,id'
        ];
    }
}
