<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('upload', function()
{
	d(App::environment());
	d(str_random(8));

	return View::make('upload');
});

Route::get('display', function()
{
	$image_url = asset('images/4562/4562.jpeg');



	return View::make('upload', compact('image_url'));
});

Route::post('/upload', function()
{
	$item_id = 4562;

	$file = Input::file('file');
	$path = public_path('images/' . $item_id);
	// $path = storage_path($item_id);

	if (!File::exists($path)) File::makeDirectory($path, 511, true);
	

	// d(Input::all());
	// d($folder);
	// d($file);

	$file_name = $item_id . '.' . $file->guessClientExtension();


	d($path . '/' . $file_name);

	if (Input::file('file')->move($path, $file_name))
	{
		sleep(5);
		return Redirect::to('upload');
	}

	return 'error';

});