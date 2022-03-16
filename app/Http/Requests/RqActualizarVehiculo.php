<?php

namespace App\Http\Requests;

use App\Models\Vehiculo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
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
        Validator::extend('existeVehiculoEnEspacio', function($attribute, $value, $parameters){
            $vehiculo=Vehiculo::findOrFail($this->input('id'));  
            
            if($this->input('estado')=='Inactivo'){
                if($vehiculo->espacios->count()>0){
                    return false;
                }
            }
            return true;

        },"El vehículo no se puede cambiar el estado a Inactivo, ya que está asignado a un espacio.");

        $regPlaca="/[A-Z]{3}-[0-9]{4}/";
        return [
            'id'=>'required|exists:vehiculos,id',
            'placa'=>'required|string|max:255|unique:vehiculos,placa,'.$this->input('id').'|regex:'.$regPlaca,
            'color'=>'required',
            'numero_chasis'=>'required|string|max:255',
            'descripcion'=>'required|string|max:255',
            'foto'=>'nullable|image',
            'tipo'=>'required|exists:tipo_vehiculos,id',
            'estado'=>'required|in:Activo,Inactivo|existeVehiculoEnEspacio'
        ];
    }

    public function messages()
    {
        return [
            'placa.regex'=>'Placa formato incorrecto, ingrese Ej. XAC-0111'
        ];

    }
}
