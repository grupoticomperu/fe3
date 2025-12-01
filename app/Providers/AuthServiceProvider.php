<?php

namespace App\Providers;

use Illuminate\Auth\RequestGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Sale' => 'App\Policies\SalePolicy',
        'App\Models\Shopping' => 'App\Policies\ShoppingPolicy',
        'App\Models\Inventory' => 'App\Policies\InventoryPolicy',
        'App\Models\Initialinventory' => 'App\Policies\InitialinventoryPolicy',
        'App\Models\Brand' => 'App\Policies\BrandPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Configuration' => 'App\Policies\ConfigurationPolicy',
        'App\Models\Modelo' => 'App\Policies\ModeloPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
        'Spatie\Permission\Models\Permission' => 'App\Policies\PermissionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* Auth::viaRequest('web', function ($request) {
            $companyId = $request->user()->employee->company->id;
            return new RequestGuard(function ($request) use ($companyId) {
                return Auth::guard($companyId);
            }, $request);
        }); */


        Auth::viaRequest('web', function ($request) {
            $companyId = $request->user()->employee->company->id;
            $guardName = 'company_'.$companyId;

            // Verificar si el guardia ya está definido
            if (!Auth::guard($guardName)->getProvider()) {
                // Si no está definido, definir el guardia dinámicamente
                config(["auth.guards.$guardName" => [
                    'driver' => 'session',
                    'provider' => 'users',
                ]]);
            }

            return Auth::guard($guardName);
        });



    }
}
