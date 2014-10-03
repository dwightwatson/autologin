<?php namespace Watson\Autologin;

use Illuminate\Support\ServiceProvider;
use Watson\Autologin\Autologin;

class AutologinServiceProvider extends ServiceProvider {

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
		$this->bindAutologinInterface();
		$this->bindAuthenticationInterface();

		$this->registerAutologinProvider();
		$this->registerAutologin();
	}

	protected function bindAutologinInterface()
	{
		$this->app->bind('Watson\Autologin\Interfaces\AutologinInterface', function($app)
		{
			$provider = $app['config']['autologin::autologin_provider'];

			return new $provider;
		});
	}

	protected function bindAuthenticationInterface()
	{
		$this->app->bind('Watson\Autologin\Interfaces\AuthenticationInterface', function($app)
		{
			$provider = $app['config']['autologin::authentication_provider'];

			return new $provider;
		});
	}

	protected function registerAutologinProvider()
	{
		$this->app['autologin.provider'] = $this->app->share(function($app)
		{
			return $this->app->make('Watson\Autologin\Interfaces\AutologinInterface');
		});
	}

	protected function registerAutologin()
	{
		$this->app['autologin'] = $this->app->share(function($app)
		{
			return new Autologin($app['config'], $app['url'], $app['autologin.provider']);
		});
	}

	/**
	 * Boot the service provider.
	 * 
	 * @return void
	 */
	public function boot()
	{
		$this->package('watson/autologin', null, __DIR__);

		include __DIR__.'/routes.php';
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('autologin', 'autologin.provider');
	}

}