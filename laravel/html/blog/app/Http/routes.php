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
Route::get('/test-sql', function() {

    DB::enableQueryLog();

    $articles = App\Article::create();
 
    return response()->json(DB::getQueryLog());
});

Route::get('/','ArticlesController@index');
Route::get('/about','SitesController@about');
Route::get('/contact','SitesController@contact');

Route::get('admin', function () {
	return view('admin_template');
});

/*Route::get('/articles','ArticlesController@index');
Route::get('/articles/create','ArticlesController@create');
Route::get('/articles/{id}','ArticlesController@show');
Route::post('/articles','ArticlesController@store');
Route::get('/articles/{id}/edit','ArticlesController@edit');*/
Route::resource('articles','ArticlesController');

Route::get('auth/login','Auth\AuthController@getLogin');
Route::post('auth/login','Auth\AuthController@postLogin');

Route::get('auth/register','Auth\AuthController@getRegister');
Route::post('auth/register','Auth\AuthController@postRegister');

Route::get('auth/logout','Auth\AuthController@getLogout');




/*
Route::get('/', function () {
    return view('sites.index');
});
Route::get('/about', function () {
    return 'I am Samuel Su';
});*/
