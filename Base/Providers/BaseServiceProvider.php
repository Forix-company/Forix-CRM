<?php

namespace Modules\Base\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Console\Scheduling\Schedule;
use Modules\Base\Console\Backup;
use Modules\Base\Console\FetchDataFromApiCity;
use Modules\Base\Console\FetchDataFromApiCountry;
use Modules\Base\Console\FetchDataFromApiStates;
use Modules\Base\Console\ProcessInventory;
use Modules\Base\Console\ProcessLocation;
use Modules\Base\Events\InstallModuleEvent;
use Modules\Base\Listeners\InstallModuleListener;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Base';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'base';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerCommands();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));


        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->command('backup:laravel')->daily()->runInBackground();
            $schedule->command('inventory:consulting')->everyMinute()->runInBackground();
            $schedule->command('fetch:country')->daily()->runInBackground();
            $schedule->command('fetch:states')->daily()->runInBackground();
            $schedule->command('fetch:city')->daily()->runInBackground();
        });

        //registro de eventos
        $this->app['events']->listen(InstallModuleEvent::class, InstallModuleListener::class);
    }

    /**
     * Registering the command
     *
     * @return void
     */

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Backup::class,
                ProcessInventory::class,
                FetchDataFromApiCity::class,
                FetchDataFromApiCountry::class,
                FetchDataFromApiStates::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
