Autologin for Laravel
=====================

Autologin is a package built specifically for Laravel 4/5 that will allow you to generate URLs that will provide automatic login to your application and then redirect to the appropriate location. By default, it supports the Laravel Auth facility, but I hope to expand that to others (Sentry, Entrust) as well as custom support in the future.



## Installation

Pop this in your `composer.json` file and run `composer update` (this might differ depending on how or where you installed Composer).

    composer require watson/autologin

Now, add the Autologin service provider to your `app/config/app.php` file.

`Watson\Autologin\AutologinServiceProvider::class`

If you want to adjust the default settings from the sensible defaults, publish the configuration file.

`php artisan vendor:publish --provider="Watson\Autologin\AutologinServiceProvider" --tag="config"`

To get the migrations, publish them.

`php artisan vendor:publish --provider="Watson\Autologin\AutologinServiceProvider" --tag="migrations"`

And of course, if you'd like to use a Facade instead of injecting the class itself, add this to the aliases array.

`'Autologin' => Watson\Autologin\Facades\Autologin::class`

Then, add the route to your `routes.php` file, naming it `autologin`. If you'd like to name it something else, ensure you also change that in the configuration file. You can use the provided `AutologinController` or route to a controller of your own.

    Route::get('autologin/{token}', ['as' => 'autologin', 'uses' => '\Watson\Autologin\AutologinController@autologin']);

Note that previous versions of the package would add this route automatically. I removed this to enable you to better control the route middleware groups in your application to start the session and so on.

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

If you take a look at `Watson\Autologin\AutologinController` you'll see how the packages validates tokens, logs in and then redirects the user. 
If you wish to use a different approach, copy the controller into your own application, swap out what you want to change and then set the controller in the Autologin configuration file.

## Authentication

By default, Autologin works with Laravel's Auth library. You can publish the configuration file to switch to the built-in Sentry provider. 
It's super easy to implement your own provider: swap it out and implement `Watson\Autologin\Interfaces\AuthenticationInterface`. Feel free to make a PR for other authentication libraries you'd like to support.