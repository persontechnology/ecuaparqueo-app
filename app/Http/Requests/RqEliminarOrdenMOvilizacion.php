<?php

namespace App\Http\Requests;

use App\Models\OrdenMovilizacion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RqEliminarOrdenMOvilizacion extends FormRequest
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
        return [
            'id'=>['required',Rule::exists('orden_movilizacions','id')->where('estado','SOLICITADO')],
        ];
    }

    function messages()
    {
        return [
            'id.exists'=>'No se puede eliminar orden de movilización.'
        ];
    }
}
