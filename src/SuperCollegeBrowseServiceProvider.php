<?php
/**
 * This file is part of Jrean\SuperCollegeBrowse package.
 *
 * (c) Jean Ragouin <go@askjong.com> <www.askjong.com>
 */
namespace Jrean\SuperCollegeBrowse;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SuperCollegeBrowseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // config
        $this->publishes([
            __DIR__ . '/config/supercollege_browse.php' => config_path('supercollege_browse.php')
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSuperCollegeBrowse($this->app);

        // configurations
        $this->mergeConfigFrom(
            __DIR__ . '/config/supercollege_browse.php', 'supercollege_browse'
        );
    }

    /**
     * Register the SuperCollegeBrowse.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    protected function registerSuperCollegeBrowse(Application $app)
    {
        $app->bind('supercollege-browse', function ($app) {
            return new SuperCollegeBrowse;
        });

        $app->alias('supercollege-browse', SuperCollegeBrowse::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'supercollege-browse',
        ];
    }
}
