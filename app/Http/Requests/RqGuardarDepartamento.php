<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class RqGuardarDepartamento extends FormRequest
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
        $users=User::role('Supervisor')->pluck('id');
        return [
            'nombre'=>'required|string|max:255|unique:departamentos,nombre',
            'descripcion'=>'nullable|string|max:255',
            'supervisor'  => ['required',Rule::in($users)]

        ];
    }
}
