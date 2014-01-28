<?php namespace Studious\Autologin;

use Illuminate\Support\Facades\Facade;

class AutologinFacade extends Facade
{
	protected static function getFacadeAccessor() { return 'autologin'; }
}