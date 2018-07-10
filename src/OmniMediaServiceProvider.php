<?php

namespace Omnispear\Media;

use Cviebrock\ImageValidator\ImageValidatorServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Omnispear\Media\Events\ViewPostEvent;
use Omnispear\Media\Facades\OmniBlog;
use Omnispear\Media\Listeners\PostViewListener;
use Omnispear\Media\Middleware\Authenticate;
use Omnispear\Media\Middleware\RedirectIfAuthenticated;
use Omnispear\Media\Models\Media;

class OmniMediaServiceProvider extends ServiceProvider
{
    /**
     * Load the resources into project
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/Migrations');

        \Route::bind('media', function ($value) {
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

        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(ImageValidatorServiceProvider::class);
        $this->app->register(\Intervention\Image\ImageServiceProvider::class);

        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
    }
}