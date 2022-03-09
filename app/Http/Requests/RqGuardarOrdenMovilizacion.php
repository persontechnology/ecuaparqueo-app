<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

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
        $no_roles = Role::where('name', ['SuperAdmin', 'SiteAdmin'])->get();
        $model=User::role($no_roles)->pluck('id');
        return [
            'fecha_salida'=>'required|date',
            'conductor'=>['required','exists:users,id',Rule::notIn($model)],
            'conductorUser'=>'required|string',
            'vehiculo'=>['required',Rule::exists('vehiculos','id')->where('estado','Activo')],
            'marcaVehiculo'=>'required|string',
            'servidor_publico'=>'required|string|max:255',
            'direccion'=>'required|string|max:255',
            'lugar_comision'=>'required|string|max:255',
            'motivo'=>'required|string|max:255',
            'hora_salida'=>'required|date_format:H:i',
            'hora_retorno'=>'required|date_format:H:i|after_or_equal:hora_salida',

        ];
    }

    public function messages()
    {
        return [
            'vehiculo.exists'=>'El campo vehiculo seleccionado no existe, o está Inactivo'
        ];
    }
}
