<?php namespace Jrenton\Laravel5Scaffold;

use Illuminate\Support\ServiceProvider;

class Laravel5ScaffoldServiceProvider extends ServiceProvider {

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
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('laravel5scaffold.php')
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['scaffold'] = $this->app->share(function($app)
        {
            return new ScaffoldCommand($app);
        });

        $this->app['scaffold.file'] = $this->app->share(function($app)
        {
            return new ScaffoldFromFileCommand($app);
        });

        $this->app['scaffold.model'] = $this->app->share(function($app)
        {
            return new ScaffoldModelCommand($app);
        });

        $this->app['scaffold.update'] = $this->app->share(function($app)
        {
            return new ScaffoldUpdateCommand($app);
        });

        $this->commands('scaffold', 'scaffold.file', 'scaffold.model', 'scaffold.update');
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
