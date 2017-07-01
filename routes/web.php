<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});
$app->get('data', function(){
	return response()->json(['test']);
});
$app->post('tutorials','TutorialsController@store');
$app->get('tutorials','TutorialsController@index');
$app->put('tutorials/{id}','TutorialsController@update');
$app->delete('tutorials/{id}','TutorialsController@destroy');
$app->post('users','UsersController@store');
$app->get('users','UsersController@index');
$app->put('users/{username}','UsersController@update');
$app->delete('users/{username}','UsersController@destroy');
$app->post('categories','CategoryController@store');
$app->get('categories','CategoryController@index');
$app->put('categories/{category_id}','CategoryController@update');
$app->delete('categories/{category_id}','CategoryController@destroy');
$app->post('bookmarks','BookmarkController@store');
$app->get('bookmarks','BookmarkController@index');
$app->put('bookmarks/{bookmarks_id}','BookmarkController@update');
$app->delete('bookmarks/{bookmarks_id}','BookmarkController@destroy');
$app->post('creations','CreationController@store');
$app->get('creations','CreationController@index');
$app->put('creations/{creation_id}','CreationController@update');
$app->delete('creations/{creation_id}','CreationController@destroy');