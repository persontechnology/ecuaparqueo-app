<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class RqGuardarUsuario extends FormRequest
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
        $roles=Role::whereNotIn('name',['SuperAdmin'])->pluck('id');
        return [
            'apellidos'=>'required|string|max:255',
            'nombres'=>'required|string|max:255',
            'telefono'=>'required|string|max:255',
            'documento'=>'required|string|max:255',
            'cuidad'=>'required|string|max:255',
            'direccion'=>'required|string|max:255',
            'descripcion'=>'required|string|max:255',
            'foto'=>'nullable|image',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'estado'=>'required|in:Activo,Inactivo',
            'roles'    => 'required|array',
            'roles.*'  => ['required',Rule::in($roles)]
        ];
    }
}
