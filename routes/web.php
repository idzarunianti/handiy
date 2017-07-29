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
$app->get('data', function () {
    return response()->json(['test']);
});
$app->post('users', 'UsersController@store');
$app->get('users', 'UsersController@index');
$app->put('users/{username}', 'UsersController@update');
$app->delete('users/{username}', 'UsersController@destroy');

$app->post('tutorial', 'TutorialsController@store');
$app->get('tutorial', 'TutorialsController@index');
$app->get('tutorial/{id}', 'TutorialsController@show');
$app->put('tutorial/{id}', 'TutorialsController@update');
$app->delete('tutorial/{id}', 'TutorialsController@destroy');

$app->post('categories', 'CategoryController@store');
$app->get('categories', 'CategoryController@index');
$app->put('categories/{category_id}', 'CategoryController@update');
$app->delete('categories/{category_id}', 'CategoryController@destroy');

$app->get('photo_tutorials/{tutorial_id}', 'PhotoTutorialsController@index');
$app->put('photo_tutorials/{photo_tutorial_id}', 'PhotoTutorialsController@update');

$app->group(['prefix' => '{username}'], function () use ($app) {
    $app->post('bookmarks', 'BookmarkController@store');
    $app->get('bookmarks', 'BookmarkController@index');
    $app->delete('bookmarks/{bookmarks_id}', 'BookmarkController@destroy');

    $app->post('creations', 'CreationController@store');
    $app->get('creations', 'CreationController@index');
    $app->put('creations/{creation_id}', 'CreationController@update');
    $app->delete('creations/{creation_id}', 'CreationController@destroy');
});

$app->group(['prefix' => '{tutorial_id}'], function () use ($app) {
	$app->get('creations', 'CreationController@show');
});