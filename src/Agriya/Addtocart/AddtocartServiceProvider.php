<?php namespace Agriya\Addtocart;

use Illuminate\Support\ServiceProvider;

class AddtocartServiceProvider extends ServiceProvider {

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
		$this->package('agriya/addtocart');
		include __DIR__.'/../../filters.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['addtocart'] = $this->app->share(function($app)
		{
			return new Addtocart;
		});
		$this->app->booting(function()
		{
		  	$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		  	$loader->alias('Addtocart', 'Agriya\Addtocart\Facades\Addtocart');
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
