<?php

namespace App\Http\Requests;

use App\Models\OrdenMovilizacion;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class RqActualizarOrdenMovilizacion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        Validator::extend('verificarExistencia', function($attribute, $value, $parameters){
            $orden=OrdenMovilizacion::whereBetween('fecha_salida', [Carbon::parse($this->input('fecha_salida')), Carbon::parse($this->input('fecha_retorno'))])
            ->where('id','!=',$this->input('id_orden_parqueadero'))->first();  
            if($orden){
                if($orden->vehiculo->id==$this->input('vehiculo')){
                    return false;
                }
            }
            return true;

        },"No se puede actualizar orden de movilización con el vehículo, porque ya está asignada hasta esa hora.!");

        return [
            'id_orden_parqueadero'=>'required|verificarExistencia|exists:orden_movilizacions,id',
            'fecha_salida'=>'required|date_format:Y/m/d H:i',
            'vehiculo'=>['required',Rule::exists('vehiculos','id')->where('estado','Activo')],
            'marcaVehiculo'=>'required|string',
            'servidor_publico'=>'required|string|max:255',
            'direccion'=>'required|string|max:255',
            'lugar_comision'=>'required|string|max:255',
            'motivo'=>'required|string|max:255',
            'fecha_retorno'=>'required|date_format:Y/m/d H:i'
        ];
    }

    public function messages()
    {
        return [
            'vehiculo.exists'=>'El campo vehiculo seleccionado no existe, o está Inactivo'
        ];
    }
}
