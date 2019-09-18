<?php

namespace Omnispear\Media;

use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
use Collective\Html\HtmlServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageServiceProvider;
use Omnispear\Media\Models\Media;
use Route;

class OmniMediaServiceProvider extends ServiceProvider
{
    /**
     * Load the resources into project
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/Migrations');

        Route::bind('media', function ($value) {
            $media = Media::whereStorageLocation($value)->first();

            if (!$media) {
                $media = Media::findOrFail($value);
            }

            return $media;
        });
    }

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $this->app->register(HtmlServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);

        $loader->alias('Form', FormFacade::class);
        $loader->alias('Html', HtmlFacade::class);
    }
}