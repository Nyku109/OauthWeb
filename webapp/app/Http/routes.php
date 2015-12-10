<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/callback', function () {
    return view('callback');
});
Route::get('/connect', function () {
    return view('connect');
});
Route::get('/redirect', function () {
    return view('redirect');
});
Route::get('/clearsessions', function () {
    return view('clearsessions');
});

Route::post('/login', 'LoginController@login');
Route::get('/pics', 'PicturesController@index');

Route::get('/imageLike/{id}',function($id){
	return view('imageLike')->with('image',$id);
});
Route::get('imageDislike/{id}', function($id){
	return view('imageDislike')->with('image',$id);
});