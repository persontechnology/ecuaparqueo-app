<?php

namespace App\Http\Requests\Api\Lectura;

use App\Models\Vehiculo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class RqSalida extends FormRequest
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

        Validator::extend('VerificarVehiculo', function ($attribute, $value, $parameters, $validator) {

            $vehiculo=Vehiculo::where('numero_movil',$value)->orWhere('placa',$value)->first();

            $customMessage =$vehiculo?'':'No existe vehículo '.$value;


            $validator->addReplacer('VerificarVehiculo', 
                function($message, $attribute, $rule, $parameters) use ($customMessage) {
                    return \str_replace(':custom_message', $customMessage, $message);
                }
            );
            
            return $vehiculo?true:false;
        
        }, ':custom_message');

        return [
            'placaMovil'=>'required|VerificarVehiculo',
            'codigoBrazo'=>'required|exists:brazos,codigo',
        ];
    }
}
