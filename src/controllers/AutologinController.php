<?php namespace Watson\Autologin;

use Auth, Redirect;
use Illuminate\Routing\Controller;
use Watson\Autologin\Interfaces\AutologinInterface;


class AutologinController extends Controller {

	/**
	 * AutologinInterface provider instance.
	 *
	 * @var \Studious\Autologin\Interfaces\AutologinInterface
	 */
	protected $provider;

	/**
	 * Studious Autologin instance.
	 *
	 * @var \Studious\Autologin\Autologin
	 */
	protected $autologin;

	/**
	 * Instantiate the controller.
	 */
	public function __construct(AutologinInterface $provider, Autologin $autologin)
	{
		$this->provider = $provider;
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
			Auth::loginUsingId($autologin->getUserId());

			return Redirect::to($autologin->getPath());
		}

		// Token was invalid, redirect back to the home page.
		return Redirect::to(base_path());
	}

}