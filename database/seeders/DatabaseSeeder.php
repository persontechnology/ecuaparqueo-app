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
        foreach (['SuperAdmin','SiteAdmin','Supervisor','Operador','Guardia','Despachador'] as $rol) {
            Role::updateOrCreate(['name' => $rol]);    
        }
        
        // permisos
        $permisos = array(
            'Usuarios',
            'Empresa',
            'Estación de servicios',
            'Departamentos',
            'Vehículos',
            'Parqueaderos',
            'Estacionamientos',
            'Vista Parqueadero',
            'Mis Parqueaderos',
            'Orden de Movilización',
            'Control Orden de Movilización',
            'Despacho de combustible',
            'Lecturas entradas y salidas'
        );
        foreach ($permisos as $per) {
            Permission::updateOrCreate(['name' => $per]);    
        }

       
        // crear super admin user
        $email_admin=config('app.SUPER_ADMIN_EMAIL');
        $password_admin=config('app.SUPER_ADMIN_PASSWORD');
        $user=User::where('email',$email_admin)->first();
        if(!$user){
            $user= User::Create([
                'name' => $email_admin,
                'email' => $email_admin,
                'password' => Hash::make($password_admin),
                'email_verified_at'=>now()
            ]);
        }
        $user->assignRole('SuperAdmin');

        // crear site admin user
        $email_site=config('app.SITE_ADMIN_EMAIL');
        $password_site=config('app.SITE_ADMIN_PASSWORD','');
        $user_site=User::where('email',$email_site)->first();
        if(!$user_site){
            $user_site= User::Create([
                'name' => $email_site,
                'email' => $email_site,
                'password' => Hash::make($password_site),
                'email_verified_at'=>now()
            ]);
        }
        $user_site->assignRole('SiteAdmin');

        // crear una empresa
        Empresa::updateOrCreate([
            'nombre' => config('app.name','ECUAPARQUEO'),
            'url_web_gps'=>config('app.HOST_WEB_SERVICE_GPS'),
            'token'=>config('app.SECURITY_TOKEN_WEB_SERVICE_GPS')
        ]);


        // crear tipos de vehiculos
        foreach (['Pesado', 'Liviano', 'Maquinaria', 'Motocicletas'] as $key) {
            TipoVehiculo::updateOrCreate(['nombre'=>$key]);
        }
    }
}
