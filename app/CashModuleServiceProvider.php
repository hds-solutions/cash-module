<?php

namespace HDSSolutions\Finpar;

use HDSSolutions\Laravel\Modules\ModuleServiceProvider;

class CashModuleServiceProvider extends ModuleServiceProvider {

    protected array $middlewares = [
        \HDSSolutions\Finpar\Http\Middleware\CashMenu::class,
    ];

    private $commands = [
        // \HDSSolutions\Finpar\Commands\Mix::class,
    ];

    public function bootEnv():void {
        // enable config override
        $this->publishes([
            module_path('config/cash.php') => config_path('cash.php'),
        ], 'cash.config');

        // load routes
        $this->loadRoutesFrom( module_path('routes/cash.php') );
        // load views
        $this->loadViewsFrom( module_path('resources/views'), 'cash' );
        // load translations
        $this->loadTranslationsFrom( module_path('resources/lang'), 'cash' );
        // load migrations
        $this->loadMigrationsFrom( module_path('database/migrations') );
        // load seeders
        $this->loadSeedersFrom( module_path('database/seeders') );
    }

    public function register() {
        // register helpers
        if (file_exists($helpers = realpath(__DIR__.'/helpers.php')))
            //
            require_once $helpers;
        // register singleton
        app()->singleton('cash', fn() => new Cash);
        // register commands
        $this->commands( $this->commands );
        // merge configuration
        $this->mergeConfigFrom( module_path('config/cash.php'), 'cash' );
    }

}
