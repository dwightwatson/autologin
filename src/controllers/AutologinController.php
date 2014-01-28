<?php namespace Studious\Autologin;

use Auth, Redirect;
use User;
use Illuminate\Routing\Controller;


class AutologinController extends Controller {

	protected $autologin;

	public function __construct(Autologin $autologin)
	{
		$this->autologin = $autologin;
	}
	
	public function autologin($token)
	{
		if (list($userId, $path) = $this->autologin->validate($token))
		{
			$user = User::find($userId);

			Auth::login($user);

			return Redirect::to($path);
		}

		return Redirect::to(base_path());
	}

}