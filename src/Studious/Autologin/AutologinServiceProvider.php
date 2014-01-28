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
		$this->app->bind('autologin', function()
		{
			$config = $this->app->make('config');

			$url = $this->app->make('url');

			return new Autologin($config, $url);
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
		return array();
	}

}