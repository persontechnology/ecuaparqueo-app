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
        
        Validator::extend('verificarExistencia', function($attribute, $value, $parameters,$validator){
            
            $request=request();

            $startDate  = Carbon::parse($request->fecha_salida)->format('Y-m-d H:i:s');
            $endDate = Carbon::parse($request->fecha_retorno)->format('Y-m-d H:i:s');

            $orden=OrdenMovilizacion::where('vehiculo_id',$request->vehiculo)->whereBetween('fecha_salida', [$startDate, $endDate])
                ->whereBetween('fecha_retorno', [$startDate, $endDate])
                ->exists();

            $customMessage=$orden?'Vehículo ya se encuentra registrado con estas fechas en la orden':'';

            $validator->addReplacer('verificarExistencia', 
                function($message, $attribute, $rule, $parameters) use ($customMessage) {
                    return \str_replace(':custom_message', $customMessage, $message);
                }
            );

            return $orden?false:true;

        },"Error.! :custom_message");

        return [
            'fecha_salida'=>'required|date_format:Y/m/d H:i',
            'fecha_retorno'=>'required|date_format:Y/m/d H:i',
            'numero_ocupantes'=>'required|numeric|gt:0',
            'vehiculo'=>['required',Rule::exists('vehiculos','id')->where('estado','Activo')],
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
