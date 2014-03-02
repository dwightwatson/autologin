<?php namespace Watson\Autologin\Providers;

use Sentry;
use Watson\Autologin\Interfaces\AuthenticationInterface;

class SentryAuthenticationProvider implements AuthenticationInterface
{
	/**
	 * Log a user in through the Sentry facade
	 * through their user id.
	 *
	 * @param  int  $userId
	 * @return mixed
	 */
	public function loginUsingId($userId)
	{
		// Find the user using the user id
		$user = Sentry::findUserById(1);

		// Log the user in
		return Sentry::login($user, false);
	}	
}