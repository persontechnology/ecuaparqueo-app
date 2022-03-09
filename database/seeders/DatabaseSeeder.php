<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\TipoVehiculo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // crear roles
        foreach (['SuperAdmin','SiteAdmin','Supervisor','Operador'] as $rol) {
            Role::updateOrCreate(['name' => $rol]);    
        }
        
        // permisos
        $permisos = array(
            'Usuarios',
            'Empresa',
            'Departamentos',
            'Vehículos',
            'Orden de Movilización'
        );
        foreach ($permisos as $per) {
            Permission::updateOrCreate(['name' => $per]);    
        }

        // crear super admin user
        $email_admin=env('SUPER_ADMIN_EMAIL','admin@ecuaparqueo.com');
        $user=User::where('email',$email_admin)->first();
        if(!$user){
            $user= User::Create([
                'name' => $email_admin,
                'email' => $email_admin,
                'password' => Hash::make($email_admin),
                'email_verified_at'=>now()
            ]);
        }
        $user->assignRole('SuperAdmin');

        // crear site admin user
        $email_site=env('SITE_ADMIN_EMAIL','site@ecuaparqueo.com');
        $user_site=User::where('email',$email_site)->first();
        if(!$user_site){
            $user_site= User::Create([
                'name' => $email_site,
                'email' => $email_site,
                'password' => Hash::make($email_site),
                'email_verified_at'=>now()
            ]);
        }
        $user_site->assignRole('SiteAdmin');

        // crear una empresa
        Empresa::updateOrCreate(['nombre' => config('app.name','ECUAPARQUEO')]);


        // crear tipos de vehiculos
        foreach (['Pesado', 'Liviano', 'Maquinaria', 'Motocicletas'] as $key) {
            TipoVehiculo::updateOrCreate(['nombre'=>$key]);
        }
    }
}
