# Omnispear Media

This package is a very simple package that allows the creation of a Media Library, very useful for integration with blog's and Slide show managers.

## Installing

Add project to composer.json by running the following command:

```
composer require omnispear/media
```

### Configuring OmniMedia

To install into a Laravel project, first do the composer install then add the following class to your config/app.php service providers list.

`Omnispear\Media\OmniMediaServiceProvider::class`

Once this package has been added to service provider list, run database migrations...

`php artisan migrate`
