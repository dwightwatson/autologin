<?php namespace Watson\Autologin\Facades;

use Illuminate\Support\Facades\Facade;

class Autologin extends Facade
{
	protected static function getFacadeAccessor() { return 'autologin'; }
}