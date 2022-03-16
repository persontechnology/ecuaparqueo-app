<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RqGuardarVehiculo extends FormRequest
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
        $regPlaca="/[A-Z]{3}-[0-9]{4}/";
        return [
            
            'placa'=>'required|string|max:255|unique:vehiculos,placa|regex:'.$regPlaca,
            'color'=>'required',
            'numero_chasis'=>'required|string|max:255',
            'estado'=>'required|in:Activo,Inactivo',
            'descripcion'=>'required|string|max:255',
            'foto'=>'nullable|image',
            'tipo'=>'required|exists:tipo_vehiculos,id',
            'kilometraje'=>'required|numeric|gt:0',
        ];
    }
    public function messages()
    {
        return [
            'placa.regex'=>'Placa formato incorrecto, ingrese Ej. XAC-0111'
        ];
    }
}
