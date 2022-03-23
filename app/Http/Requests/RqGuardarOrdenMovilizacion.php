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
        ];
    }
}
