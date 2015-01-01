<?php namespace Watson\Autologin\Providers;

use Sentry;
use Cartalyst\Sentry\Users\UserNotFoundException;
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
		try
		{
			$user = Sentry::findUserById($userId);

			// Log the user in
			Sentry::login($user);

			return $user;
		}
		catch (UserNotFoundException $e)
		{
			return null;
		}
	}	
}
