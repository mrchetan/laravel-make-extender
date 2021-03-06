<?php

namespace Mrchetan\LaravelMakeExtender;

use Mrchetan\LaravelMakeExtender\Console\Commands\{
    MakeHelperCommand,
    MakeServiceCommand,
    MakeTraitCommand,
    MakeEnumCommand,
    MakeMacroCommand,
    MakeViewComposerCommand
};
use Illuminate\Support\ServiceProvider;

class LaravelMakeExtenderServiceProvider extends ServiceProvider
{
    /**
     * @param $dir
     * @param array $files
     * @return array
     */
    private function getIncludes($dir, array &$files = []): array
    {
        if (is_dir($dir)) {
            foreach (scandir($dir) as $inode) {
                $path = realpath($dir . DIRECTORY_SEPARATOR . $inode);
                if (!is_dir($path)) {
                    !(pathinfo($path, PATHINFO_EXTENSION) === "php") ?: array_push($files, $path);
                } elseif (!in_array($inode, [".", ".."])) {
                    self::getIncludes($path, $files);
                }
            }
        }
        return $files;
    }

    /**
     * Register the application view composer.
     *
     * @return void
     */
    public function ViewComposer()
    {
        $composers = config('viewcomposers', []);
        if(count($composers)) {
            foreach ($composers as $composer => $views) {
                $this->app->make('view')->composer($views, $composer);
            }
        }
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * include helpers
         * */
        array_map(function ($helper) {
            require_once($helper);
        }, self::getIncludes(app_path('Helpers')));

        /*
         * include macros
         * */
        array_map(function ($helper) {
            require_once($helper);
        }, self::getIncludes(app_path('Macros')));

        if ($this->app->runningInConsole()) {
            // Publishing the stub files.
            $this->publishes([
                __DIR__ . '/../stubs' => base_path('stubs/vendor/laravel-make-extender'),
            ], 'laravel-make-extender-stubs');

            $this->publishes([
                __DIR__ . '/../config/viewcomposers.php' => base_path('config/viewcomposers.php'),
            ], 'laravel-make-extender-config');

            // Registering package commands.
            $this->commands([
                MakeHelperCommand::class,
                MakeServiceCommand::class,
                MakeTraitCommand::class,
                MakeEnumCommand::class,
                MakeMacroCommand::class,
                MakeViewComposerCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        self::ViewComposer();
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-make-extender');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-make-extender', function () {
            return new LaravelMakeExtender;
        });
    }
}
