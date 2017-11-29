<?php

namespace Watson\Autologin\Providers;

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
        $guard = config('autologin.guard');

        if ($user = Auth::guard($guard)->getProvider()->retrieveById($userId)) {

            Auth::guard($guard)->login($user);

            return $user;
        }

        return null;
    }
}
