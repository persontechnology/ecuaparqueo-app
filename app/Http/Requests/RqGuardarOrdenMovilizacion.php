<?php

namespace App\Http\Requests;

use App\Models\OrdenMovilizacion;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class RqGuardarOrdenMovilizacion extends FormRequest
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
        Validator::extend('verificarExistencia', function($attribute, $value, $parameters){
            $orden=OrdenMovilizacion::whereBetween('fecha_salida', [Carbon::parse($this->input('fecha_salida')), Carbon::parse($this->input('fecha_retorno'))])->first();  
            if($orden){
                if($orden->vehiculo->id==$this->input('vehiculo')){
                    return false;
                }
            }
            return true;

        },"No se puede ingresar orden de movilización con el vehículo, porque ya está asignada hasta esa hora.!");

        return [
            'fecha_salida'=>'required|date_format:Y/m/d H:i',
            'vehiculo'=>['required','verificarExistencia',Rule::exists('vehiculos','id')->where('estado','Activo')],
            'marcaVehiculo'=>'required|string',
            'servidor_publico'=>'required|string|max:255',
            'direccion'=>'required|string|max:255',
            'lugar_comision'=>'required|string|max:255',
            'motivo'=>'required|string|max:255',
            'fecha_retorno'=>'required|date_format:Y/m/d H:i'

        ];
    }
}
