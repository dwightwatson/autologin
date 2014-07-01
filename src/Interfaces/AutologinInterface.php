<?php namespace Watson\Autologin\Interfaces;

interface AutologinInterface 
{
	public static function create(array $params);

	public static function findByToken($token);

	public static function deleteByToken($token);

    public static function deleteExpiredTokens($expiry);

    public function getId();

    public function getUserId();

    public function getToken();

    public function getPath();

    public function incrementCount($number);
}