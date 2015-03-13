<?php 

Route::get(config('autologin.route_path'), array(
	'as' => config('autologin.route_name'),
	'uses' => config('autologin.route_controller')
));