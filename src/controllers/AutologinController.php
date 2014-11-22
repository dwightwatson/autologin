<?php namespace Watson\Autologin;

use Auth, Redirect;
use Illuminate\Routing\Controller;
use Watson\Autologin\Interfaces\AuthenticationInterface;
use Watson\Autologin\Interfaces\AutologinInterface;

class AutologinController extends Controller {

	/**
	 * AuthenticationInterface provider instance.
	 *
	 * @var \Watson\Autologin\Interfaces\AuthenticationInterface
	 */
	protected $provider;

	/**
	 * Studious Autologin instance.
	 *
	 * @var \Watson\Autologin\Autologin
	 */
	protected $autologin;

	/**
	 * Instantiate the controller.
	 */
	public function __construct(AuthenticationInterface $authProvider, Autologin $autologin)
	{
		$this->authProvider = $authProvider;
		$this->autologin = $autologin;
	}
	
	/**
	 * Process the autologin token and perform the redirect.
	 */
	public function autologin($token)
	{
		if ($autologin = $this->autologin->validate($token))
		{
			// Active token found, login the user and redirect to the
			// intended path.
			if ($user = $this->authProvider->loginUsingId($autologin->getUserId()))
			{
				return Redirect::to($autologin->getPath());
			}
		}

		// Token was invalid, redirect back to the home page.
		return Redirect::to('/');
	}

}