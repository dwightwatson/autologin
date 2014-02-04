<?php namespace Studious\Autologin;

use Illuminate\Support\ServiceProvider;
use Studious\Autologin\Autologin;

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
		$this->registerAutologinProvider();
		$this->registerAutologin();
	}

	protected function registerAutologinProvider()
	{
		$this->app['autologin.provider'] = $this->app->share(function($app)
		{
			$provider = $app['config']['autologin::provider'];

			return new $provider;
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
		$this->package('studious/autologin');

		include __DIR__.'/../../routes.php';
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