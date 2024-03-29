<?php

namespace Orca\Theme\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Orca\Theme\Themes;
use Orca\Theme\Facades\Themes as ThemeFacade;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/helpers.php';
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('themes', function () {
            return new Themes();
        });

        $this->app->singleton('view.finder', function ($app) {
            return new \Orca\Theme\ThemeViewFinder(
                $app['files'],
                $app['config']['view.paths'],
                null
            );
        });
    }
}
