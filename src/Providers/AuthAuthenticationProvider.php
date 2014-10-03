<?php namespace Watson\Autologin\Providers;

use Auth;
use Watson\Autologin\Interfaces\AuthenticationInterface;

class AuthAuthenticationProvider implements AuthenticationInterface
{
	/**
	 * Log a user in through the Laravel Auth facade
	 * through their user id.
	 *
	 * @param  int  $userId
	 * @return mixed
	 */
	public function loginUsingId($userId)
	{
		$auth_provider = Auth::getProvider();
		$user = $auth_provider->retrieveById($userId);
		if (!$user)
		{
			return null;
		}
		return Auth::loginUsingId($userId);
	}	
}