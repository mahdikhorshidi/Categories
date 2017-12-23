<?php

declare(strict_types=1);

namespace mahdikhorshidi\categories\Providers;

use Illuminate\Support\ServiceProvider;
use mahdikhorshidi\categories\Contracts\CategoryContract;
use mahdikhorshidi\categories\Console\Commands\MigrateCommand;

class CategoriesServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.mahdikhorshidi.categories.migrate',
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/config.php'), 'mahdikhorshidi.categories');

        // Bind eloquent models to IoC container
        $this->app->singleton('mahdikhorshidi.categories.category', function ($app) {
            return new $app['config']['mahdikhorshidi.categories.models.category']();
        });
        $this->app->alias('mahdikhorshidi.categories.category', CategoryContract::class);

        // Register console commands
        ! $this->app->runningInConsole() || $this->registerCommands();
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        // Load migrations
        ! $this->app->runningInConsole() || $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        // Publish Resources
        ! $this->app->runningInConsole() || $this->publishResources();
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    protected function publishResources()
    {
        $this->publishes([realpath(__DIR__.'/../../config/config.php') => config_path('mahdikhorshidi.categories.php')], 'mahdikhorshidi-categories-config');
        $this->publishes([realpath(__DIR__.'/../../database/migrations') => database_path('migrations')], 'mahdikhorshidi-categories-migrations');
    }

    /**
     * Register console commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        // Register artisan commands
        foreach ($this->commands as $key => $value) {
            $this->app->singleton($value, function ($app) use ($key) {
                return new $key();
            });
        }

        $this->commands(array_values($this->commands));
    }
}
