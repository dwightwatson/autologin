Autologin for Laravel 4
=======================

Autologin is a package built specifically for Laravel 4 that will allow you to generate URLs that will provide automatic login to your application and then redirect to the appropriate location. By default, it supports the Laravel Auth facility, but I hope to expand that to others (Sentry, Entrust) as well as custom support in the future.

## Installation

Simply pop this in your `composer.json` file and run `composer update` (however your Composer is installed).

```
"watson/autologin": "dev-master"
```

Now, add the Autologin service provider to your `app/config/app.php` file.

`'Watson\Autologin\AutologinServiceProvider'`

If you want to adjust the default settings from the sensible defaults, publish the configuration file.

`php artisan config:publish watson/autologin`

And of course, if you'd like to use a Facade instead of injecting the class itself, add this to the aliases array.

`'Autologin' => 'Watson\Autologin\Facades\Autologin'`

## Generating a autologin link

### Autologin link for a user

	// User class implements UserInterface
	$user = User::find(1);

	// http://example.com/autologin/Mx7B1fsUin
    $link = Autologin::user($user);

### Autologin link for a user with a path

    // User class implements UserInterface
    $user = User::find(1);

    // http://example.com/autologin/RvcNoAcH0X
	$link = Autologin::to($user, '/profile');

### Autologin link for a user with a route

    // User class implements UserInterface
    $user = User::find(1);

    // http://example.com/autologin/3eQOsRnvPE
    $link = Autologin::route($user, 'posts.index');

## Validating a token

If you take a look at `Watson\Autologin\AutologinController` you'll see an example of how a token is validated, the user is logged in and then redirected. If you wish to use a different approach, simply copy the controller into your own application, swap out what you want to change and then set the controller in the Autologin configuration file.

## Authentication

By default, Autologin is hooked up to work with Laravel's Auth library. However, simply publish the configuration file to switch it out with the built-in Sentry provider. It's super easy to implement your own provider, just swap it out and implement `Watson\Autologin\Interfaces\AuthenticationInterface`. Feel free to make a PR for other authentication libraries you'd like to support.