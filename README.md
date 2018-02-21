**jrean/laravel-supercollege-browse** is a PHP package built for Laravel 5.* to
easily interact with the SuperCollege Browse API.

[![Latest Stable Version](https://poser.pugx.org/jrean/laravel-supercollege-browse/v/stable)](https://packagist.org/packages/jrean/laravel-supercollege-browse) [![Total Downloads](https://poser.pugx.org/jrean/laravel-supercollege-browse/downloads)](https://packagist.org/packages/jrean/laravel-supercollege-browse) [![License](https://poser.pugx.org/jrean/laravel-supercollege-browse/license)](https://packagist.org/packages/jrean/laravel-supercollege-browse)

## ABOUT

- [x] Get scholarships by multiple criterias
- [x] Get scholarships details

## INSTALLATION

This project can be installed via [Composer](http://getcomposer.org). To get
the latest version of Laravel User Verification, add the following line to the
require block of your composer.json file:

    {
        "require": {
            "jrean/laravel-supercollege-browse": "dev-master"
        }

    }

You'll then need to run `composer install` or `composer update` to download the
package and have the autoloader updated.

Or run the following command:

    composer require jrean/laravel-supercollege-browse:dev-master

### Add the Service Provider & Facade/Alias

Once Larvel User Verification is installed, based on your Laravel version you
will need to register the service provider in `config/app.php`. Make sure to
add the following line **above** the `RouteServiceProvider`.

```PHP
Jrean\SuperCollege\SuperCollegeServiceProvider::class,
```

You may add the following `aliases` to your `config/app.php`:

```PHP
'SuperCollege' => Jrean\SuperCollege\Facades\SuperCollege::class,
```

The last 2 directives are optional if you are using Laravel ~5.5, thanks to the
auto-discovery option.

Publish the package config file by running the following command:

```
php artisan vendor:publish --provider="Jrean\SuperCollege\SuperCollegeServiceProvider" --tag="config"
```

## LICENSE

Laravel Supercollege is licensed under [The MIT License (MIT)](LICENSE).
