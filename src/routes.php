<?php 

Route::get(Config::get('autologin::route_path'), array(
	'as' => Config::get('autologin::route_name'), 
	'uses' => Config::get('autologin::route_controller')
));