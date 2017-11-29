<?php 

namespace Watson\Autologin\Interfaces;

interface AutologinInterface
{
    /**
     * Creates a autologin token.
     *
     * @param  array  $attributes
     * @return \Watson\Autologin\Interfaces\AutologinInterface
     */
    public static function create(array $params);

    /**
     * Find a user by the given token.
     *
     * @param  string  $token
     * @return \Watson\Autologin\Interfaces\AutologinInterface
     */
    public static function findByToken($token);

    /**
     * Delete a autologin token by the given token.
     *
     * @param  string  $token
     * @return void
     */
    public static function deleteByToken($token);

    /**
     * Delete all autologin tokens that are now expired.
     *
     * @param  string  $expiry
     * @return void
     */
    public static function deleteExpiredTokens($expiry);

    /**
     * Get the identifier for the token.
     *
     * @return integer
     */
    public function getId();

    /**
     * Get the user identifier for the token.
     *
     * @return integer
     */
    public function getUserId();

    /**
     * Get the token for the token.
     *
     * @return string
     */
    public function getToken();

    /**
     * Get the path for the token.
     *
     * @return string
     */
    public function getPath();

    /**
     * Increment the count of the token usage.
     *
     * @param  int  $amount
     * @return void
     */
    public function incrementCount($number);
}
