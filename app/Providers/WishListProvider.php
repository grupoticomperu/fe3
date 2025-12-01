<?php

namespace App\Providers;

use Darryldecode\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class WishListProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Registrar la primera instancia de carrito "compras"
        $this->app->singleton('cart_compras', function ($app) {
            $storage = $app['session'];
            $events = $app['events'];
            $instanceName = 'cart_compras';
            $sessionKey = 'compras_session_key';

            return new Cart(
                $storage,
                $events,
                $instanceName,
                $sessionKey
            );
        });

        // Registrar la segunda instancia de carrito "ventas"
        $this->app->singleton('cart_ventas', function ($app) {
            $storage = $app['session'];
            $events = $app['events'];
            $instanceName = 'cart_ventas';
            $sessionKey = 'ventas_session_key';

            return new Cart(
                $storage,
                $events,
                $instanceName,
                $sessionKey
            );
        });
    }
}
