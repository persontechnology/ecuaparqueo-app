<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    use HandlesAuthorization;

    public function eliminar(User $user, Role $role)
    {
        if($role->permissions->count()>0){
            return false;
        }

        if($role->name=='SuperAdmin' || $role->name=='SiteAdmin'){
            return false;
        }
        return true;

    }

}
