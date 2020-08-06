<?php

namespace Safventure\laravelSRC;

use Safventure\laravelSRC\Commands\RepositoryCommandGenerator;
use Safventure\laravelSRC\Commands\ServiceCommandGenerator;
use Safventure\laravelSRC\Commands\ControllerCommandGenerator;
use Safventure\laravelSRC\Commands\SRCCommandGenerator;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/laravel-s-r-c.php';

    protected $commands = [
        'RepositoryMake' => 'command.repository.make',
        'ServiceMake' => 'command.service.make',
        'ControllerMake' => 'command.rscontroller.make',
        'SRCMake' => 'command.src.make',
    ];

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('laravel-s-r-c.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'laravel-s-r-c'
        );

        $this->app->bind('laravel-s-r-c', function () {
            return new laravelSRC();
        });

        $this->registerCommands($this->commands);
    }

    /**
     * Register the given commands.
     *
     * @param  array $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            call_user_func_array([$this, "register{$command}Command"], []);
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRepositoryMakeCommand()
    {
        $this->app->singleton('command.repository.make', function ($app) {
            return new RepositoryCommandGenerator($app['files']);
        });
    }
    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerServiceMakeCommand()
    {
        $this->app->singleton('command.service.make', function ($app) {
            return new ServiceCommandGenerator($app['files']);
        });
    }

     /**
     * Register the command.
     *
     * @return void
     */
    protected function registerControllerMakeCommand()
    {
        $this->app->singleton('command.rscontroller.make', function ($app) {
            return new ControllerCommandGenerator($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerSRCMakeCommand()
    {
        $this->app->singleton('command.src.make', function () {
            return new SRCCommandGenerator();
        });
    }
}
