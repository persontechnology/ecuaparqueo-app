<?php

namespace App\Http\Requests\OrdenMovilizacion\Control;

use App\Models\OrdenMovilizacion;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RqAprobarReprobarGuardar extends FormRequest
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
            $orden=OrdenMovilizacion::where('vehiculo_id',$this->input('vehiculo'))
            ->where('id','!=',$this->input('id_orden_parqueadero'))
            ->whereBetween('fecha_salida', [Carbon::parse($this->input('fecha_salida')), Carbon::parse($this->input('fecha_retorno'))])
            
            ->first();  
            return $orden?false:true;
        },'No se puede ACEPTAR/DENEGAR orden de movilización, ya que existe el vehículo asigando en esa fecha.!');

        return [
            'id_orden_parqueadero'=>[
                'required',
                Rule::exists('orden_movilizacions','id')->whereNotIn('estado',['OCUPADO','FINALIZADO'])
            ],
            'fecha_salida'=>'required|date_format:Y/m/d H:i',
            'fecha_retorno'=>'required|date_format:Y/m/d H:i',
            'numero_ocupantes'=>'required|numeric|gt:0',
            'vehiculo'=>['required','verificarExistencia',Rule::exists('vehiculos','id')->where('estado','Activo')],
            'numeroMovil'=>'nullable|string|max:255',
            'marca'=>'nullable|string|max:255',
            'modelo'=>'nullable|string|max:255',
            'placa'=>'nullable|string|max:255',
            'tipo'=>'nullable|string|max:255',
            'color'=>'required|string|max:255',
            'procedencia'=>'required|string|max:255',
            'destino'=>'required|string|max:255',
            'comision_cumplir'=>'required|string|max:255',
            'conductor'=>'nullable|exists:users,id',
            'conductor_info'=>'nullable|string|max:255',
            'solicitante'=>'nullable|exists:users,id',
            'solicitante_info'=>'nullable|string|max:255',
            'accion'=>'required|in:ACEPTADA,DENEGADA'
        ];
    }

    public function messages()
    {
        return [
            'vehiculo.exists'=>'El campo vehiculo seleccionado no existe, o está Inactivo',
            'id_orden_parqueadero.exists'=>'No se puede ACEPTAR/DENEGAR orden de movilización porque no existe, o está en estado OCUPADO,FINALIZADO.'
        ];
    }
}
