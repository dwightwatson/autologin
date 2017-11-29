<?php 

namespace Watson\Autologin\Interfaces;

interface AuthenticationInterface
{
    /**
     * Log a user in through the Laravel Auth facade
     * through their user id.
     *
     * @param  int  $userId
     * @return mixed
     */
    public function loginUsingId($id);
}
