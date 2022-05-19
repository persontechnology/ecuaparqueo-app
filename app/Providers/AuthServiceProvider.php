<?php

namespace App\Providers;

use App\Models\DespachoCombustible;
use App\Models\Empresa;
use App\Policies\DespachoCombustiblePolicy;
use App\Policies\EmpresaPolicy;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Role::class=>RolePolicy::class,
        DespachoCombustible::class=>DespachoCombustiblePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //para acceso al super admin y site admin
        Gate::before(function ($user, $ability) {
            return $user->hasRole(['SuperAdmin','SiteAdmin']) ? true : null;
        });
    }
}
