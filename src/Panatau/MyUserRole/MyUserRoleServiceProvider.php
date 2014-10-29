<?php namespace Panatau\MyUserRole;

use Illuminate\Support\ServiceProvider;
use Panatau\MyUserRole\Storage\MyUserRole;

class MyUserRoleServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('panatau/my-user-role');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['MyUserRole'] = $this->app->share(function($app)
        {
            return new \Panatau\MyUserRole\Storage\MyUserRole;
        });
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
