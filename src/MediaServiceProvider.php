<?php

namespace Khadka7\MediaLibrary;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views','media-library');
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations')
        ], 'media-library-migrations');
        $this->publishes([
            __DIR__.'/resources/assets' => public_path('vendor/media-library'),
        ], 'media-library-assets');
//        $this->publishes([
//            __DIR__.'/resources/views/media/main' => resource_path('views/vendor/media-library'),
//        ], 'media-library-views');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
