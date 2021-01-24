<?php

namespace Tobi\HelloWorld\Providers;

use Illuminate\Support\ServiceProvider;
use Tobi\HelloWorld\Console\Command\MypackageGreetingCommand;

class MypackageServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->mergeConfigFrom([
            __DIR__.'/../config/myconfig.php' => 'myconfig',
        ]);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/myconfig.php' => config_path('myconfig.php'),
        ]);
        $this->loadRoutesFrom(
            __DIR__. "/../routes/web.php"
        );
        $this->loadMigrationsFrom(
            __DIR__. "/../database/migrations"
        );
        $this->loadViewsFrom(
            __DIR__. "/../resources/views", "mypackage"
        );
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/courier'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                MypackageGreetingCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/mypackage'),
        ], 'public');
    }
}
?>