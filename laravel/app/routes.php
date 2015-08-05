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

Route::get('/', function()
{
	$settings = array(
		'oauth_access_token' => Config::get('oauth.oauth_access_token'),
		'oauth_access_token_secret' => Config::get('oauth.oauth_access_token_secret'),
		'consumer_key' => Config::get('oauth.consumer_key'),
		'consumer_secret' => Config::get('oauth.consumer_secret')
	);
	
	$url = 'https://api.twitter.com/1.1/search/tweets.json';

	$getfield = '?q=alchemyapi&src=typd';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$jsonResponse =  $twitter->setGetfield($getfield)
							 ->buildOauth($url, $requestMethod)
							 ->performRequest();
	$results = json_decode($jsonResponse);
	dd($results);
});
