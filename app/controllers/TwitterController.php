<?php

class TwitterController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$name = 'Devsprite';
		$twitter = Twitter::getFavorites(array('screen_name' => 'DevSprite', 'count' => 200, 'format' => 'object'));
		return View::make('twitter', compact('twitter'))->with(['name'=>$name]);
	}

	public function show()
	{
		$name = Input::get('nom');
		$twitter = Twitter::getFavorites(array('screen_name' => $name, 'count' => 200, 'format' => 'object'));
		return View::make('twitter', compact('twitter'))->with(['name'=>$name]);
	}

}
