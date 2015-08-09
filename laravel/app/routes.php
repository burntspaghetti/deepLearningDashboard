<?php

require_once('../vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');
require_once '../alchemyapi_php/alchemyapi.php';

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


Route::get('/', 'TwitterController@home');
Route::post('/twitterSearch', 'TwitterController@search');
Route::get('/twitter/searchResults', 'TwitterController@results');

Route::get('/stackExchange', 'StackExchangeController@home');
Route::post('stackExchangeSearch', 'StackExchangeController@search');
Route::get('/stackExchange/searchResults', 'StackExchangeController@results');