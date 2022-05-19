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
        
        $regPlaca="/^([A-Z]){3}-[0-9]{4}$/";
        return [
            'numero_movil'=>'required|numeric|gt:0|unique:vehiculos,numero_movil',
            'modelo'=>'nullable|string|max:255',
            'marca'=>'nullable|string|max:255',
            'placa'=>'required|string|max:255|unique:vehiculos,placa|regex:'.$regPlaca,
            'color'=>'nullable|string|max:255',
            'conductor'=>'nullable|exists:users,id',
            'conductorInfo'=>'nullable|string|max:255',
            'estado'=>'required|in:Activo,Inactivo',
            'descripcion'=>'nullable|string|max:255',
            'foto'=>'nullable|image',
            'tipoVehiculo'=>'required|exists:tipo_vehiculos,id',
            'tipo'=>'required|in:Normal,Invitados,Especial',
            'kilometraje'=>'required|numeric|gt:0',
            'imei'=>'nullable|string|max:255',
            'codigo_tarjeta'=>'nullable|unique:vehiculos,codigo_tarjeta|unique:empresas,codigo_tarjeta_vehiculo_invitado'
        ];
    }
    public function messages()
    {
        return [
            'placa.regex'=>'Placa formato incorrecto, ingrese Ej. XAC-0111'
        ];
    }
}
