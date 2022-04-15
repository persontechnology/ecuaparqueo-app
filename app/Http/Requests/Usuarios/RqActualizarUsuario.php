<?php

namespace App\Http\Requests\Usuarios;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RqActualizarUsuario extends FormRequest
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
        $roles=Role::whereIn('name',['SuperAdmin'])->pluck('id');
        $idAdmin=User::find($this->input('id'));
        $validate="";
        if($idAdmin->hasRole('SuperAdmin')){
            $validate="not_in:".$idAdmin->id;
        }
        return [
            'id'=>'required|exists:users,id|'.$validate,
            'apellidos'=>'required|string|max:255',
            'nombres'=>'required|string|max:255',
            'telefono'=>'required|string|max:255',
            'documento'=>'required|string|max:255',
            'cuidad'=>'required|string|max:255',
            'direccion'=>'required|string|max:255',
            'descripcion'=>'required|string|max:255',
            'foto'=>'nullable|image',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->input('id'),
            'estado'=>'required|in:Activo,Inactivo',
            'roles'    => 'required|array',
            'roles.*'  => ['required',Rule::notIn($roles)]
        ];
    }
}
