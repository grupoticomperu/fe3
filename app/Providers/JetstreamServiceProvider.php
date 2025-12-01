<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
//use Illuminate\Support\Facades\Route;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        // Aplicar el middleware globalmente a Jetstream
        /* Route::middleware(SwitchTenantDatabase::class)
        ->group(function () {
            $this->loadRoutesFrom(base_path('routes/web.php'));
        }); */

        // Aplica el middleware a las rutas de Jetstream y Fortify
   /*      Route::group([
            'middleware' => [SwitchTenantDatabase::class],
            'namespace' => 'Laravel\Fortify\Http\Controllers',
            'prefix' => config('fortify.prefix', ''),
        ], function () {
            $this->loadRoutesFrom(base_path('routes/fortify.php'));
        }); */

        // Carga las rutas web normales
      /*   Route::group([
            'middleware' => [SwitchTenantDatabase::class],
        ], function () {
            $this->loadRoutesFrom(base_path('routes/web.php'));
        }); */


    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}