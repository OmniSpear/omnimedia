<?php
namespace Omnispear\Media;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
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
     * Load the resources
     *
     */
    public function boot(DispatcherContract $events)
    {
        // Load the routes for the package
        include __DIR__ . '/routes.php';

        \Route::bind('media', function ($value) {
            $media = Media::whereStorageLocation($value)->first();

            if(!$media) {
                $media = Media::findOrFail($value);
            }

            return $media;
        });


        $this->loadMigrationsFrom(__DIR__ . '/../../database/Migrations');
    }

    /**
     * Register the service provider.
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