<?php namespace Watson\Autologin\Facades;

use Illuminate\Support\Facades\Facade;

class Autologin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'autologin';
    }
}
