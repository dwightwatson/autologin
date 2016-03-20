<?php 

namespace Watson\Autologin;

use Illuminate\Support\ServiceProvider;
use Watson\Autologin\Autologin;
use Watson\Autologin\Interfaces\AutologinInterface;
use Watson\Autologin\Interfaces\AuthenticationInterface;

class AutologinServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'autologin');

        $this->bindAutologinInterface();
        $this->bindAuthenticationInterface();

        $this->registerAutologinProvider();
        $this->registerAutologin();
    }

    /**
     * Bind the autologin provider to the interface.
     *
     * @return void
     */
    protected function bindAutologinInterface()
    {
        $this->app->bind(AutologinInterface::class, function ($app) {
            $provider = $app['config']['autologin.autologin_provider'];

            return new $provider;
        });
    }

    /**
     * Bind the authentication provider to the interface.
     *
     * @return void
     */
    protected function bindAuthenticationInterface()
    {
        $this->app->bind(AuthenticationInterface::class, function ($app) {
            $provider = $app['config']['autologin.authentication_provider'];

            return new $provider;
        });
    }

    /**
     * Register the autologin provider in the IoC container.
     *
     * @return void
     */
    protected function registerAutologinProvider()
    {
        $this->app['autologin.provider'] = $this->app->share(function ($app) {
            return $this->app->make(AutologinInterface::class);
        });
    }

    /**
     * Register the autologin manager with the IoC container.
     *
     * @return void
     */
    protected function registerAutologin()
    {
        $this->app['autologin'] = $this->app->share(function ($app) {
            return new Autologin($app['url'], $app['autologin.provider']);
        });
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('autologin.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/migrations/' => base_path('/database/migrations')
        ], 'migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'autologin', 
            'autologin.provider',
            AutologinInterface::class,
            AuthenticationInterface::class
        ];
    }
}
