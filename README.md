Autologin for Laravel 4
=======================

Autologin is a package built specifically for Laravel 4 that will allow you to generate URLs that will provide automatic login to your application and then redirect to the appropriate location. By default, it supports the Laravel Auth facility, but I hope to expand that to others (Sentry, Entrust) as well as custom support in the future.

## Installation

Simply pop this in your `composer.json` file and run `composer update` (however your Composer is installed).

```
"studious/autologin": "dev-master"
```

Now, add the Autologin service provider to your `app/config/app.php` file.

`'Studious\Autologin\AutologinServiceProvider'`

If you want to adjust the default settings from the sensible defaults, publish the configuration file.

`php artisan config:publish studious/autologin`